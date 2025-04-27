<?php
session_start();
require 'utils/auth-functions/customer-page/kick-res-owner.php';
require './config/connection.php';

// Store note in session when posted
if (isset($_POST['cart_note'])) {
  $_SESSION['cart_note'] = htmlspecialchars($_POST['cart_note']);
}

// Delete item from cart
if (isset($_POST['delete_item']) && isset($_SESSION['id'])) {
  $product_id = mysqli_real_escape_string($con, $_POST['delete_item']);
  $user_id = $_SESSION['id'];

  mysqli_begin_transaction($con);
  try {
    // Get cart info and product price
    $sql = "SELECT c.id as cart_id, c.total as cart_total, p.price 
                FROM cart c 
                INNER JOIN cart_item ci ON c.id = ci.cart_id 
                INNER JOIN product p ON ci.product_id = p.id 
                WHERE c.user_id = ? AND p.id = ?";
    $stmt = mysqli_prepare($con, $sql);
    mysqli_stmt_bind_param($stmt, 'ii', $user_id, $product_id);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);
    $cart_info = mysqli_fetch_assoc($result);

    if ($cart_info) {
      // Delete item
      $sql = "DELETE FROM cart_item WHERE cart_id = ? AND product_id = ?";
      $stmt = mysqli_prepare($con, $sql);
      mysqli_stmt_bind_param($stmt, 'ii', $cart_info['cart_id'], $product_id);
      mysqli_stmt_execute($stmt);

      // Update cart total
      $new_total = $cart_info['cart_total'] - $cart_info['price'];

      if ($new_total <= 0) {
        // If cart is empty, delete it
        $sql = "DELETE FROM cart WHERE id = ?";
        $stmt = mysqli_prepare($con, $sql);
        mysqli_stmt_bind_param($stmt, 'i', $cart_info['cart_id']);
        mysqli_stmt_execute($stmt);
      } else {
        // Update cart total
        $sql = "UPDATE cart SET total = ? WHERE id = ?";
        $stmt = mysqli_prepare($con, $sql);
        mysqli_stmt_bind_param($stmt, 'di', $new_total, $cart_info['cart_id']);
        mysqli_stmt_execute($stmt);
      }

      mysqli_commit($con);
      header('Location: cart.php');
      exit();
    }
  } catch (Exception $e) {
    mysqli_rollback($con);
    echo "Error: " . $e->getMessage();
  }
}

if (isset($_GET['id']) && isset($_SESSION['id'])) {
  $product_id = mysqli_real_escape_string($con, $_GET['id']);
  $user_id = $_SESSION['id'];

  // Get product and restaurant info
  $sql = "SELECT p.*, r.id as restaurant_id FROM product p 
            INNER JOIN restaurant r ON p.restaurant_id = r.id 
            WHERE p.id = ?";

  if ($stmt = mysqli_prepare($con, $sql)) {
    mysqli_stmt_bind_param($stmt, 'i', $product_id);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);
    $product = mysqli_fetch_assoc($result);

    if ($product) {
      // Check if user has any existing cart
      $sql = "SELECT c.id, c.total, c.restaurant_id 
              FROM cart c 
              WHERE c.user_id = ?";
      $stmt = mysqli_prepare($con, $sql);
      mysqli_stmt_bind_param($stmt, 'i', $user_id);
      mysqli_stmt_execute($stmt);
      $result = mysqli_stmt_get_result($stmt);
      $cart = mysqli_fetch_assoc($result);

      // If cart exists but restaurant is different, redirect to restaurant menu
      if ($cart && $cart['restaurant_id'] != $product['restaurant_id']) {
        header('Location: restaurant-menu.php?restaurant_id=' . $product['restaurant_id'] . '&hasError=true');
        exit();
      }

      mysqli_begin_transaction($con);
      try {
        if (!$cart) {
          // Create new cart
          $sql = "INSERT INTO cart (user_id, restaurant_id, total) VALUES (?, ?, ?)";
          $stmt = mysqli_prepare($con, $sql);
          mysqli_stmt_bind_param($stmt, 'iid', $user_id, $product['restaurant_id'], $product['price']);
          mysqli_stmt_execute($stmt);
          $cart_id = mysqli_insert_id($con);
          $new_total = $product['price'];
        } else {
          $cart_id = $cart['id'];
          $new_total = $cart['total'] + $product['price'];

          // Update cart total
          $sql = "UPDATE cart SET total = ? WHERE id = ?";
          $stmt = mysqli_prepare($con, $sql);
          mysqli_stmt_bind_param($stmt, 'di', $new_total, $cart_id);
          mysqli_stmt_execute($stmt);
        }

        // Add item to cart_items
        $sql = "INSERT INTO cart_item (cart_id, product_id, quantity) VALUES (?, ?, 1)";
        $stmt = mysqli_prepare($con, $sql);
        mysqli_stmt_bind_param($stmt, 'ii', $cart_id, $product_id);
        mysqli_stmt_execute($stmt);

        mysqli_commit($con);
        header('Location: cart.php');
        exit();
      } catch (Exception $e) {
        mysqli_rollback($con);
        echo "Error: " . $e->getMessage();
      }
    }
  }
}

// Get cart items
$cart_items = [];
if (isset($_SESSION['id'])) {
  $sql = "SELECT ci.quantity, p.*, c.total as cart_total 
            FROM cart c 
            INNER JOIN cart_item ci ON c.id = ci.cart_id
            INNER JOIN product p ON ci.product_id = p.id
            WHERE c.user_id = ?";

  if ($stmt = mysqli_prepare($con, $sql)) {
    mysqli_stmt_bind_param($stmt, 'i', $_SESSION['id']);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);
    $cart_items = mysqli_fetch_all($result, MYSQLI_ASSOC);
  }
}
?>

<!DOCTYPE html>
<html lang="en">
<?php require('./template/header.php') ?>

<div class="min-h-screen">
  <section class="bg-white shadow-md rounded-lg overflow-hidden p-6">
    <div class="flex flex-col gap-4">
      <?php if (!empty($cart_items)) { ?>
        <?php foreach ($cart_items as $item) { ?>
          <div class="flex items-center justify-between p-3 border-b border-gray-200">
            <div class="flex items-center gap-4">
              <img src="<?php echo htmlspecialchars($item['img']); ?>" class="w-16 h-16 object-cover rounded">
              <div>
                <h2 class="text-xl font-semibold text-gray-700"><?php echo htmlspecialchars($item['name']); ?></h2>
                <p class="text-gray-600">$<?php echo htmlspecialchars($item['price']); ?></p>
              </div>
            </div>
            <div class="flex items-center gap-4">
              <span class="px-3 py-1 bg-gray-200 rounded">Available quantity: <?php echo htmlspecialchars($item['quantity']); ?></span>
              <form method="post" class="inline">
                <input type="hidden" name="delete_item" value="<?php echo $item['id']; ?>">
                <button type="submit" class="px-4 py-2 bg-red-600 text-white rounded hover:bg-red-500 transition duration-200">Delete</button>
              </form>
            </div>
          </div>
        <?php } ?>

        <div class="mt-6 flex flex-col gap-4">
          <div class="w-full">
            <label for="cart_note" class="block text-sm font-medium text-gray-700 mb-2">Add a note to your order:</label>
            <textarea
              id="cart_note"
              name="cart_note"
              rows="3"
              class="block w-full rounded-md border border-gray-300 p-2 focus:border-green-500 focus:ring-green-500"
              placeholder="Special instructions, allergies, etc..."><?php echo isset($_SESSION['cart_note']) ? $_SESSION['cart_note'] : ''; ?></textarea>
          </div>

          <div class="flex items-center justify-between">
            <h1 class="text-2xl font-bold text-gray-800">Total: $<?php echo number_format($cart_items[0]['cart_total'], 2); ?></h1>
            <div class="flex gap-4">
              <form method="post" class="inline">
                <input type="hidden" name="save_note" value="1">
                <button type="submit" onclick="saveNote()" class="px-4 py-2 bg-gray-500 text-white rounded hover:bg-gray-600 transition duration-200">Save Note</button>
              </form>
              <input onclick="window.location.href='checkout.php'" type="button" value="Checkout" class="px-6 py-3 bg-green-500 text-white rounded hover:bg-green-600 transition duration-200">
            </div>
          </div>
        </div>
      <?php } else { ?>
        <div class="text-center py-8 flex flex-col items-center">
          <h2 class="text-xl text-gray-600">Your cart is empty</h2>
          <a href="index.php" class="mt-4 inline-block px-6 py-3 bg-blue-500 text-white rounded hover:bg-blue-600 transition duration-200">Browse Restaurants</a>
        </div>
      <?php } ?>
    </div>
  </section>
</div>

<script>
  function saveNote() {
    const note = document.getElementById('cart_note').value;
    fetch('cart.php', {
      method: 'POST',
      headers: {
        'Content-Type': 'application/x-www-form-urlencoded',
      },
      body: 'cart_note=' + encodeURIComponent(note)
    });
  }

  // Auto-save note when typing stops
  let timeout = null;
  document.getElementById('cart_note').addEventListener('input', function() {
    clearTimeout(timeout);
    timeout = setTimeout(saveNote, 1000); // Save 1 second after typing stops
  });
</script>

<?php require('./template/footer.php') ?>

</html>
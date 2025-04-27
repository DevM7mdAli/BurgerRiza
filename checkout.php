<?php
session_start();
require 'utils/auth-functions/customer-page/kick-res-owner.php';
require './config/connection.php';

if (!isset($_SESSION['id'])) {
  header('Location: sign-in.php');
  exit();
}

// Process checkout
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['confirm_order'])) {
  mysqli_begin_transaction($con);
  try {
    // Get cart info
    $sql = "SELECT c.*, r.id as restaurant_id FROM cart c 
                INNER JOIN restaurant r ON c.restaurant_id = r.id 
                WHERE c.user_id = ?";

    $stmt = mysqli_prepare($con, $sql);
    mysqli_stmt_bind_param($stmt, 'i', $_SESSION['id']);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);
    $cart = mysqli_fetch_assoc($result);

    if ($cart) {
      // Create order
      $sql = "INSERT INTO order_table (user_id, restaurant_id, total) VALUES (?, ?, ?)";
      $stmt = mysqli_prepare($con, $sql);
      mysqli_stmt_bind_param($stmt, 'iid', $_SESSION['id'], $cart['restaurant_id'], $cart['total']);
      mysqli_stmt_execute($stmt);
      $order_id = mysqli_insert_id($con);

      // Get cart items to update product quantities
      $sql = "SELECT ci.product_id, ci.quantity, p.quantity as stock_quantity 
                    FROM cart_item ci 
                    INNER JOIN product p ON ci.product_id = p.id 
                    WHERE ci.cart_id = ?";
      $stmt = mysqli_prepare($con, $sql);
      mysqli_stmt_bind_param($stmt, 'i', $cart['id']);
      mysqli_stmt_execute($stmt);
      $cart_items = mysqli_stmt_get_result($stmt);

      // Update product quantities
      while ($item = mysqli_fetch_assoc($cart_items)) {
        $new_quantity = $item['stock_quantity'] - $item['quantity'];
        if ($new_quantity < 0) {
          throw new Exception("Not enough stock for product ID: " . $item['product_id']);
        }

        $sql = "UPDATE product SET quantity = ? WHERE id = ?";
        $stmt = mysqli_prepare($con, $sql);
        mysqli_stmt_bind_param($stmt, 'ii', $new_quantity, $item['product_id']);
        mysqli_stmt_execute($stmt);
      }

      // Create invoice
      $note = isset($_SESSION['cart_note']) ? $_SESSION['cart_note'] : '';
      $sql = "INSERT INTO invoice (order_id, user_id, restaurant_id, notes, total) VALUES (?, ?, ?, ?, ?)";
      $stmt = mysqli_prepare($con, $sql);
      mysqli_stmt_bind_param($stmt, 'iiisd', $order_id, $_SESSION['id'], $cart['restaurant_id'], $note, $cart['total']);
      mysqli_stmt_execute($stmt);

      // Delete cart and items
      $sql = "DELETE FROM cart WHERE id = ?";
      $stmt = mysqli_prepare($con, $sql);
      mysqli_stmt_bind_param($stmt, 'i', $cart['id']);
      mysqli_stmt_execute($stmt);

      // Clear cart note from session
      unset($_SESSION['cart_note']);

      mysqli_commit($con);
      header('Location: account.php');
      exit();
    }
  } catch (Exception $e) {
    mysqli_rollback($con);
    $error_message = "Error processing checkout: " . $e->getMessage();
  }
}

// Get cart items for display
$cart_items = [];
$cart_total = 0;
if (isset($_SESSION['id'])) {
  $sql = "SELECT ci.quantity, p.*, c.total as cart_total, r.name as restaurant_name 
            FROM cart c 
            INNER JOIN cart_item ci ON c.id = ci.cart_id
            INNER JOIN product p ON ci.product_id = p.id
            INNER JOIN restaurant r ON c.restaurant_id = r.id
            WHERE c.user_id = ?";

  if ($stmt = mysqli_prepare($con, $sql)) {
    mysqli_stmt_bind_param($stmt, 'i', $_SESSION['id']);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);
    $cart_items = mysqli_fetch_all($result, MYSQLI_ASSOC);
    if (!empty($cart_items)) {
      $cart_total = $cart_items[0]['cart_total'];
    }
  }
}
?>

<!DOCTYPE html>
<html lang="en">

<?php require('./template/header.php'); ?>

<div class="min-h-screen p-4">
  <?php if (!empty($cart_items)): ?>
    <main class="p-4 bg-gray-50 rounded">
      <div>
        <h1 class="text-2xl font-bold">Checkout</h1>
      </div>
      <div>
        <h3>Order from restaurant: <span class="font-bold"><?php echo $cart_items[0]['restaurant_name'] ?></span></h3>
      </div>
      <section class="grid grid-cols-1 sm:grid-cols-3 gap-2 p-6">
        <div class="grid col-span-2 bg-primary rounded-lg p-3">
          <?php foreach ($cart_items as $item): ?>
            <div class="flex items-center justify-between p-3 border-b border-gray-200">
              <div class="flex items-center gap-4">
                <img src="<?php echo htmlspecialchars($item['img']); ?>" alt="<?php echo htmlspecialchars($item['name']); ?>" class="w-16 h-16 object-cover rounded">
                <div>
                  <h2 class="text-xl font-semibold text-gray-700"><?php echo htmlspecialchars($item['name']); ?></h2>

                </div>
              </div>
              <div class="flex items-center gap-4">
                <span class="px-3 py-1 bg-gray-200 rounded">Token Qty: <?php echo htmlspecialchars($item['quantity']); ?></span>
                <span>$<?php echo number_format($item['price'] * $item['quantity'], 2); ?></span>
              </div>
            </div>
          <?php endforeach; ?>
        </div>
        <div class="flex flex-col justify-between rounded-lg p-3 bg-primary">
          <div>
            <h1 class="text-xl">Total $<?php echo number_format($cart_total, 2); ?></h1>
            <?php if (isset($_SESSION['cart_note'])): ?>
              <div class="bg-gray-50 p-4 rounded-lg mb-4">
                <h4 class="font-medium text-gray-700">Order Notes:</h4>
                <p class="text-gray-600"><?php echo htmlspecialchars($_SESSION['cart_note']); ?></p>
              </div>
            <?php endif; ?>
          </div>

          <div>
            <form method="POST" class="mt-6">
              <button type="submit" name="confirm_order" class="w-full bg-green-500 text-white py-3 px-4 rounded-lg hover:bg-green-600 transition duration-200">
                Confirm Order
              </button>
            </form>

            <a href="cart.php" class="mt-4 block text-center text-gray-600 hover:text-gray-800">
              Return to Cart
            </a>
            <?php if (isset($error_message)): ?>
              <div class="mt-4 p-4 bg-red-50 text-red-700 rounded-lg">
                <?php echo htmlspecialchars($error_message); ?>
              </div>
            <?php endif; ?>
          </div>
        </div>
      </section>
    </main>
  <?php else: ?>
    <div class="p-6 text-center">
      <p class="text-gray-600 mb-4">Your cart is empty</p>
      <a href="index.php" class="inline-block bg-green-500 text-white py-2 px-4 rounded hover:bg-green-600 transition duration-200">
        Browse Restaurants
      </a>
    </div>
  <?php endif; ?>
</div>

<?php require('./template/footer.php'); ?>

</html>
<?php
session_start();
require 'utils/auth-functions/customer-page/kick-res-owner.php';
require './config/connection.php';

if (!isset($_SESSION['id'])) {
  header('Location: sign-in.php');
  exit();
}

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

    // Create invoice with note
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

    // Clear cart note from session after complete
    unset($_SESSION['cart_note']);

    mysqli_commit($con);
    header('Location: account.php');
    exit();
  } else {
    throw new Exception("No cart found");
  }
} catch (Exception $e) {
  mysqli_rollback($con);
  echo "Error processing checkout: " . $e->getMessage();
  echo "<br><a href='cart.php'>Return to cart</a>";
}
?>

<!DOCTYPE html>
<html lang="en">

<?php require('./template/header.php'); ?>

<div class="min-h-screen">
  <section class="grid grid-cols-1 sm:grid-cols-3 gap-2 p-6">
    <div class="grid col-span-2 bg-primary rounded-lg p-3">
      <?php foreach ([1, 2, 3, 4, 5, 6, 7] as $Items) { ?>
        <div class="flex items-center justify-between p-3 border-b border-gray-200">
          <div class="flex items-center gap-4">
            <img src="./assets/Logo.png" class="w-16 h-16 object-cover rounded">
            <div>
              <h2 class="text-xl font-semibold text-gray-700">Bigcheese Burger</h2>
            </div>
          </div>
          <div class="flex items-center gap-4">
            <span class="px-3 py-1 bg-gray-200 rounded">Qty: 1</span>
            <input type="submit" name="delete" value="Delete" class="px-4 py-2 bg-red-600 text-white rounded hover:bg-red-500 transition duration-200">
          </div>
        </div>
      <?php } ?>
    </div>
    <div class="flex flex-col justify-between rounded-lg p-3 bg-primary">
      <div class="text-xl">
        This total is 30$
      </div>

      <input
        type="submit"
        name="checkout"
        value="Checkout"
        class="px-6 py-3 bg-green-500 text-white rounded hover:bg-green-600 transition duration-200" />
    </div>
  </section>
</div>


<?php require('./template/footer.php'); ?>

</html>
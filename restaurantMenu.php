<?php
session_start();
require 'utils/auth-functions/customer-page/kick-res-owner.php';
require './config/connection.php';

if (isset($_GET['restaurant_id'])) {
  $id = mysqli_real_escape_string($con, $_GET['restaurant_id']);

  $sql = "SELECT 
    p.id, 
    p.name AS product_name, 
    p.price, 
    p.quantity, 
    p.img AS product_img,
    r.name AS restaurant_name 
    FROM product p
    INNER JOIN restaurant r ON p.restaurant_id = r.id 
    WHERE r.id = ?";

  if ($prStmt = mysqli_prepare($con, $sql)) {
    mysqli_stmt_bind_param($prStmt, 'i', $id);
    if (mysqli_stmt_execute($prStmt)) {
      $result = mysqli_stmt_get_result($prStmt);
      $output = mysqli_fetch_all($result, MYSQLI_ASSOC);
      mysqli_stmt_close($prStmt);
      mysqli_close($con);
    } else {
      echo 'Error in statement: ' . mysqli_error($con);
    }
  } else {
    echo 'Error in connection: ' . mysqli_error($con);
  }
}
?>

<!DOCTYPE html>
<html lang="en">

<?php require('./template/header.php') ?>

<div class="flex flex-col gap-y-16 px-64 pt-8">
  <?php if (!empty($output)) { ?>
    <h1 class="text-center text-xl font-bold">Welcome to <?php echo $output[0]['restaurant_name'] ?> Menu</h1>
    <?php foreach ($output as $product) : ?>
      <div class="flex flex-col justify-around gap-2  px-2 py-8 bg-white rounded-xl">
        <img src="<?php echo $product['product_img'] ?>" alt="<?php echo $product['product_img'] ?>" class="w-24 h-24 block relative -top-10 -my-12 mx-auto bg-white shadow-md rounded-full">
        <h1 id="burgerName"> Burger Name: <?php echo htmlspecialchars($product['product_name']) ?> </h1>
        <h1 id="burgerPrice"> Burger price: <?php echo htmlspecialchars($product['price']) . "$" ?> </h1>
        <h1 id="quantity"> Quantity: <?php echo htmlspecialchars($product['quantity']) ?> </h1>

        <div class="text-red-500 border-t-4">
          <a href="cart.php?id=<?php echo $product['id'] ?>">Add to cart</a>
        </div>
      </div>

    <?php endforeach; ?>
  <?php } else { ?>
    <div class="text-4xl text-center pt-40 font-bold">
      The menu is empty you will be redirected to the list of restaurant
    </div>
    <?php
    header('Refresh: 5; url=index.php');
    ?>
  <?php } ?>


</div>

<?php require('./template/footer.php') ?>

</html>
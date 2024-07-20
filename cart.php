<?php
session_start();

require './config/connection.php';


?>



<!DOCTYPE html>
<html lang="en">

<?php require('./template/header.php') ?>

<?php if ($_SESSION['Role'] === "C") { ?>
  <section>
    <h1 class="text-center text-5xl py-4">cart</h1>

    <div class="flex flex-col items-center px-24 gap-y-8" id="listOfTheCart">



      <div class="flex flex-row justify-between items-center w-full bg-blue-100 p-4">
        <div class="w-12 h-12">
          <img src="./assets/Logo.png" alt="burgerPic">
        </div>

        <div class="flex-grow px-12 text-lg">
          name of the burger
        </div>

        <div class="flex items-center">
          <p class="pr-4">quantity 1</p>
          <!-- <input type="number" min="1" value="quantity"> -->
          <input type="submit" value="Delete" class="p-3 rounded-lg bg-red-500 text-white" name="Delete">
        </div>

      </div>

      <div id="totalCheckout">
        <div>
          <h1>Total: 23$</h1>
          <input type="submit" value="checkout" class="bg-red-500 p-2 rounded-lg text-white">
        </div>

      </div>
    </div>
  </section>
<?php } else {
  header('Location:index.php');
} ?>



<?php require('./template/footer.php') ?>

</html>
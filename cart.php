<?php
session_start();

require './config/connection.php';


?>



<!DOCTYPE html>
<html lang="en">

<?php require('./template/header.php') ?>

<?php if ($_SESSION['Role'] === "C") { ?>
<div class=" min-h-screen ">
<section>
    <h1 class="text-center text-3xl font-bold py-4">Cart</h1>

    <div class=" mx-12 flex flex-col items-center px-16 gap-y-5 bg-gradient-to-br from-red-500 via-orange-400 to-yellow-300 p-4 rounded-2xl" id="listOfTheCart">



      <div class="flex flex-row justify-between items-center w-full bg-white p-4 rounded-lg">
        <div class="w-12 h-12">
          <img src="./assets/Logo.png" alt="burgerPic">
        </div>

        <div class="flex-grow px-12 text-lg">
          Bigcheese
        </div>

        <div class="flex items-center">
          <p class="mr-4 bg-neutral-200 p-0.5 rounded-xl">Quantity: 1</p>
          <!-- <input type="number" min="1" value="quantity"> -->
          <input type="submit" value="Delete" class="p-2 rounded-lg bg-red-500 text-white hover:bg-orange-400" name="Delete">
        </div>
        
      </div>
      <div class="flex flex-row justify-between items-center w-full bg-white p-4 rounded-lg">
        <div class="w-12 h-12">
          <img src="./assets/Logo.png" alt="burgerPic">
        </div>

        <div class="flex-grow px-12 text-lg">
          Bigcheese
        </div>

        <div class="flex items-center">
          <p class="mr-4 bg-neutral-200 p-0.5 rounded-xl">Quantity: 1</p>
          <!-- <input type="number" min="1" value="quantity"> -->
          <input type="submit" value="Delete" class="p-2 rounded-lg bg-red-500 text-white hover:bg-orange-400" name="Delete">
        </div>
        
      </div>

      <div id="totalCheckout">
        <div class="flex flex-row justify-between items-center w-full bg-white p-4 rounded-lg gap-3">
          <h1 class="font-semibold text-xl">Total: 23$</h1>
          <input type="submit" value="checkout" class="bg-red-500 p-2 rounded-lg text-white hover:bg-orange-400">
        </div>
      </div>

    </div>
  </section>
</div>
<?php } else {
  header('Location:index.php');
} ?>



<?php require('./template/footer.php') ?>

</html>
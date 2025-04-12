<?php
session_start();

require './config/connection.php';


?>


<!DOCTYPE html>
<html lang="en">
<?php if ($_SESSION['Role'] === "C") { ?>
<?php require('./template/header.php') ?>

<div class=" min-h-screen ">
<section class="bg-white shadow-md rounded-lg overflow-hidden p-6">
      <div class="flex flex-col gap-4">
      <?php foreach ([1, 2, 3, 4, 5, 6] as $Items) { ?>
          <div class="flex items-center justify-between p-3 border-b border-gray-200">
            <div class="flex items-center gap-4">
              <img src="./assets/Logo.png"  class="w-16 h-16 object-cover rounded">
              <div>
                <h2 class="text-xl font-semibold text-gray-700">Bigcheese Burger</h2>
              </div>
            </div>
            <div class="flex items-center gap-4">
              <span class="px-3 py-1 bg-gray-200 rounded">Qty: 1</span>
                <input type="submit" name="delete" value="Delete" class="px-4 py-2 bg-red-600 text-white rounded hover:bg-red-500 transition duration-200">
            </div>
          </div>
      <?php }?>

      <div class="mt-6 flex items-center justify-between">
        <h1 class="text-2xl font-bold text-gray-800">Total: $23</h1>
          <input type="submit" name="checkout" value="Checkout" class="px-6 py-3 bg-green-500 text-white rounded hover:bg-green-600 transition duration-200">
      </div>
    </section>
</div>




<?php require('./template/footer.php') ?>
<?php } else {
  header('Location:index.php');
} ?>
</html>

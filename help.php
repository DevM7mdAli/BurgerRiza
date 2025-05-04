<!DOCTYPE html>
<html lang="en">
<?php require('./template/header.php') ?>

<div class="flex items-center justify-center min-h-screen bg-gradient-to-br from-red-500 via-orange-400 to-yellow-300 gap-4 px-3">
  <div class="flex flex-col bg-white bg-opacity-95 backdrop-blur-md p-8 rounded-lg shadow-lg w-300 h-150">
    <h1 class="text-2xl border-b-2 border-black mb-4">Need Help?</h1>
    <div>
        <ul class="list-disc mb-4">
        <h3 class="text-xl font-semibold">How to add items in the cart:</h3>
            <li>
                From the list of restaurant select "See the menu" for any restaurant you want. 
            </li>
            <li>
                Then choose the product you want and "Add to cart".
            </li>
            <li>
                And the product now in your cart.
            </li>
        </ul>
        <ul class="list-disc mb-4">
        <h3 class="text-xl font-semibold">How to checkout your order:</h3>
            <li>
                From the cart where there will be your order select "Checkout". 
            </li>
            <li>
                Then click on "confirm Order" to complete the process.
            </li>
            <li>
                And your order is done successfully.
            </li>
        </ul>
        <ul class="list-disc mb-4">
        <h3 class="text-xl font-semibold">Having Technical Isuues?:</h3>
            <li>
                Try Refreshing Page. 
            </li>
            <li>
                Check your connection.
            </li>
            <li>
                If issue is still not solved plese <span class="font-bold text-xl underline text-amber-600"><a href="contact.php">contact us</a></span>.
            </li>
        </ul>
    </div>
    
  </div>
</div>
<?php require('./template/footer.php') ?>
</html>
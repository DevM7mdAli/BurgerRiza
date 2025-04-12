<?php
session_start();
// connect
require 'config/connection.php';
?>

<!DOCTYPE html>
<html lang="en">
<?php require('./template/header.php') ?>


<div class="flex flex-col min-h-screen p-8 gap-6 px-36">
    <div class="  overflow-hidden">

        <div class=" bg-accent p-6 rounded-t-3xl">

            <div class="flex justify-center">
                <img
                    src="https://media2.giphy.com/media/v1.Y2lkPTc5MGI3NjExMjZpMTd0b2lsMzhrMmdxZjJmd2E3bTlrYjJuZGl5N3R1MDl1a3BucSZlcD12MV9pbnRlcm5hbF9naWZfYnlfaWQmY3Q9Zw/10bxTLrpJNS0PC/giphy.gif"
                    alt="Profile Image"
                    class="w-24 h-24 rounded-full border-4 border-white object-cover">
            </div>

            <div class="mt-4 text-center">
                <h2 class="text-2xl font-bold text-white">Ali Yousif</h2>
            </div>
        </div>



        <div class="flex flex-col gap-6 p-4 bg-white rounded-b-3xl">

            <div class="flex justify-between items-center border-b border-gray-200 pb-3">
                <span class="text-gray-500 font-medium">Email</span>
                <span class="text-gray-700 text-right">example@gmail.com</span>
            </div>

            <div class="flex justify-between items-center border-b border-gray-200 pb-3">
                <span class="text-gray-500 font-medium">Address</span>
                <span class="text-gray-700 text-right">Dammam, 2313, Khaleej Street</span>
            </div>

            <div class="flex justify-between items-center">
                <span class="text-gray-500 font-medium">Username</span>
                <span class="text-gray-700 text-right">iexample</span>
            </div>
        </div>
    </div>

    <?php require('../BurgerRiza/orders.php') ?>

</div>

</div>
<?php require('./template/footer.php') ?>

</html>
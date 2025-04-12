<!DOCTYPE html>
<html lang="en">
    <?php require('./template/header.php') ?>
    <div class="container mx-auto p-7 min-h-screen">
        <h1 class="text-3xl font-bold mb-6 text-center">Orders</h1>
        <div class="bg-gradient-to-br from-red-500 via-orange-400 to-yellow-300 p-4 rounded-2xl shadow-lg">
            <div class="bg-white p-8 rounded-2xl">

                <div class="flex justify-between items-center bg-gray-200 px-4 py-2 font-semibold text-gray-700 border-b rounded-t-2xl">
                    <div class="w-1/4 text-center">Order ID</div>
                    <div class="w-1/4 text-center">Number of Items</div>
                    <div class="w-1/4 text-center">Price</div>
                    <div class="w-1/4 text-center">Date</div>
                </div>

                <?php foreach ([1, 2, 3, 4, 5, 6, 7] as $order) : ?>
                    <div class="flex justify-between items-center px-4 py-4 border-b transition-transform duration-200 ease-in-out transform hover:scale-105 hover:shadow-xl cursor-pointer hover:border-0 hover:bg-orange-400 hover:rounded-2xl hover:text-white">
                        <div class="w-1/4 text-center">123123</div>
                        <div class="w-1/4 text-center">3</div>
                        <div class="w-1/4 text-center">500SAR</div>
                        <div class="w-1/4 text-center">2025/05/01</div>
                    </div>
                <?php endforeach; ?>
            </div>
        </div>
    </div>
    <?php require('./template/footer.php') ?>
</html>

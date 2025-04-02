<!DOCTYPE html>
<html lang="en">

<?php require('./template/header.php') ?>
<?php if ($_SESSION['Role'] === "C") { ?>
    <div class="p-7 min-h-screen">
        <div class=" flex flex-col gap-2.5">
        <h1 class="text-2xl font-bold ml-11">Orders</h1>
        <div class="flex flex-col gap-1.5 bg-gradient-to-br from-red-500 via-orange-400 to-yellow-300 p-2 rounded-2xl justify-center">
            <div class="bg-white flex flex-col gap-2 p-1.5 rounded-2xl">
                <table class="table-auto text-center">
                    <thead class="border-b-2">
                        <tr class="">
                        <th>Order ID</th>
                        <th>Number of Items</th>
                        <th>Price</th>
                        <th>Date</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr class="hover:bg-orange-300">
                            <td>123123</td>
                            <td>3</td>
                            <td>500SAR</td>
                            <td>2025/5/1</td>
                        </tr>
                        <tr class="hover:bg-orange-300">
                            <td>142344</td>
                            <td>5</td>
                            <td>1000SAR</td>
                            <td>2025/7/2</td>
                            </tr>
                        <tr class="hover:bg-orange-300">
                            <td>238948</td>
                            <td>2</td>
                            <td>200SAR</td>
                            <td>2025/9/1</td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
        </div>
    </div>
<?php } else {
  header('Location:index.php');
} ?>
<?php require('./template/footer.php') ?>
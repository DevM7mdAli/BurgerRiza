<!DOCTYPE html>
<html lang="en">

<?php require('./template/header.php') ?>
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
                        <?php foreach ([1, 2, 3, 4, 56, 6, 3, 4, 5, 6, 7] as $hello) { ?>
                            <tr class="hover:bg-orange-300">
                                <td class="p-6">123123</td>
                                <td class="p-6">3</td>
                                <td class="p-6">500SAR</td>
                                <td class="p-6">2025/5/1</td>
                            </tr>
                        <?php
                        }
                        ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
<?php require('./template/footer.php') ?>
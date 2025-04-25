<?php
session_start();
require 'utils/auth-functions/guest-kick-to-log.php';
require 'config/connection.php';

// Combined query to get user info and orders in one request
$sql = "SELECT u.*, o.id as order_id, o.total as order_total, o.created_at,
        (SELECT COUNT(*) FROM cart_item ci 
        INNER JOIN cart c ON ci.cart_id = c.id 
        WHERE c.user_id = o.user_id AND c.restaurant_id = o.restaurant_id) as item_count
        FROM user u
        LEFT JOIN order_table o ON u.id = o.user_id
        WHERE u.id = ?
        ORDER BY o.created_at DESC";

if ($stmt = mysqli_prepare($con, $sql)) {
    mysqli_stmt_bind_param($stmt, 'i', $_SESSION['id']);
    if (mysqli_stmt_execute($stmt)) {
        $result = mysqli_stmt_get_result($stmt);
        $rows = mysqli_fetch_all($result, MYSQLI_ASSOC);

        // First row contains user info
        $info = array_intersect_key($rows[0], array_flip(['id', 'first_name', 'last_name', 'email', 'phone', 'account_role', 'avatar']));

        // Filter out rows with order information
        $orders = array_filter($rows, function ($row) {
            return !empty($row['order_id']);
        });

        mysqli_stmt_close($stmt);
        mysqli_close($con);
    } else {
        echo 'Error in prepare statement execute: ' . mysqli_error($con);
    }
} else {
    echo 'Error in connection: ' . mysqli_error($con);
}
?>

<!DOCTYPE html>
<html lang="en">
<?php require('./template/header.php') ?>


<div class="flex flex-col min-h-screen p-8 gap-6 px-36">
    <div class="  overflow-hidden">

        <div class=" bg-accent p-6 rounded-t-3xl">

            <div class="flex justify-center">
                <img
                    src="<?php echo $info['avatar'] ?>"
                    alt="Profile Image"
                    class="w-24 h-24 rounded-full border-4 border-white p-2 bg-white object-contain">
            </div>

            <div class="mt-4 text-center">
                <h2 class="text-2xl font-bold text-white"> <?php echo $info['first_name'] . ' ' . $info['last_name'] ?> </h2>
            </div>
        </div>



        <div class="flex flex-col gap-6 p-4 bg-white rounded-b-3xl">

            <div class="flex justify-between items-center border-b border-gray-200 pb-3">
                <span class="text-gray-500 font-medium">First name</span>
                <span class="text-gray-700 text-right"> <?php echo $info['first_name'] ?> </span>
            </div>

            <div class="flex justify-between items-center border-b border-gray-200 pb-3">
                <span class="text-gray-500 font-medium">Last name</span>
                <span class="text-gray-700 text-right"> <?php echo $info['last_name'] ?> </span>
            </div>

            <div class="flex justify-between items-center border-b border-gray-200 pb-3">
                <span class="text-gray-500 font-medium">Email</span>
                <span class="text-gray-700 text-right"> <?php echo $info['email'] ?> </span>
            </div>

            <div class="flex justify-between items-center border-b border-gray-200 pb-3">
                <span class="text-gray-500 font-medium">Phone</span>
                <span class="text-gray-700 text-right"> <?php echo $info['phone'] ?> </span>
            </div>

            <div class="flex justify-between items-center border-gray-200 pb-3">
                <span class="text-gray-500 font-medium">Account</span>
                <span class="text-gray-700 text-right"> <?php echo $info['account_role'] ?> </span>
            </div>

        </div>
    </div>

    <?php require('./template/account/orders.php') ?>

</div>

</div>
<?php require('./template/footer.php') ?>

</html>
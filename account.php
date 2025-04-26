<?php
session_start();
require 'utils/auth-functions/guest-kick-to-log.php';
require 'config/connection.php';

// First get the user info
$sql = "SELECT * FROM user WHERE id = ?";
$stmt = mysqli_prepare($con, $sql);
mysqli_stmt_bind_param($stmt, 'i', $_SESSION['id']);
mysqli_stmt_execute($stmt);
$result = mysqli_stmt_get_result($stmt);
$info = mysqli_fetch_assoc($result);

// Different queries based on user role
if ($info['account_role'] === 'owner') {
    // For restaurant owners - get orders made to their restaurant
    $sql = "SELECT o.id as order_id, o.total as order_total, o.created_at,
            i.notes,
            customer.first_name, customer.last_name, customer.email,
            r.name as restaurant_name,
            (SELECT COUNT(*) FROM cart_item ci 
            INNER JOIN cart c ON ci.cart_id = c.id 
            WHERE c.restaurant_id = r.id) as item_count
            FROM restaurant r
            INNER JOIN order_table o ON r.id = o.restaurant_id
            INNER JOIN invoice i ON o.id = i.order_id
            INNER JOIN user customer ON o.user_id = customer.id
            WHERE r.owner_id = ?
            ORDER BY o.created_at DESC";
} else {
    // For customers - get their personal orders
    $sql = "SELECT o.id as order_id, o.total as order_total, o.created_at,
            i.notes,
            r.name as restaurant_name,
            (SELECT COUNT(*) FROM cart_item ci 
            INNER JOIN cart c ON ci.cart_id = c.id 
            WHERE c.user_id = o.user_id AND c.restaurant_id = o.restaurant_id) as item_count
            FROM order_table o
            INNER JOIN restaurant r ON o.restaurant_id = r.id
            INNER JOIN invoice i ON o.id = i.order_id
            WHERE o.user_id = ?
            ORDER BY o.created_at DESC";
}

// Get orders
$stmt = mysqli_prepare($con, $sql);
mysqli_stmt_bind_param($stmt, 'i', $_SESSION['id']);
mysqli_stmt_execute($stmt);
$result = mysqli_stmt_get_result($stmt);
$orders = mysqli_fetch_all($result, MYSQLI_ASSOC);

mysqli_close($con);
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
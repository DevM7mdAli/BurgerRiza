<?php
session_start();
// connect
require 'config/connection.php';

// fetch all burgerz 
if ($_SESSION['Role'] === "R") {
  $query = "SELECT * FROM burgers WHERE user_added_id={$_SESSION['cUserId']}  ORDER BY created_at";
} else {
  $query = "SELECT user_id , user_name  FROM user WHERE account_type='R' ORDER BY user_time_created";
}

$result = mysqli_query($con, $query);

// taking the result as assos array
$output = mysqli_fetch_all($result, MYSQLI_ASSOC);

mysqli_free_result($result);

mysqli_close($con);
?>


<!DOCTYPE html>
<html lang="en">

<?php require('./template/header.php') ?>


<?php if ($_SESSION['Role'] === "R") {
  require('./template/index/restaurant.php');
} elseif ($_SESSION['Role'] === "C") {
  require('./template/index/customer.php');
} else {
  header('Location:sign-in.php');
} ?>


<?php require('./template/footer.php') ?>

</html>
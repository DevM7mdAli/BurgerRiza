<?php
session_start();

require 'config/connection.php';


// Check if user is logged in and role is set
if (!isset($_SESSION['role'])) {
  header('Location: sign-in.php');
  exit();
}

// fetch all burgerz 
if ($_SESSION['role'] === "owner") {
  $query = "SELECT p.*
  FROM product p
  INNER JOIN restaurant r ON r.id = p.owner_id
  INNER JOIN user u ON u.id = r.owner_id
  WHERE u.id = {$_SESSION['id']}
  ORDER BY p.time_created
  ";
} else {
  $query = "SELECT * FROM restaurant";
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


<?php if ($_SESSION['role'] === "owner") {
  require('./template/index/restaurant.php');
} else {
  require('./template/index/customer.php');
}
?>

<?php require('./template/footer.php') ?>

</html>
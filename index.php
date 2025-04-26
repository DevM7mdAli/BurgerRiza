<?php
session_start();
require 'utils/upload-file.php';

require 'config/connection.php';


// Check if user is logged in and role is set
if (!isset($_SESSION['role'])) {
  header('Location: sign-in.php');
  exit();
}

// fetch all products or restaurants
if ($_SESSION['role'] === "owner") {
  // First check if owner has a restaurant
  $checkRestaurantQuery = "SELECT id FROM restaurant WHERE owner_id = ?";
  if ($checkStmt = mysqli_prepare($con, $checkRestaurantQuery)) {
    mysqli_stmt_bind_param($checkStmt, 'i', $_SESSION['id']);
    mysqli_stmt_execute($checkStmt);
    $checkResult = mysqli_stmt_get_result($checkStmt);
    $hasRestaurant = mysqli_fetch_assoc($checkResult);
    if ($hasRestaurant) {
      $_SESSION['owner'] = $hasRestaurant['id'];
    }
    mysqli_stmt_close($checkStmt);

    if ($hasRestaurant) {
      $query = "SELECT p.*
      FROM product p
      INNER JOIN restaurant r ON r.id = p.restaurant_id
      INNER JOIN user u ON u.id = r.owner_id
      WHERE u.id = ?
      ORDER BY p.time_created";

      if ($stmt = mysqli_prepare($con, $query)) {
        mysqli_stmt_bind_param($stmt, 'i', $_SESSION['id']);
        mysqli_stmt_execute($stmt);
        $result = mysqli_stmt_get_result($stmt);
        $output = mysqli_fetch_all($result, MYSQLI_ASSOC);
        mysqli_stmt_close($stmt);
      }
    }
  }
} else {
  $query = "SELECT * FROM restaurant";
  $result = mysqli_query($con, $query);
  $output = mysqli_fetch_all($result, MYSQLI_ASSOC);
  mysqli_free_result($result);
}

// Making restaurant
if (isset($_POST['create_restaurant'])) {
  $name = mysqli_real_escape_string($con, $_POST['name']);
  $address = mysqli_real_escape_string($con, $_POST['address']);
  $phone = mysqli_real_escape_string($con, $_POST['phone']);
  $img = $_FILES['img'];

  $imgPath = uploadFile('uploads/rest', $img);

  $sql = "INSERT INTO restaurant (name, address, phone, img, owner_id) VALUES (?, ?, ?, ?, ?)";

  if ($stmt = mysqli_prepare($con, $sql)) {
    mysqli_stmt_bind_param($stmt, 'ssssi', $name, $address, $phone, $imgPath, $_SESSION['id']);
    if (mysqli_stmt_execute($stmt)) {
      header('Location: index.php');
      exit();
    }
    mysqli_stmt_close($stmt);
  }
}

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
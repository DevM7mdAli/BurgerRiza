<?php
session_start();
require './config/connection.php';



if (isset($_GET['restaurant_id']) && $_SESSION['Role'] === "C") {
  $id = mysqli_real_escape_string($con, $_GET['restaurant_id']);

  $sql = "SELECT id , burgerName , burger_price , Extras , quantity , user_name name FROM burgers b , user u WHERE b.user_added_id = ? AND u.user_id = ?";

  if ($prStmt = mysqli_prepare($con, $sql)) {
    mysqli_stmt_bind_param($prStmt, 'ii', $id, $id);
    if (mysqli_stmt_execute($prStmt)) {
      $result = mysqli_stmt_get_result($prStmt);
      $output = mysqli_fetch_all($result,  MYSQLI_ASSOC);
      mysqli_stmt_close($prStmt);
      mysqli_close($con);
    } else {
      echo 'error in statement' . mysqli_error($con);
    }
  } else {
    echo 'error in connection' . mysqli_error($con);
  }
} else {
  header('Location:index.php');
}

?>


<!DOCTYPE html>
<html lang="en">

<?php require('./template/header.php') ?>

<div class="flex flex-col gap-y-12 px-64 pt-8">
  <?php if (!empty($output)) { ?>
    <h1 class="text-center text-xl font-bold">Welcome to <?php echo $output[0]['name'] ?> Menu</h1>
    <?php foreach ($output as $burger) : ?>
      <div class="flex flex-col justify-around gap-2  px-2 py-8 bg-white rounded-xl">
        <h1 id="burgerName"> Burger Name: <?php echo htmlspecialchars($burger['burgerName']) ?> </h1>
        <div id="Extras" class="flex flex-wrap"> Extras: <?php foreach (explode(',', $burger['Extras']) as $Extra) { ?>
            <div class="px-2"> <?php echo htmlspecialchars($Extra) . " , " ?> </div>
          <?php  } ?>
        </div>
        <h1 id="burgerPrice"> Burger price: <?php echo htmlspecialchars($burger['burger_price']) . "$" ?> </h1>
        <h1 id="quantity"> Burger price: <?php echo htmlspecialchars($burger['quantity']) ?> </h1>

        <div class="text-red-500 border-t-4">
          <a href="details.php?id=<?php echo $burger['id'] ?>">Add to cart</a>
        </div>
      </div>

    <?php endforeach; ?>
  <?php } else { ?>
    <div class="text-4xl text-center pt-40 font-bold">
      The menu is empty you will be redirected to the list of restaurant
    </div>
    <?php
    header('Refresh: 5; url=index.php');
    ?>
  <?php } ?>


</div>

<?php require('./template/footer.php') ?>

</html>
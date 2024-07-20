<?php
session_start();
// connect
require 'config/connection.php';

// fetch all burgerz 
if (!empty($_SESSION['cUserId'])) {

  $query = "SELECT * FROM burgers WHERE user_added_id={$_SESSION['cUserId']}  ORDER BY created_at";
} else {
  $query = "SELECT * FROM burgers WHERE quantity != 0 ORDER BY created_at";
}

$result = mysqli_query($con, $query);

// taking the result as assos array
$burgerz = mysqli_fetch_all($result, MYSQLI_ASSOC);


mysqli_free_result($result);

mysqli_close($con);



?>


<!DOCTYPE html>
<html lang="en">

<?php require('./template/header.php') ?>


<div class="text-3xl text-center p-12">
  <h1 class="pb-8 font-bold">main menu</h1>

  <div class="grid grid-cols-3 gap-4" id="theBody">
    <?php foreach ($burgerz as $burger) : ?>

      <div class="flex flex-col justify-around gap-2  px-2 py-8 bg-white rounded-xl">
        <h1 id="burgerName"> Burger Name: <?php echo htmlspecialchars($burger['burgerName']) ?> </h1>
        <div id="Extras" class="flex justify-center flex-wrap"> Extras: <?php foreach (explode(',', $burger['Extras']) as $Extra) { ?>
            <div class="px-2"> <?php echo htmlspecialchars($Extra) . " , " ?> </div>
          <?php  } ?>
        </div>
        <h1 id="burgerName"> Burger price: <?php echo htmlspecialchars($burger['burger_price']) . "$" ?> </h1>

        <div class="text-red-500 border-t-4">
          <a href="details.php?id=<?php echo $burger['id'] ?>">more info</a>
        </div>
      </div>

    <?php endforeach; ?>
  </div>

</div>



<?php require('./template/footer.php') ?>

</html>
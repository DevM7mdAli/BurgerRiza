<?php
session_start();
// connect
require 'config/connection.php';

// fetch all burgerz 

$query = 'SELECT * FROM burgers ORDER BY created_at';

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
  main menu

  <div class="flex flex-row justify-around items-center flex-wrap gap-4" id="theBody">
    <?php foreach ($burgerz as $burger) : ?>

      <div class="flex flex-col gap-2  px-2 py-8 bg-white rounded-xl">
        <h1 id="burgerName"> Burger Name: <?php echo htmlspecialchars($burger['burgerName']) ?> </h1>
        <div id="Extras" class="flex flex-wrap"> Extras: <?php foreach (explode(',', $burger['Extras']) as $Extra) { ?>
            <div class="px-2"> <?php echo htmlspecialchars($Extra) ?> </div>
          <?php  } ?>
        </div>

        <div class="text-red-500 border-t-4">
          <a href="details.php?id=<?php echo $burger['id'] ?>">more info</a>
        </div>
      </div>

    <?php endforeach; ?>
  </div>

</div>



<?php require('./template/footer.php') ?>

</html>
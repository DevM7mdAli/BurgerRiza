<?php
session_start();
// connect
require 'config/connection.php';

if (isset($_POST['delete'])) {
  $id_to_delete = mysqli_real_escape_string($con, $_POST['id_to_delete']);

  $sql = "DELETE FROM burgers WHERE id=$id_to_delete";

  if (mysqli_query($con, $sql)) {
    header('Location:index.php');
  } else {
    echo 'error in query' . mysqli_error($con);
  }
}


if (isset($_GET['id'])) {
  $id = mysqli_real_escape_string($con, $_GET['id']);

  $sql = "SELECT * FROM burgers WHERE id=$id";

  $result = mysqli_query($con, $sql);

  $burger = mysqli_fetch_assoc($result);

  mysqli_free_result($result);
  mysqli_close($con);
}


?>



<!DOCTYPE html>
<html lang="en">

<?php require('./template/header.php') ?>

<div>
  <?php if ($burger) : ?>

    <h1 class="text-2xl text-center p-4">
      Details
    </h1>

    <div id="allInfo" class="flex flex-col items-center justify-center gap-8 text-lg py-4">
      <h1>ID: <?php echo htmlspecialchars($burger['id']) ?></h1>
      <h2>name of the burger: <?php echo htmlspecialchars($burger['burgerName']) ?></h2>
      <h2>Extras: <?php echo htmlspecialchars($burger['Extras']) ?></h2>
      <h3>email of person who created it: <?php echo htmlspecialchars($burger['email']) ?></h3>
      <p>created_at: <?php echo htmlspecialchars(date($burger['created_at'])) ?></p>


      <form action="details.php" method="POST">
        <input type="hidden" name="id_to_delete" value="<?php echo $burger['id'] ?>">
        <input type="submit" name="delete" value="Delete" class="p-4 text-xl font-semibold mt-2 bg-red-500 rounded-xl text-white">
      </form>
    </div>

  <?php else : ?>
    <h1 class="text-5xl text-center p-4"> Error not found </h1>

  <?php endif ?>


</div>



<?php require('./template/footer.php') ?>

</html>
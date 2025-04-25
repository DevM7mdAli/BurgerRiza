<?php
session_start();
require 'utils/auth-functions/guest-kick-to-log.php';

require 'config/connection.php';

// edit the detail
if (isset($_POST['edit']) && isset($_GET['id'])) {
  $productId = mysqli_real_escape_string($con, $_GET['id']);
  $productName = mysqli_real_escape_string($con, $_POST['productName']);
  $productPrice = mysqli_real_escape_string($con, $_POST['productPrice']);
  $quantity = mysqli_real_escape_string($con, $_POST['productQuantity']);

  $sql = 'UPDATE product SET name = ? , price = ?, quantity = ? WHERE id = ?';

  if ($prStmt = mysqli_prepare($con, $sql)) {
    mysqli_stmt_bind_param($prStmt, 'sdii', $productName, $productPrice, $quantity, $productId);
    if (mysqli_stmt_execute($prStmt)) {
    } else {
      echo 'error';
    }
  }
}

// deleting the product
if (isset($_POST['delete'])) {
  $id_to_delete = mysqli_real_escape_string($con, $_POST['id_to_delete']);

  $sql = "DELETE FROM product WHERE id = ?";

  if ($prStmt =  mysqli_prepare($con, $sql)) {
    mysqli_stmt_bind_param($prStmt, 'i', $id_to_delete);
    if (mysqli_stmt_execute($prStmt)) {
      header('Location:index.php');
    } else {
      echo 'error in statement' . mysqli_error($con);
    }
  } else {
    echo 'error in connection' . mysqli_error($con);
  }
}

// getting the info
if (isset($_GET['id'])) {
  $id = mysqli_real_escape_string($con, $_GET['id']);

  $sql = "SELECT * FROM product WHERE id = ?";

  if ($prStmt = mysqli_prepare($con, $sql)) {
    mysqli_stmt_bind_param($prStmt, 'i', $id);
    if (mysqli_stmt_execute($prStmt)) {
      $result = mysqli_stmt_get_result($prStmt);
      $product = mysqli_fetch_assoc($result);
      mysqli_stmt_close($prStmt);
      mysqli_close($con);
    } else {
      echo 'error in statement' . mysqli_error($con);
    }
  } else {
    echo 'error in connection' . mysqli_error($con);
  }
}

# security check
require 'utils/not-found/details-not-found.php'


?>



<!DOCTYPE html>
<html lang="en">

<?php require('./template/header.php') ?>

<div class="flex flex-col justify-center min-h-screen">


  <h1 class="text-4xl font-bold text-center p-4">
    Details
  </h1>
  <div class="flex justify-end mx-24">
    <button onclick="toggle()" class=" w-16 h-16 mt-2 " id="edit"><img src="assets/edit.png" alt="edit"></button>
    <button onclick="toggle()" class=" w-16 h-16 mt-2 hidden" id="cancel"><img src="assets/cancel.png" alt="cancel"></button>
  </div>


  <div id="allInfo" class="flex flex-col justify-center gap-8 text-lg mx-24 p-3">

    <!--Displaying for when first enter no change just to delete -->
    <div id="showDetails" class="p-8 bg-primary rounded-lg">
      <div class="flex flex-col items-start gap-8 text-lg">
        <img src="<?php echo $product['img'] ?? 'assets/burger.png' ?>" alt="<?php echo htmlspecialchars($product['name']) ?>" class="w-full">
        <h1>ID: <?php echo htmlspecialchars($product['id']) ?></h1>
        <h2>name of the product: <?php echo htmlspecialchars($product['name']) ?></h2>
        <h2>price of the product: <?php echo htmlspecialchars($product['price']) ?>$</h2>
        <h2>quantity of the product: <?php echo htmlspecialchars($product['quantity']) ?></h2>
        <p>created_at: <?php echo htmlspecialchars(date($product['time_created'])) ?></p>
        <!-- delete button -->
        <?php if (!empty($_SESSION['firstName']) && !empty($_SESSION['owner'])) { ?>
          <?php if ($product['restaurant_id'] === $_SESSION['owner']) { ?>
            <form
              action="<?php echo $_SERVER['PHP_SELF'] ?>"
              method="POST"
              id="del"
              class="flex flex-grow w-full">
              <input type="hidden" name="id_to_delete" value="<?php echo $product['id'] ?>">
              <input type="submit" name="delete" value="Delete" class="p-4 text-xl font-semibold mt-2 bg-red-500 rounded-xl text-white flex flex-grow">
            </form>
          <?php } ?>
        <?php } ?>
      </div>
    </div>

    <!-- Form body to change -->
    <form
      class="flex-col items-start justify-center gap-8 text-lg hidden p-8 bg-primary rounded-lg"
      id="editDetails"
      action="<?php echo $_SERVER['PHP_SELF'] . '?id=' . $product['id'] ?>"
      method="POST">
      <div
        class="w-full"
        onmouseover="document.getElementById('notAllowedImg').classList.toggle('hidden')"
        onmouseout="document.getElementById('notAllowedImg').classList.toggle('hidden')">
        <img src="<?php echo $product['img'] ?? 'assets/burger.png' ?>" alt="<?php echo htmlspecialchars($product['name']) ?>" class="w-full" />
        <p class="text-sm text-red-500 hidden" id="notAllowedImg">the img is not allowed to be changed</p>
      </div>
      <div
        onmouseover="document.getElementById('notAllowed').classList.toggle('hidden')"
        onmouseout="document.getElementById('notAllowed').classList.toggle('hidden')">
        <h1>
          ID: <?php echo htmlspecialchars($product['id']) ?>
        </h1>
        <p class="text-sm text-red-500 hidden" id="notAllowed">the id is not allowed to be changed</p>
      </div>
      <!-- list of inputs  -->
      <label>name of the product:
        <input
          type="text"
          name="productName"
          class="p-0.5 border-2 rounded-md bg-primary"
          value="<?php echo htmlspecialchars($product['name']) ?>">
      </label>
      <label>price of the product:
        <input
          type="text"
          name="productPrice"
          class="p-0.5 border-2 rounded-md bg-primary"
          value="<?php echo htmlspecialchars($product['price']) ?>">
      </label>
      <label>quantity of the product:
        <input
          type="text"
          name="productQuantity"
          class="p-0.5 border-2 rounded-md bg-primary"
          size="7"
          value="<?php echo htmlspecialchars($product['quantity']) ?>">
      </label>

      <div
        onmouseover="document.getElementById('notAllow').classList.toggle('hidden')"
        onmouseout="document.getElementById('notAllow').classList.toggle('hidden')">
        <p>
          created_at: <?php echo htmlspecialchars(date($product['time_created'])) ?>
        </p>
        <p class="text-sm text-red-500 hidden" id="notAllow">the created_at is not allowed to be changed</p>
      </div>
      <input
        type="submit"
        value="Confirm"
        name="edit"
        class="w-full p-4 text-xl font-semibold mt-2 bg-red-500 rounded-xl text-white">
    </form>
  </div>

  <script src="JS/detailsScript.js"></script>
</div>



<?php require('./template/footer.php') ?>

</html>
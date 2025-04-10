<?php
session_start();
// connect
require 'config/connection.php';

// "/^[a-zA-Z -]+$/"

// edit the detail
if (isset($_POST['edit']) && isset($_GET['id'])) {
  $burgerId = mysqli_real_escape_string($con, $_GET['id']);
  $burgerName = mysqli_real_escape_string($con, $_POST['burgerName']);
  $burgerPrice = mysqli_real_escape_string($con, $_POST['burgerPrice']);
  $extras = mysqli_real_escape_string($con, $_POST['extras']);
  $quantity = mysqli_real_escape_string($con, $_POST['burgerQuantity']);

  $sql = 'UPDATE burgers SET burgerName = ? , burger_price = ? , Extras = ? , quantity = ? WHERE id = ?';

  if ($prStmt = mysqli_prepare($con, $sql)) {
    mysqli_stmt_bind_param($prStmt, 'sdsii', $burgerName, $burgerPrice, $extras, $quantity, $burgerId);
    if (mysqli_stmt_execute($prStmt)) {
    } else {
      echo 'error';
    }
  }
}

// deleting the burger
if (isset($_POST['delete'])) {
  $id_to_delete = mysqli_real_escape_string($con, $_POST['id_to_delete']);

  $sql = "DELETE FROM burgers WHERE id = ?";

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

  $sql = "SELECT * FROM burgers WHERE id = ?";

  if ($prStmt = mysqli_prepare($con, $sql)) {
    mysqli_stmt_bind_param($prStmt, 'i', $id);
    if (mysqli_stmt_execute($prStmt)) {
      $result = mysqli_stmt_get_result($prStmt);
      $burger = mysqli_fetch_assoc($result);
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
if (!$burger) {
  echo "<h1 class=\"text-5xl text-center p-4\"> Error not found </h1>";
  exit;
}

if (empty($_SESSION['cUserId']) || $burger['user_added_id'] != $_SESSION['cUserId']) {
  echo "<h1 class=\"text-5xl text-center p-4\">You don't have the auth</h1>";
  exit;
}


?>



<!DOCTYPE html>
<html lang="en">

<?php require('./template/header.php') ?>

<div class="flex flex-col justify-center min-h-screen">


  <h1 class="text-4xl font-bold text-center p-4">
    Details
  </h1>
  <div class="flex justify-end mx-24">
    <button onclick="toggle()" class=" w-16 h-16 mt-2 " id="edit"><img src="https://static.thenounproject.com/png/5926334-200.png" alt="edit"></button>
    <button onclick="toggle()" class=" w-16 h-16 mt-2 hidden" id="cancel"><img src="https://static.thenounproject.com/png/966946-200.png" alt="cancel"></button>
  </div>


  <div id="allInfo" class="flex flex-col justify-center gap-8 text-lg mx-24 p-3">

    <!--Displaying for when first enter no change just to delete -->
    <div id="showDetails" class="p-8 bg-primary rounded-lg">
      <div class="flex flex-col items-start gap-8 text-lg">
        <h1>ID: <?php echo htmlspecialchars($burger['id']) ?></h1>
        <h2>name of the burger: <?php echo htmlspecialchars($burger['burgerName']) ?></h2>
        <h2>price of the burger: <?php echo htmlspecialchars($burger['burger_price']) ?>$</h2>
        <h2>quantity of the burger: <?php echo htmlspecialchars($burger['quantity']) ?></h2>
        <h2>Extras: <?php echo htmlspecialchars($burger['Extras']) ?></h2>
        <h3>email of person who created it: <?php echo htmlspecialchars($burger['email']) ?></h3>
        <p>created_at: <?php echo htmlspecialchars(date($burger['created_at'])) ?></p>
        <!-- delete button -->
        <?php if (!empty($_SESSION['userName']) && !empty($_SESSION['cUserEmail'])) { ?>
          <?php if ($burger['email'] === $_SESSION['cUserEmail']) { ?>
            <form
              action="<?php echo $_SERVER['PHP_SELF'] ?>"
              method="POST"
              id="del"
              class="flex flex-grow w-full">
              <input type="hidden" name="id_to_delete" value="<?php echo $burger['id'] ?>">
              <input type="submit" name="delete" value="Delete" class="p-4 text-xl font-semibold mt-2 bg-red-500 rounded-xl text-white flex flex-grow">
            </form>
          <?php } ?>
        <?php } ?>
      </div>
    </div>

    <!-- Form body to change -->
    <form
      class=" flex-col items-start justify-center gap-8 text-lg hidden p-8 bg-primary rounded-lg"
      id="editDetails"
      action="<?php echo $_SERVER['PHP_SELF'] . '?id=' . $burger['id'] ?>"
      method="POST">
      <div>
        <h1
          onmouseover="document.getElementById('notAllowed').classList.toggle('hidden')"
          onmouseout="document.getElementById('notAllowed').classList.toggle('hidden')">
          ID: <?php echo htmlspecialchars($burger['id']) ?>
        </h1>
        <p class="text-sm text-red-500 hidden" id="notAllowed">the id is not allowed to be changed</p>
      </div>
      <!-- list of inputs  -->
      <label>name of the burger:
        <input
          type="text"
          name="burgerName"
          class="p-0.5 border-2 rounded-md bg-primary"
          value="<?php echo htmlspecialchars($burger['burgerName']) ?>">
      </label>
      <label>price of the burger:
        <input
          type="text"
          name="burgerPrice"
          class="p-0.5 border-2 rounded-md bg-primary"
          value="<?php echo htmlspecialchars($burger['burger_price']) ?>">
      </label>
      <label>quantity of the burger:
        <input
          type="text"
          name="burgerQuantity"
          class="p-0.5 border-2 rounded-md bg-primary"
          size="7"
          value="<?php echo htmlspecialchars($burger['quantity']) ?>">
      </label>
      <div class="flex flex-col gap-4 items-center">
        <?php $index = 1;
        foreach (explode(',', $burger['Extras']) as $burg) { ?>
          <div class="flex gap-3" id="extras-<?php echo $index ?>">
            <h2>Extras: <input onkeyup="collectExtras()" type="text"
                class="p-0.5 border-2 rounded-md bg-primary" id="extrasIn" value="<?php echo htmlspecialchars($burg) ?>"></h2>
            <div class="flex flex-wrap items-center gap-1">
              <span onclick="console.log('test')" class="px-4 text-lg font-semibold bg-red-500 rounded-xl text-white">+</span>
              <span onclick="console.log('test')" class="px-4 text-lg font-semibold bg-blue-500 rounded-xl text-white">-</span>
            </div>
          </div>
        <?php $index++;
        } ?>
        <input type="text" class="hidden" name="extras" id="totalExtras">
      </div>
      <div>
        <h3
          onmouseover="document.getElementById('notAllowEmail').classList.toggle('hidden')"
          onmouseout="document.getElementById('notAllowEmail').classList.toggle('hidden')">
          email of person who created it: <?php echo htmlspecialchars($burger['email']) ?>
        </h3>
        <p class="text-sm text-red-500 hidden" id="notAllowEmail">the email is not allowed to be changed</p>
      </div>
      <div>
        <p
          onmouseover="document.getElementById('notAllow').classList.toggle('hidden')"
          onmouseout="document.getElementById('notAllow').classList.toggle('hidden')">
          created_at: <?php echo htmlspecialchars(date($burger['created_at'])) ?>
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
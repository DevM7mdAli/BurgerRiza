<?php
session_start();
require 'config/connection.php';

if (empty($_SESSION['cUserEmail']) && empty($_SESSION['userName']) && $_SESSION['Role'] !== "R") {
  echo "<div class=\"p-24 text-4xl font-bold\">
          Sorry guest are not allowed to enter
        </div>";
  exit;
}

$errors = array('BurgerName' => '', 'price' => '', 'Extras' => '', 'quantity' => '');
$burName = $price = $Extras = $quantity =  '';
if (isset($_POST['submit']) && !empty($_SESSION['userName'])) {

  if (empty($_POST['BurgerName'])) {
    $errors['BurgerName'] = "burger name required" . "<br />";
  } else {
    $burName = htmlspecialchars($_POST['BurgerName']);
    if (!preg_match('/^[a-zA-Z\s]+$/', $burName)) {
      $errors['BurgerName'] = "burger name must be letters only" . "<br />";
    }
  }

  if (empty($_POST['Extras'])) {
    $errors['Extras'] = "Extras required" . "<br />";
  } else {
    $Extras = htmlspecialchars($_POST['Extras']);
    if (!preg_match('/^([a-zA-Z\s]+)(,\s*[a-zA-Z\s]*)*$/', $Extras)) {
      $errors['Extras'] = 'extras must be separated by comma' . "<br />";
    }
  }

  if (empty($_POST['price'])) {
    $errors['price'] = "price required" . "<br />";
  } else {
    $price = htmlspecialchars($_POST['price']);
    if (!preg_match('/(0|([1-9][0-9]*))(\\.[0-9]+)?/', $price)) {
      $errors['price'] = 'price must be a number' . "<br />";
    } else {
      if ($price <= 0) {
        $errors['price'] = 'price must be a positive' . "<br />";
      }
    }
  }


  if (empty($_POST['quantity'])) {
    $errors['quantity'] = "quantity required" . "<br />";
  } else {
    $quantity = htmlspecialchars($_POST['quantity']);
    if (!preg_match('/^[1-9]\d*$/', $quantity)) {
      $errors['quantity'] = 'quantity must be a number' . "<br />";
    } else {
      if ($quantity <= 0) {
        $errors['quantity'] = 'quantity must be a positive' . "<br />";
      }
    }
  }

  if (!array_filter($errors)) {
    $burName = mysqli_real_escape_string($con, $_POST['BurgerName']);
    $price = mysqli_real_escape_string($con, $_POST['price']);
    $Extras = mysqli_real_escape_string($con, $_POST['Extras']);

    //sql to insert
    $sql = "INSERT INTO burgers (email , burgerName , burger_price , quantity , Extras , user_added_id) VALUES (? , ? , ? , ? , ? , ?)";

    if ($prStmt = mysqli_prepare($con, $sql)) {
      mysqli_stmt_bind_param($prStmt, "ssdisi", $_SESSION['cUserEmail'], $burName, $price, $quantity, $Extras, $_SESSION['cUserId']);
      if (mysqli_stmt_execute($prStmt)) {
        header('Location:index.php');
      } else {
        echo 'error in the prepare statement ' . mysqli_error($con);
      }
    } else {
      echo 'error in the connection ' . mysqli_error($con);
    }
  }
} // end of 

?>



<!DOCTYPE html>
<html lang="en">

<?php require('./template/header.php') ?>

<style>
  /* Chrome, Safari, Edge, Opera */
  input::-webkit-outer-spin-button,
  input::-webkit-inner-spin-button {
    -webkit-appearance: none;
    margin: 0;
  }

  /* Firefox */
  input[type=number] {
    -moz-appearance: textfield;
  }
</style>
<section class="text-3xl text-center p-12 flex flex-col justify-center px-24  gap-4 min-h-screen">
  Add form
  <form class="flex flex-col justify-center items-start gap-y-4 bg-white rounded-lg p-8" action="<?php echo $_SERVER['PHP_SELF'] ?>" method="POST" id="addForm">

    <div class="w-full flex">
      <input type="submit" name="submit" value="submit" class="p-4 text-xl font-semibold mt-2 bg-red-500 rounded-xl text-white w-full">
    </div>
  </form>
  <div class="py-4 text-red-400 flex flex-col">
    <div>
      <?php echo $errors['BurgerName'] ?>
    </div>
    <div>
      <?php echo $errors['price'] ?>
    </div>
    <div>
      <?php echo $errors['Extras'] ?>
    </div>
  </div>
  </div>
</section>

<script>
  const inputs = [{
      "type": "text",
      "name": "Burger name",
      "code": "BurgerName",
      "value": "<?php echo htmlspecialchars($burName) ?>"

    },
    {
      "type": "number",
      "name": "price",
      "value": "<?php echo htmlspecialchars($price) ?>"

    },
    {
      "type": "number",
      "name": "quantity",
      "value": "<?php echo htmlspecialchars($quantity) ?>"
    },
    {
      "type": "text",
      "name": "Extras",
      "value": "<?php echo htmlspecialchars($Extras) ?>"
    },
  ]

  const form = document.getElementById("addForm")
  inputs.reverse()
  for (const input of inputs) {
    const label = document.createElement("label")
    label.textContent = input.name + ":"
    label.className = "flex justify-start w-full"
    const inField = document.createElement("input")
    inField.className = "border-2 rounded-md p-1 text-xl w-full"
    inField.placeholder = input.name
    inField.value = input.value
    inField.name = input.code ? input.code : input.name
    inField.id = inField.name
    inField.type = input.type
    if (inField.name == "price") {
      inField.step = "0.01"
    }
    inField.required = true
    form.prepend(inField)
    form.prepend(label)
  }
</script>

<?php require('./template/footer.php') ?>

</html>
<?php
session_start();
require 'config/connection.php';

$errors = array('BurgerName' => '', 'Extras' => '');
$burName = $Extras = '';
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
      $errors['Extras'] = 'Title must be separated by comma' . "<br />";
    }
  }

  if (!array_filter($errors)) {
    $burName = mysqli_real_escape_string($con, $_POST['BurgerName']);
    $Extras = mysqli_real_escape_string($con, $_POST['Extras']);

    //sql to insert

    $sql = "INSERT INTO burgers (email , burgerName , Extras , user_added_id) VALUES ('" . $_SESSION['cUserEmail'] . "' , '$burName' , '$Extras' , '" . $_SESSION['cUserId'] . "')";

    if (mysqli_query($con, $sql)) {
      header('Location:index.php');
    } else {
      echo 'error in the connection ' . mysqli_error($$con);
    }
  }
} // end of 

?>



<!DOCTYPE html>
<html lang="en">

<?php require('./template/header.php') ?>

<?php if (!empty($_SESSION['cUserEmail']) && !empty($_SESSION['userName'])) { ?>
  <section class="text-3xl text-center p-12 flex flex-col justify-center items-center gap-4">
    Add form
    <div class=" bg-white rounded-lg p-8 ">
      <form class="flex flex-col justify-center items-start gap-y-4" action="<?php echo $_SERVER['PHP_SELF'] ?>" method="POST" id="addForm">

        <div class="w-full flex justify-center">
          <input type="submit" name="submit" value="submit" class="p-4 text-xl font-semibold mt-2 bg-red-500 rounded-xl text-white">
        </div>
      </form>
      <div class="py-4 text-red-400 flex flex-col">
        <div>
          <?php echo $errors['BurgerName'] ?>
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
        "value": "<?php echo $burName ?>"

      },
      {
        "type": "text",
        "name": "Extras",
        "value": "<?php echo $Extras ?>"
      },
    ]

    const form = document.getElementById("addForm")
    inputs.reverse()
    for (const input of inputs) {
      const label = document.createElement("label")
      label.textContent = input.name + ":"
      label.className = "flex justify-start w-full"
      const inField = document.createElement("input")
      inField.className = "border-2 p-1 text-xl w-full"
      inField.placeholder = input.name
      inField.value = input.value
      inField.name = input.code ? input.code : input.name
      inField.id = inField.name
      inField.type = input.type
      form.prepend(inField)
      form.prepend(label)
    }
  </script>
<?php } else { ?>
  <div class="p-24 text-4xl font-bold">
    Sorry guest are not allowed to enter
  </div>

<?php } ?>

<?php require('./template/footer.php') ?>

</html>
<?php
session_start();
require 'config/connection.php';

$errors = array('email' => '', 'BurgerName' => '', 'Extras' => '');
$email = $burName = $Extras = '';
if (isset($_POST['submit'])) {
  if (empty($_POST['email'])) {
    $errors['email'] = "email required" . "<br />";
  } else {
    $email = htmlspecialchars($_POST['email']);
    if (!filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)) {
      $errors['email'] = "email must be valid" . "<br />";
    }
  }
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
    $email = mysqli_real_escape_string($con, $_POST['email']);
    $burName = mysqli_real_escape_string($con, $_POST['BurgerName']);
    $Extras = mysqli_real_escape_string($con, $_POST['Extras']);

    //sql to insert

    $sql = "INSERT INTO burgers (email , burgerName , Extras) VALUES ('$email' , '$burName' , '$Extras')";

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
        <?php echo $errors['email'] ?>
      </div>
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
      "name": "email",
    },
    {
      "type": "text",
      "name": "Burger name",
      "code": "BurgerName"

    },
    {
      "type": "text",
      "name": "Extras"
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
    inField.name = input.code ? input.code : input.name
    inField.id = inField.name
    inField.type = input.type
    form.prepend(inField)
    form.prepend(label)
  }
</script>


<?php require('./template/footer.php') ?>

</html>
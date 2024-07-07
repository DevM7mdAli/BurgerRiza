<?php
session_start();

require './config/connection.php';



if (isset($_POST['submit'])) {
  $email = mysqli_real_escape_string($con, $_POST['email']);
  $username = mysqli_real_escape_string($con, $_POST['userName']);
  $fName = mysqli_real_escape_string($con, $_POST['FName']);
  $lName = mysqli_real_escape_string($con, $_POST['LName']);
  $pwd = mysqli_real_escape_string($con, $_POST['pwd']);
  $cPwd = mysqli_real_escape_string($con, $_POST['confirmPassword']);


  if ($pwd === $cPwd) {
    $enPwd = md5($pwd);
    $sql = "INSERT INTO user (email , user_password , user_name , first_name , last_name ) VALUES ( ? , ? , ? , ? , ?)";

    if ($prStmt = mysqli_prepare($con, $sql)) {
      mysqli_stmt_bind_param($prStmt, 'sssss', $email, $enPwd, $username, $fName, $lName);
      if (mysqli_stmt_execute($prStmt)) {
        mysqli_stmt_close($prStmt);
        mysqli_close($con);
        header('Location:sign-in.php');
      } else {
        echo 'error in the prepare statement ' . mysqli_error($con);
      }
    } else {
      echo 'error in the connection ' . mysqli_error($con);
    }
  }
}






?>



<!DOCTYPE html>
<html lang="en">

<?php require('./template/header.php') ?>

<?php if (empty($_SERVER['userName']) && empty($_SESSION['cUserEmail'])) { ?>

  <div class="flex flex-col justify-center items-center gap-y-8 pb-4">
    <h1 class="text-4xl pt-12">
      Sign Up
    </h1>

    <form action="<?php echo $_SERVER['PHP_SELF'] ?>" method="POST" class="pb-12 flex flex-col justify-center items-center w-1/2 gap-y-4">
      <div>
        <label for="Email">Email</label>
        <input type="email" class="border-2 p-1 text-xl w-full" name="email" id="Email" value="">

        <label for="UserName">UserName</label>
        <input type="text" class="border-2 p-1 text-xl w-full" name="userName" id="UserName">

        <label for="FirstName">First name</label>
        <input type="text" class="border-2 p-1 text-xl w-full" name="FName" id="FirstName">

        <label for="LastName">Last name</label>
        <input type="text" class="border-2 p-1 text-xl w-full" name="LName" id="LastName">

        <label for="PassWord">Password</label>
        <input type="password" class="border-2 p-1 text-xl w-full" name="pwd" id="PassWord">

        <label for="ConfirmPass">Confirm password</label>
        <input type="password" class="border-2 p-1 text-xl w-full" name="confirmPassword" id="ConfirmPass">
      </div>



      <input type="submit" value="Sign Up" name="submit" class="p-4 text-xl font-semibold mt-2 bg-red-500 rounded-xl text-white">

      <div class="text-lg">
        You have an account ?
        <a href="sign-in.php" class="font-bold text-red-500">sign in now</a>
      </div>
    </form>
    <?php echo $error ?? "" ?>
  </div>
<?php } else {
  header('Location:index.php');
} ?>

<?php require('./template/footer.php') ?>
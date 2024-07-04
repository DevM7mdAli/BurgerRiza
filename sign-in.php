<?php
session_start();
require 'config/connection.php';
if (isset($_POST['submit'])) {

  $email = mysqli_escape_string($con, $_POST['email']);
  $password = mysqli_escape_string($con, $_POST['password']);
  $enPwd = md5($password);
  $error;

  $sql = "SELECT * FROM user WHERE email='$email' AND user_password='$enPwd'";

  $result = mysqli_query($con, $sql);

  $user = mysqli_fetch_assoc($result);

  if ($user) {
    $_SESSION['userName'] = $user['user_name'];
    $_SESSION['cUserEmail'] = $user['email'];
    $_SESSION['cUserId'] = $user['user_id'];
    header('Location:index.php');
  } else {
    $error = "failed to log in with these infos:<br /> email : $email <br />  password : $password";
  }

  mysqli_free_result($result);
  mysqli_close($con);
}





?>



<!DOCTYPE html>
<html lang="en">

<?php require('./template/header.php') ?>


<?php if (empty($_SERVER['userName']) && empty($_SESSION['cUserEmail'])) { ?>
  <div class="flex flex-col justify-center items-center gap-y-8 pb-4">
    <h1 class="text-4xl pt-12">
      Sign In
    </h1>

    <form action="<?php echo $_SERVER['PHP_SELF'] ?>" method="POST" class="pb-12 flex flex-col justify-center items-center w-full gap-y-4">
      <div>
        <label for="Email">Email</label>
        <input type="text" class="border-2 p-1 text-xl w-full" name="email" id="Email">
        <label for="PassWord">Password</label>
        <input type="password" class="border-2 p-1 text-xl w-full" name="password" id="PassWord">
      </div>

      <input type="submit" value="Log In" name="submit" class="p-4 text-xl font-semibold mt-2 bg-red-500 rounded-xl text-white">

      <div class="text-lg">
        You don't have an account ?
        <a href="sign-up.php" class="font-bold text-red-500">sign up now</a>
      </div>
    </form>
    <?php echo $error ?? "" ?>
  </div>
<?php } else {
  header('Location:index.php');
} ?>

<?php require('./template/footer.php') ?>
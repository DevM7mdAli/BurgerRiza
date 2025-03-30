<?php
session_start();

require './config/connection.php';

if (isset($_POST['submit'])) {
  $email = mysqli_real_escape_string($con, $_POST['email']);
  $username = mysqli_real_escape_string($con, $_POST['userName']);
  $fName = mysqli_real_escape_string($con, $_POST['FName']);
  $lName = mysqli_real_escape_string($con, $_POST['LName']);
  $pwd = mysqli_real_escape_string($con, $_POST['pwd']);
  $accountType = mysqli_real_escape_string($con, $_POST['type']);
  $cPwd = mysqli_real_escape_string($con, $_POST['confirmPassword']);


  if ($pwd === $cPwd) {
    $enPwd = md5($pwd);


    $sql = "INSERT INTO user (email , user_password , account_type , user_name , first_name , last_name ) VALUES ( ? , ? , ? , ? , ? , ?)";

    if ($prStmt = mysqli_prepare($con, $sql)) {
      if (strtoupper($accountType) === "R") {
        $type = "R";
      } else {
        $type = "C";
      }
      mysqli_stmt_bind_param($prStmt, 'ssssss', $email, $enPwd, $type, $username, $fName, $lName);
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
} ?>



<!DOCTYPE html>
<html lang="en">

<?php require('./template/header.php') ?>

<?php if (empty($_SERVER['userName']) && empty($_SESSION['cUserEmail'])) { ?>
  <main class="flex items-center justify-center min-h-screen bg-gradient-to-br from-red-500 via-orange-400 to-yellow-300">
    <div class="flex flex-col justify-center max-w-sm w-full bg-opacity-95 items-center gap-y-8 p-8 bg-white rounded-lg">
      <h1 class="text-4xl pt-12">
        Sign Up
      </h1>

      <form action="<?php echo $_SERVER['PHP_SELF'] ?>" method="POST" class="flex flex-col justify-center items-center gap-y-4">
        <div>
          <!-- User Inputs -->
          <div class="flex justify-between">
            <label for="Restaurant">
              <input type="radio" id="Restaurant" name="type" value="R" required checked>
              restaurant
            </label>
            <label for="Customers">
              <input type="radio" id="Customers" name="type" value="C">
              customer</label>
          </div>

          <section class="flex flex-col gap-y-4 py-4">
            <label for="Email">Email
              <input
                type="email"
                class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-red-500"
                name="email"
                id="Email"
                placeholder="Example@example.com"
                value=""
                required>
            </label>

            <label for="UserName">UserName
              <input
                type="text"
                class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-red-500"
                name="userName"
                id="UserName"
                placeholder="UserName"
                required>
            </label>

            <label for="FirstName">First name
              <input
                type="text"
                class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-red-500"
                name="FName"
                id="FirstName"
                placeholder="First name"
                required>
            </label>

            <label for="LastName">Last name
              <input
                type="text"
                class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-red-500"
                name="LName"
                id="LastName"
                placeholder="Last name"
                required>
            </label>

            <label for="PassWord">Password
              <input
                type="password"
                class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-red-500"
                name="pwd"
                id="PassWord"
                placeholder="•••••••"
                required>
            </label>

            <label for="ConfirmPass">Confirm password
              <input
                type="password"
                class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-red-500"
                name="confirmPassword"
                id="ConfirmPass"
                placeholder="•••••••"
                required>
            </label>
          </section>
        </div>

        <!-- Final button -->
        <input
          type="submit"
          value="Sign Up"
          name="submit"
          class="w-full bg-red-500 text-white py-2 rounded-lg font-bold hover:bg-orange-400 transition-transform transform hover:scale-105">

        <div class="text-lg">
          You have an account ?
          <a href="sign-in.php" class="font-bold text-red-500">sign in now</a>
        </div>
      </form>
      <?php echo $error ?? "" ?>
    </div>
  </main>
<?php } else {
  header('Location:index.php');
} ?>

<?php require('./template/footer.php') ?>
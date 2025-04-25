<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
session_start();
//! kicking out if authed
require 'utils/auth-functions/auth-kick-out-of-log.php';

require 'config/connection.php';

if (isset($_POST['submit'])) {

  $email = mysqli_escape_string($con, $_POST['email']);
  $password = mysqli_escape_string($con, $_POST['password']);
  $accountType = mysqli_real_escape_string($con, $_POST['type']);
  $enPwd = md5($password);
  $error = "";

  $sql = "SELECT * FROM user WHERE email = ? AND password = ? AND account_role = ?";

  if ($prStmt = mysqli_prepare($con, $sql)) {
    if (strtolower($accountType) === "owner") {
      $type = "owner";
    } else {
      $type = "customer";
    }
    mysqli_stmt_bind_param($prStmt, 'sss', $email, $enPwd, $type);
    if (mysqli_stmt_execute($prStmt)) {
      $result = mysqli_stmt_get_result($prStmt);
      $user = mysqli_fetch_assoc($result);
      mysqli_stmt_close($prStmt);
      mysqli_close($con);
    } else {
      echo sprintf('Error in statement: %s', mysqli_error($con));
    }
  } else {
    echo 'error in connection' . mysqli_error($con);
  }

  if ($user) {
    $_SESSION['firstName'] = $user['first_name'];
    $_SESSION['email'] = $user['email'];
    $_SESSION['id'] = $user['id'];
    $_SESSION['role'] = $user['account_role'];
    $_SESSION['avatar'] = $user['avatar'];
    if (isset($_POST['remember'])) {
      $remember = $_POST['remember'];
      setcookie('remember_email', $user['email'], time() + 3600 * 24 * 365);
      setcookie('remember', $remember, time() + 3600 * 24 * 365);
    } else {
      setcookie('remember_email', '', time() - 3600);
      setcookie('remember', '', time() - 3600);
    }
    header('Location:index.php');
  } else {
    $error = "failed to log in with these infos:<br /> email : $email <br />  password : $password";
  }
}
?>



<!DOCTYPE html>
<html lang="en">

<?php require('./template/header.php') ?>


<div class="flex items-center justify-center min-h-screen bg-gradient-to-br from-red-500 via-orange-400 to-yellow-300">
  <div class="bg-white bg-opacity-95 backdrop-blur-md p-8 rounded-lg shadow-lg max-w-sm w-full text-center">
    <img src="./assets/Logo.png" alt="BurgerRiza Logo" class="w-20 mx-auto mb-4 rounded-full bg-white p-1 shadow-md">
    <h2 class="text-2xl font-bold text-red-500 mb-2">Welcome Back!</h2>
    <p class="text-gray-600 mb-6">Please log in to your account</p>

    <form action="<?php echo $_SERVER['PHP_SELF'] ?>" method="POST">
      <div class="text-left">
        <!-- User Inputs -->
        <div class="flex justify-between">
          <label for="Restaurant">
            <input
              type="radio"
              id="Restaurant"
              name="type"
              value="owner"
              required
              checked>
            restaurant
          </label>
          <label for="Customers">
            <input
              type="radio"
              id="Customers"
              name="type"
              value="customer">
            customer</label>
        </div>

        <section class="flex flex-col gap-y-4 py-4">
          <label for="email" class="block text-sm font-medium text-gray-700">Email
            <input
              type="email"
              id="email"
              name="email"
              value="<?php echo $_COOKIE['remember_email'] ?? '' ?>"
              placeholder="Enter your email"
              required
              class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-red-500">
          </label>

          <div class="text-left">
            <label for="password" class="block text-sm font-medium text-gray-700">Password
              <div class="relative">
                <input
                  type="password"
                  id="password"
                  name="password"
                  placeholder="•••••••"
                  required
                  class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-red-500">
                <input
                  class="absolute inset-y-0 right-3 flex items-center cursor-pointer text-gray-500 toggle-password"
                  onclick="togglePassword()"
                  type="button"
                  value="👁️" />
              </div>
            </label>
          </div>
        </section>
      </div>

      <input
        type="submit"
        name="submit"
        value="Log in"
        class="w-full bg-red-500 text-white py-2 rounded-lg font-bold hover:bg-orange-400 transition-transform transform hover:scale-105" />

      <label for="remember">
        Remember me
        <input type="checkbox" name="remember" <?php echo isset($_COOKIE['remember']) ? 'checked' : ''; ?> />
      </label>
    </form>
    <?php echo $error ?? "" ?>
    <p class="text-sm text-gray-600 mt-4">Don't have an account? <a href="sign-up.php" class="text-red-500 hover:underline">Sign Up</a></p>
  </div>
</div>

<!-- script of function  -->
<script src="JS/sign-in/password-toggle.js"></script>

<?php require('./template/footer.php') ?>
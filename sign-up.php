<?php
session_start();
//! kicking out if authed
require 'utils/auth-functions/auth-kick-out-of-log.php';
require 'utils/upload-file.php';

require './config/connection.php';

if (isset($_POST['submit'])) {
  $email = mysqli_real_escape_string($con, $_POST['email']);
  $avatar = $_FILES["avatar"];
  $firstName = mysqli_real_escape_string($con, $_POST['firstName']);
  $lastName = mysqli_real_escape_string($con, $_POST['lastName']);
  $phone = mysqli_real_escape_string($con, $_POST['phone']);
  $pwd = mysqli_real_escape_string($con, $_POST['pwd']);
  $accountType = mysqli_real_escape_string($con, $_POST['type']);
  $cPwd = mysqli_real_escape_string($con, $_POST['confirmPassword']);

  $target_file = 'uploads/' . basename($avatar["name"]);

  if ($pwd === $cPwd) {
    $enPwd = md5($pwd);
    $sql = "INSERT INTO user (email, password, account_role, first_name, last_name, avatar, phone) VALUES (?, ?, ?, ?, ?, ?, ?)";

    if ($prStmt = mysqli_prepare($con, $sql)) {
      if (strtoupper($accountType) === "owner") {
        $type = "owner";
      } else {
        $type = "customer";
      }
      mysqli_stmt_bind_param($prStmt, 'sssssss', $email, $enPwd, $type, $firstName, $lastName, $target_file, $phone);
      if (mysqli_stmt_execute($prStmt)) {
        uploadFile('uploads/', $avatar);
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

<main class="flex items-center justify-center min-h-screen bg-gradient-to-br from-red-500 via-orange-400 to-yellow-300">
  <div class="flex flex-col justify-center max-w-sm w-full bg-opacity-95 items-center gap-y-8 p-8 bg-white rounded-lg">
    <h1 class="text-4xl pt-12">
      Sign Up
    </h1>

    <form action="<?php echo $_SERVER['PHP_SELF'] ?>" method="POST" class="flex flex-col justify-center items-center gap-y-4" enctype="multipart/form-data">
      <div>
        <!-- User Inputs -->
        <div class="flex justify-between">
          <label for="Restaurant">
            <input type="radio" id="Restaurant" name="type" value="owner" required checked>
            restaurant
          </label>
          <label for="Customers">
            <input type="radio" id="Customers" name="type" value="customer">
            customer
          </label>
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

          <label for="firstName">First name
            <input
              type="text"
              class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-red-500"
              name="firstName"
              id="firstName"
              placeholder="First name"
              required>
          </label>

          <label for="lastName">Last name
            <input
              type="text"
              class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-red-500"
              name="lastName"
              id="lastName"
              placeholder="Last name"
              required>
          </label>

          <label for="phone">Phone
            <input
              type="phone"
              class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-red-500"
              name="phone"
              maxlength="20"
              id="phone"
              placeholder="+996 5x xxx xxxx"
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

          <label for="file">Put your avatar
            <input
              type="file"
              class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-red-500"
              name="avatar"
              id="avatar"
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

<?php require('./template/footer.php') ?>
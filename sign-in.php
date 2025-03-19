<?php
session_start();
require 'config/connection.php';
if (isset($_POST['submit'])) {

  $email = mysqli_escape_string($con, $_POST['email']);
  $password = mysqli_escape_string($con, $_POST['password']);
  $accountType = mysqli_real_escape_string($con, $_POST['type']);
  $enPwd = md5($password);
  $error = "";

  echo $email . $password . $accountType;

  $sql = "SELECT * FROM user WHERE email = ? AND user_password = ? AND account_type = ?";

  if ($prStmt = mysqli_prepare($con, $sql)) {
    if (strtoupper($accountType) === "R") {
      $type = "R";
    } else {
      $type = "C";
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
    $_SESSION['userName'] = $user['user_name'];
    $_SESSION['cUserEmail'] = $user['email'];
    $_SESSION['cUserId'] = $user['user_id'];
    $_SESSION['Role'] = $user['account_type'];
    header('Location:index.php');
  } else {
    $error = "failed to log in with these infos:<br /> email : $email <br />  password : $password";
  }
}
?>



<!DOCTYPE html>
<html lang="en">

<?php require('./template/header.php') ?>


<?php if (empty($_SESSION['userName']) && empty($_SESSION['cUserEmail'])) { ?>
  <div class="flex items-center justify-center min-h-screen bg-gradient-to-br from-red-500 via-orange-400 to-yellow-300">
    <div class="bg-white bg-opacity-95 backdrop-blur-md p-8 rounded-lg shadow-lg max-w-sm w-full text-center">
      <img src="./assets/Logo.png" alt="BurgerRiza Logo" class="w-20 mx-auto mb-4 rounded-full bg-white p-1 shadow-md">
      <h2 class="text-2xl font-bold text-red-500 mb-2">Welcome Back!</h2>
      <p class="text-gray-600 mb-6">Please log in to your account</p>

      <form action="<?php echo $_SERVER['PHP_SELF'] ?>" method="POST" class="space-y-4">
        <div class="text-left">
            <input type="radio" id="Restaurant" name="type" value="R" required>
            <label for="Restaurant">restaurant</label>
            <input type="radio" id="Customers" name="type" value="C">
            <label for="Customers">customer</label>


          <label for="email" class="block text-sm font-medium text-gray-700 mb-1">Email</label>
          <input type="email" id="email" name="email" placeholder="Enter your email" required
            class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-red-500">
        </div>

        <div class="text-left">
          <label for="password" class="block text-sm font-medium text-gray-700 mb-1">Password</label>
          <div class="relative">
            <input type="password" id="password" name="password" placeholder="•••••••" required
              class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-red-500">
            <button class="absolute inset-y-0 right-3 flex items-center cursor-pointer text-gray-500 toggle-password" onclick="togglePassword()">👁️</button>
          </div>
        </div>

        <input type="submit" name="submit" value="Log in"
          class="w-full bg-red-500 text-white py-2 rounded-lg font-bold hover:bg-orange-400 transition-transform transform hover:scale-105" />
      </form>
      <?php echo htmlspecialchars($error ?? "", ENT_QUOTES, 'UTF-8') ?>
      <p class="text-sm text-gray-600 mt-4">Don't have an account? <a href="sign-up.php" class="text-red-500 hover:underline">Sign Up</a></p>
    </div>
  </div>
  <script>
    function togglePassword(event) {
      event.preventDefault();
      const password = document.getElementById('password');
      const toggle = document.querySelector('.toggle-password');

      if (password.type === "password") {
        password.type = "text";
        toggle.textContent = "🙈";
      } else {
        password.type = "password";
        toggle.textContent = "👁️";
      }
    }
  </script>
<?php } else {
  header('Location:index.php');
} ?>

<?php require('./template/footer.php') ?>
<?php
define('APPNAME', 'BurgerRiza');

if (isset($_POST['logOut'])) {
  session_unset();
  session_destroy();
  header('Location:index.php');
}
?>

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="icon" href="../assets/Logo.png" type="image/x-icon">
  <title><?php APPNAME ?></title>
  <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="bg-orange-50">
  <!-- navbar start  -->
  <nav id="nav" class="sticky flex justify-between  py-5  px-4  bg-red-500 w-full top-0 left-0 z-30 ">
    <a href="index.php" class="flex items-center font-bold">
      <img src="assets/Logo.png" alt="Logo" class="w-12 h-12">
      <?php echo APPNAME ?>
    </a>

    <ul class="flex items-center gap-14 font-bold text-lg">
      <li>
        Hello <?php echo  $_SESSION['userName'] ?? "guest" ?>
      </li>
      <li>
        <a href="#" class="text-white">menu</a>
      </li>
      <li>
        <a href="add.php" class="text-white">add to BurgerRiza</a>
      </li>
      <?php if (empty($_SESSION['userName'])) { ?>
        <li>
          <a href="sign-in.php" class="bg-white py-4 px-8 rounded-lg text-red-500 text-xl">sign</a>
        </li>
      <?php } else { ?>
        <form action="<?php echo $_SERVER['PHP_SELF'] ?>" method="POST">
          <input type="submit" name="logOut" value="Log out" class="bg-white py-4 px-8 rounded-lg text-red-500 text-xl">
        </form>

      <?php } ?>
  </nav>
  <!-- navbar end  -->
<?php
define('APPNAME', 'BurgerRiza');

if (isset($_POST['logOut'])) {
  session_unset();
  session_destroy();
  header('Location:index.php');
}
$navList = [
  [
    'name' => "Add to your menu",
    'url' => "add.php"
  ],
  [
    'name' => "cart",
    'url' => "cart.php"
  ]
];
?>

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="icon" href="../assets/Logo.png" type="image/x-icon">
  <title><?php APPNAME ?></title>
  <script src="https://cdn.tailwindcss.com"></script>
  <script>
    tailwind.config = {
      theme: {
        extend: {
          colors: {
            clifford: '#da373d',
          }
        }
      }
    }
  </script>
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

      <?php if (empty($_SESSION['Role'])) { ?>

      <?php } elseif ($_SESSION['Role'] === "R") { ?>
        <li>
          <a href=<?php echo $navList[0]['url'] ?> class="text-white"><?php echo $navList[0]['name'] ?></a>
        </li>
      <?php } else { ?>
        <li>
          <a href=<?php echo $navList[1]['url'] ?> class="text-white"><?php echo $navList[1]['name'] ?></a>
        </li>
      <?php } ?>

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
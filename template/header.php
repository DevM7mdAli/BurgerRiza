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
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Open+Sans:ital,wght@0,300..800;1,300..800&display=swap" rel="stylesheet">
  <style>
    body {
      font-family: "Open Sans", sans-serif;
      font-optical-sizing: auto;
      font-weight: 400;
      font-style: normal;
      font-variation-settings:
        "wdth" 100;
    }
  </style>
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
  <nav id="nav" class="sticky flex justify-between py-5 px-4 bg-gradient-to-r from-red-700 via-orange-500 to-yellow-600 shadow-lg w-full top-0 left-0 z-30 ">
    <a href="index.php" class="flex items-center font-bold text-white">
      <img src="assets/Logo.png" alt="Logo" class="w-12 h-12">
      <?php echo APPNAME ?>
    </a>

    <ul class="flex items-center gap-14 font-bold text-lg text-white">
      <li>
        Hello <?php echo $_SESSION['userName'] ?? "guest" ?>
      </li>

      <?php if (empty($_SESSION['Role'])) { ?>

      <?php } elseif ($_SESSION['Role'] === "R") { ?>
        <li>
          <a href=<?php echo $navList[0]['url'] ?> class="hover:underline"><?php echo $navList[0]['name'] ?></a>
        </li>
      <?php } else { ?>
        <li>
          <a href=<?php echo $navList[1]['url'] ?> class="hover:underline"><?php echo $navList[1]['name'] ?></a>
        </li>
      <?php } ?>

      <?php if (empty($_SESSION['userName'])) { ?>
        <li>
          <a href="sign-in.php" class="bg-white py-4 px-8 rounded-lg text-red-600 text-xl hover:bg-gray-200">Sign In</a>
        </li>
      <?php } else { ?>
        <form action="<?php echo $_SERVER['PHP_SELF'] ?>" method="POST">
          <input type="submit" name="logOut" value="Log out" class="bg-white py-4 px-8 rounded-lg text-red-600 text-xl hover:bg-gray-200 cursor-pointer">
        </form>
      <?php } ?>
    </ul>
  </nav>
  <!-- navbar end  -->
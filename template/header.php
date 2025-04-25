<?php
define('APPNAME', 'BurgerRiza');

if (isset($_POST['logOut'])) {
  session_unset();
  session_destroy();
  header('Location:index.php');
  exit;
}
$navList;
if (!empty($_SESSION['role'])) {
  if ($_SESSION['role'] === "owner") {
    $navList = [
      'Add to your menu' => "add.php",
    ];
  } else {
    $navList = [
      'cart' => "cart.php",
    ];
  }
}
?>

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="icon" href="assets/Logo.png" type="image/x-icon">
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Open+Sans:ital,wght@0,300..800;1,300..800&display=swap" rel="stylesheet">
  <title><?php echo APPNAME ?></title>
  <link href="./CSS/output.css" rel="stylesheet">
</head>

<body class="bg-orange-50">
  <?php
  //? navbar start 
  ?>
  <nav id="nav" class="sticky flex flex-col w-full top-0 left-0 z-30 ">
    <div class="flex justify-between items-center py-5 px-4 bg-gradient-to-r from-red-700 via-orange-500 to-yellow-600 shadow-lg">
      <button class="sm:hidden flex flex-col justify-center p-2 gap-2 bg-primary/20 rounded-lg" onclick="toggleMobileMenu()">
        <span class="bg-primary h-1 w-8 rounded-xl"></span>
        <span class="bg-primary h-1 w-8 rounded-xl"></span>
        <span class="bg-primary h-1 w-8 rounded-xl"></span>
      </button>

      <div class="flex items-center">
        <a href="index.php" class="flex items-center font-bold text-white">
          <img src="assets/Logo.png" alt="Logo" class="w-12 h-12">
          <p class="hidden sm:block"><?php echo APPNAME ?></p>
        </a>
      </div>

      <div class="flex items-center gap-3">
        <div>
          <a class="flex items-center gap-14 font-bold text-lg text-white bg-primary/20 rounded-2xl p-2" href="account.php">
            <div class="flex items-center gap-1">
              <img src="<?php echo $_SESSION['avatar'] ?? "assets/Logo.png" ?>" class="w-12 h-12 rounded-full object-contain bg-gray-400 p-0.5" />
              <p class="text-sm sm:text-lg"> Hello <?php echo $_SESSION['firstName'] ?? "guest" ?></p>
            </div>
          </a>
        </div>
        <?php
        //? desktop buttons
        ?>
        <div class="hidden sm:block">
          <div class="flex gap-3 items-center">
            <?php if (!empty($_SESSION['role'])) { ?>
              <?php foreach ($navList as $title => $link) {  ?>
                <div>
                  <a href=<?php echo $link ?> class="hover:underline py-2 px-4 bg-white rounded-lg"><?php echo $title ?></a>
                </div>
              <?php } ?>
            <?php
            }
            ?>

            <?php if (empty($_SESSION['firstName'])) { ?>
              <div>
                <a href="sign-in.php" class="bg-red-600 text-white py-2 px-4 rounded-lg hover:bg-red-700">Sign In</a>
              </div>
            <?php } else { ?>
              <form action="<?php echo $_SERVER['PHP_SELF'] ?>" method="POST">
                <input type="submit" name="logOut" value="Log out" class="bg-red-600 text-white py-2 px-4 rounded-lg hover:bg-red-700 cursor-pointer w-full">
              </form>
            <?php } ?>
          </div>
        </div>
      </div>


    </div>
    <?php
    //? mobile menu start
    ?>
    <div class="hidden bg-white shadow-lg p-4" id="menuMobileBody">
      <ul class="space-y-4">
        <?php if (!empty($_SESSION['role'])) { ?>
          <?php foreach ($navList as $title => $link) {  ?>
            <li>
              <a href=<?php echo $link ?> class="hover:underline"><?php echo $title ?></a>
            </li>
          <?php } ?>
        <?php
        }
        ?>

        <?php if (empty($_SESSION['firstName'])) { ?>
          <li>
            <a href="sign-in.php" class="bg-red-600 text-white py-2 px-4 rounded-lg hover:bg-red-700">Sign In</a>
          </li>
        <?php } else { ?>
          <form action="<?php echo $_SERVER['PHP_SELF'] ?>" method="POST">
            <input type="submit" name="logOut" value="Log out" class="bg-red-600 text-white py-2 px-4 rounded-lg hover:bg-red-700 cursor-pointer w-full">
          </form>
        <?php } ?>
      </ul>
    </div>
    <?php
    //? mobile menu end
    ?>
  </nav>
  <script src="./JS/toggleNav.js"></script>
  <?php
  //? navbar end 
  ?>
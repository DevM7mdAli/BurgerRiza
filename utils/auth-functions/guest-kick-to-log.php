<?php if (empty($_SESSION['userName'])) {
  header('Location:index.php');
  die;
}

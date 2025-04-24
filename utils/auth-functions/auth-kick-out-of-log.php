<?php if (!empty($_SESSION['firstName'])) {
  header('Location:index.php');
  die;
}

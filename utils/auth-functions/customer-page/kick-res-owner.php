<?php
if ($_SESSION['Role'] !== "C") {
  header('Location:index.php');
  die;
}

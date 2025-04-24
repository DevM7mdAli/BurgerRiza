<?php
if ($_SESSION['role'] !== "customer") {
  header('Location:index.php');
  die;
}

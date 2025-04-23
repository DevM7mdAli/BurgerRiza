<?php
if ($_SESSION['Role'] !== "R") {
  echo "<div style='padding: 6rem; font-size: 2.25rem; font-weight: bold;'>
          Sorry only owners are allowed to enter
        </div>";
  header('Refresh: 5; url=index.php');
  die;
}

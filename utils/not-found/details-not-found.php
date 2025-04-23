<?php
#first check if exist
if (!$burger) {
  echo "<h1 class=\"text-5xl text-center p-4\"> Error not found </h1>";
  exit;
}


#Check if he has auth to see
if (empty($_SESSION['cUserId']) || $burger['user_added_id'] != $_SESSION['cUserId']) {
  echo "<h1 class=\"text-5xl text-center p-4\">You don't have the auth</h1>";
  exit;
}

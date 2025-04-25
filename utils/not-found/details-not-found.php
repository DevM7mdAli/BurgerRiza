<?php
#first check if exist
if (!$product) {
  echo "<h1 class=\"text-5xl text-center p-4\"> Error not found </h1>";
  exit;
}


#Check if he has auth to see
if (empty($_SESSION['owner']) || $product['restaurant_id'] != $_SESSION['owner']) {
  echo "<h1 class=\"text-5xl text-center p-4\">You don't have the auth</h1>";
  exit;
}

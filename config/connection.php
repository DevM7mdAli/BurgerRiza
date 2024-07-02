<?php

$hostName = 'localhost';
$userName = 'Burgerz';
$userPassword = 'BRizza1234@';
$dbName = 'burgerriza';
$portNum = 3399;


$con = mysqli_connect($hostName, $userName, $userPassword, $dbName, $portNum);

if (!$con) {
  echo "connect error" . mysqli_connect_errno();
}

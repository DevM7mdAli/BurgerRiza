<?php

$hostName = 'localhost';
$userName = 'root';
$userPassword = '';
$dbName = 'riza';
$portNum = 3309;

$con = mysqli_connect($hostName, $userName, $userPassword, $dbName, $portNum);

if (!$con) {
  echo ("Connection failed: " . mysqli_connect_error());
}

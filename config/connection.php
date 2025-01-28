<?php

$hostName = 'localhost';
$userName = 'Burgerz';
$userPassword = 'BRizza1234@';
$dbName = 'burgerriza';
$portNum = 3306;

$con = mysqli_connect($hostName, $userName, $userPassword, $dbName, $portNum);

if (!$con) {
  die("Connection failed: " . mysqli_connect_error());
}

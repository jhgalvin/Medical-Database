
<?php

$dbServerName = "localhost";
$dbUserName = "user";
$dbPassword = "password";
$dbName = "meddb";

$conn = mysqli_connect($dbServerName, $dbUserName, $dbPassword, $dbName) or die("Bad connection: ".mysqli_connect_error());

?>


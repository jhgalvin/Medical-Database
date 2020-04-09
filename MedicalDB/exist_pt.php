<?php
	include_once "includes/dbh.php";
?>

<html>
<head>
    <title>Patient Login</title>
</head>
<body>
<h1> <center> UH Medical Clinic </center> </h1>
<h2> <center> Welcome Back </center> </h2>
<h3> <center> Please log-in using your Patient ID </center> </h3>

<center><form action="patient_process.php" method="POST" name="Patient Login">
    <label for="PID">Enter your PID</label>
    <input type="text" minlength="5" maxlength="6" name="PID">
    <button name="Submit" type="submit">Sign in</button>
</form></center>

</body>
 

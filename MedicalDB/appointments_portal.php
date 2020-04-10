<?php
    include_once 'includes/dbh.php';
    include_once 'includes/session_check.php';
?>

<html>
<head>
	<title>Appointment Scheduler</title>
</head>
<body>

Do you want to schedule with a general practitioner or a specialist?

<form action="appointments_portal_process.php" method="POST">
<input type="radio" id="gp" value=0 name="app_choice">
<label for="gp">General Practitioner</label><br>
<input type="radio" id="specialist" value=1 name="app_choice">
<label for="specialist">Specialist</label><br><br>
<input type="submit" name="submit" value="submit">
</form> 
<a href='patient_portal.php'>Return to patient portal</a>
</body>
</html>
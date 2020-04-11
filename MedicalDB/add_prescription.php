<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8">
		<title>Add Prescription</title>
		<link href="doc_home_style.css" rel="stylesheet" type="text/css">
		<link rel="stylesheet" type="text/css" href="style.css" />
	</head>
	<body class="loggedin">
		<nav class="navtop">
			<div>
				<h1>Website Title</h1>
				<a href="doc_home.php">Doctor Home</a>
				<a href="doc_appointments.php">Appointments</a>
				<a href="doc_view_patients.php">Patients</a>
				<a href="logout.php"><i class="fas fa-sign-out-alt"></i>Logout</a>
			</div>
		</nav>
		<center><div class="content">
			<h2>Add Prescription</h2>
			<h3>Please fill out the following fields:</h3>
		</div></center>
		
		<center><form action = "add_prescription.inc.php" method = "POST">
			
			<input type = "text" name = "Prescript_ID" placeholder = "Prescription ID">
			<br>
			<br>
			<input type = "text" name = "Prescript_Name" placeholder = "Prescription Name">
			<br>
			<br>
			<input type = "text" name = "Dosage" placeholder = "Dosage">
			<br>
			<br>
			<input type = "text" name = "Refill_ENUM" placeholder = "Refill ENUM (Y/N)">
			<br>
			<br>
			<input type = "text" name = "Prescribing_Doc" placeholder = "Prescribing Doctor">
			<br>
			<br>
			<input type = "text" name = "Patient" placeholder = "Patient ID">
			<br>
			<br>
			<button type = "submit" name = "submit">Add Prescription</button>
		</form></center>
	</body>
</html>
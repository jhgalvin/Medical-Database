<?php
// We need to use sessions, so you should always start sessions using the below code.
session_start();
// If the user is not logged in redirect to the login page...
if (!isset($_SESSION['loggedin'])) {
	header('Location: doc_index.html');
	exit;
}
?>

<?php
	include_once 'connection_index.php';
?>

<!DOCTYPE html>
<html>

<head>
<meta charset = "utf-8">
<title>
	Doctor Appointments
</title>
	<link href="doc_home_style.css" rel="stylesheet" type="text/css">
	<link rel="stylesheet" type="text/css" href="style.css" />
</head>

<body class="loggedin">
		<nav class="navtop">
			<div>
				<h1>Website Title</h1>
				<a href="doc_home.php">Doctor Home</a>
				<a href="doc_appointments.php">Appointments</a>
				<a href="add_prescription.php">Add Prescriptions</a>
				<a href="logout.php"><i class="fas fa-sign-out-alt"></i>Logout</a>
			</div>
		</nav>
		<div class="content">
			<h2>Patients</h2>
		</div>
	<?php
		$sql_patient = "SELECT * FROM Patients;";
		$sql_script = "SELECT * FROM Prescriptions;";
		
		$result_patient = mysqli_query($conn, $sql_patient);
		$result_script = mysqli_query($conn, $sql_script);
		
		$resultCheckPatient = mysqli_num_rows($result_patient); //checks if there is any data being pulled
		$resultCheckScript = mysqli_num_rows($result_script);
		
		if($resultCheckPatient > 0){
			while($row = mysqli_fetch_assoc($result_patient) AND $row_script = mysqli_fetch_assoc($result_script)){
				echo $row['PID']." ".$row['First_Name']." ".$row['Last_Name']." ".$row_script['Prescript_ID']." ".$row_script['Prescript_Name']." ".$row_script['Dosage'];
				echo "<br>";
				echo "<br>";
			}
		}
		else{
			echo "No data found.";
		}
			
	?>
</body>
</html>
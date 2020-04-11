<?php
	// We need to use sessions, so you should always start sessions using the below code.
	session_start();
	// If the user is not logged in redirect to the login page...
	if (!isset($_SESSION['loggedin'])) {
		header('Location: doc_index.html');
		exit;
	}

	include_once 'connection_index.php';
	
	$Prescript_ID = mysqli_real_escape_string($conn, $_POST['Prescript_ID']);
	$Prescript_Name = mysqli_real_escape_string($conn, $_POST['Prescript_Name']);
	$Dosage = mysqli_real_escape_string($conn, $_POST['Dosage']);
	$Refill_ENUM = mysqli_real_escape_string($conn, $_POST['Refill_ENUM']);
	$Prescribing_Doc = mysqli_real_escape_string($conn, $_POST['Prescribing_Doc']);
	$Patient = mysqli_real_escape_string($conn, $_POST['Patient']);
	
	$sql = "INSERT INTO Prescriptions (Prescript_ID, Prescript_Name, Dosage, Refill ENUM, Prescribing_Doc, Patient)
		VALUES ('Prescript_ID', 'Prescript_Name', 'Dosage', 'Refill_ENUM', 'Prescribing_Doc', 'Patient');";
	
	mysqli_query($conn, $sql);
	
	header("Location: add_prescription.php?addscript=success");
?>
<?php
    include_once "includes/dbh.php";
    session_start();

    if(isset($_POST['PID'])) {
        
	    $patient = mysqli_query($conn, "SELECT * FROM Patients WHERE PID=".$_POST['PID'].";") or die(mysqli_error($conn));

	    if(mysqli_num_rows($patient) == 0){
		    echo "Invalid PID";


	    } else {
		    $_SESSION['loggedin'] = TRUE;
		    $_SESSION['PID'] = $_POST['PID'];

		    $name = mysqli_query($conn, "SELECT First_Name FROM Patients WHERE PID=".$_POST['PID'].";") or die(mysqli_error($conn));
		    $row = mysqli_fetch_assoc($name);

		    $_SESSION['Name'] = $row['First_Name'];

		    header("location:patient_portal.php");

	    }
    }
?>

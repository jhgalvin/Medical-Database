<?php
    include_once 'includes/dbh.php';
?>
<html>
<head>
    <title>Appointment Scheduler</title>
</head>

<body>

<?php

$datetime = substr($_POST['Time'],0,10).' '.substr($_POST['Time'],11).':00';

    if(isset($_POST['submit'])) {

	//Check to see if a Doctor is chosen    
	if($_POST['Doctor']=='0') {
		echo "No doctor selected!";
	} else {

	    // Check to see if patient has primary care approval	
	    if($_POST['GP']=='No') {
		    echo "Must have a primary care physician to schedule appointment";
	    } else {
		    $time_check = mysqli_query($conn, "SELECT * FROM Appointments WHERE Doctor_ID=".$_POST['Doctor']." AND Appointment_time='".$datetime."';") or die(mysqli_error($conn));

		    // Check to see if time slot is taken
		    if($time_check && mysqli_num_rows($time_check) != 0) {
			    echo "This time is already taken";
		    } else {

			    $clinic_check = mysqli_query($conn, "SELECT * FROM Doctor_clinic WHERE Clinic_ID=".$_POST['Clinic']." AND NPI=".$_POST['Doctor'].";") or die(mysqli_error($conn));
			    // Check to see if doctor works at specific clinic
			    if(!$clinic_check) {
				    echo "This doctor does not work at that clinic";
			    } else {
				 
			        $PID_check = mysqli_query($conn, "SELECT * FROM Patients WHERE PID=".$_POST['PID'].";");

				// Check to see if PID is valid
				if (!$PID_check) {
				    echo "Not a valid PID number";

				} else {

					mysqli_query($conn, "INSERT INTO Appointments VALUES (NULL, 'Yes','".$datetime."', ".$_POST['Doctor'].", ".$_POST['PID'].", ".$_POST['Clinic'].");") or die(mysqli_error($conn));	

					echo "The appointment was successfully added!";	
				}
			    }
			}
		  }
	    }
	}


?>

<form action="appointments.php">
	<button type="submit">Return to appointments page</button>
</form>

</body>



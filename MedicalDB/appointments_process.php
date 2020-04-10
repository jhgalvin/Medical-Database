<?php
    include_once 'includes/dbh.php';
    include_once 'includes/session_check.php';
?>
<html>
<head>
    <title>Appointment Scheduler</title>
</head>

<body>

<?php

	if(isset($_POST['submit'])) {

		$datetime = substr($_POST['Time'],0,10).' '.substr($_POST['Time'],11).':00';
		
		$sql_doc = mysqli_query($conn, "SELECT * FROM Doctors WHERE NPI=".$_POST['Doctor'].";");
		$doc = mysqli_fetch_assoc($sql_doc) or die(mysqli_error($conn));;
		$sql_clinic = mysqli_query($conn, "SELECT * FROM Clinics WHERE Clinic_ID=".$_POST['Clinic'].";");
		$clinic = mysqli_fetch_assoc($sql_clinic) or die(mysqli_error($conn));;

		$time_check = mysqli_query($conn, "SELECT * FROM Appointments WHERE Doctor_ID=".$_POST['Doctor']." AND Appointment_time='".$datetime."';") or die(mysqli_error($conn));
		$clinic_check = mysqli_query($conn, "SELECT * FROM Doctor_clinic WHERE Clinic_ID=".$_POST['Clinic']." AND NPI=".$_POST['Doctor'].";") or die(mysqli_error($conn));



		// Check to see if time slot is taken
		if(mysqli_num_rows($time_check) != 0) {
			echo "We're sorry, the timeslot ".$datetime." with Dr. ".$doc['Name']." is already taken <br> <br>";
			echo "Please <a href='appointments_portal.php'>return to the appointment scheduler and pick another time</a><br><br>";
			echo "<form action='patient_portal.php'><button type='submit'>Return to patient portal</button></form>";

		//Check to see if doctor practices at that clinic
		} elseif (mysqli_num_rows($clinic_check) != 0) {
			echo "We're sorry, Dr. ".$doc['Name']." doesn't currently practice out of ".$clinic['Clinic_name']."<br>";
			echo "Please <a href='appointments_portal.php'>return to the appointment scheduler and pick another clinic</a><br><br>";
			echo "<form action='patient_portal.php'><button type='submit'>Return to patient portal</button></form>";

		} else {
			mysqli_query($conn, "INSERT INTO Appointments VALUES (NULL, 'Yes','".$datetime."', ".$_POST['Doctor'].", ".$_SESSION['PID'].", ".$_POST['Clinic'].");") or die(mysqli_error($conn));	
			echo "The appointment with Dr. ".$doc['Name']." at ".$clinic['Clinic_name']." on ".$datetime." was successfully added! <br>";
			echo "<form action='patient_portal.php'><button type='submit'>Return to patient portal</button></form>";
		}		
			    
	}    
	


?>

</body>



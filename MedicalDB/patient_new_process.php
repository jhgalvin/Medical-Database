<?php
	include_once "includes/dbh.php";
	session_start();
?>

<!-- <link rel="stylesheet" type="text/css" href="style.css" /> -->

<html>
<body>
<?php

	if(isset($_POST['pwd'])) {
			//Generate random PID
			$check = TRUE;

			while($check) {
				$PID = rand(100000,999999);
				$sql_PID = mysqli_query($conn, "SELECT * from Patients WHERE PID=".$PID.";") or die(mysqli_error($conn));

				if(mysqli_num_rows($sql_PID)==0) {
					$check = FALSE;
				}
			}

			//Generate Demographic Entry
			mysqli_query($conn, "INSERT INTO Demographics VALUES(NULL,'".$_POST["insurance"]."','".$_POST["Age"]."','".$_POST["DOB"]."','".$_POST["gender"]."','".$_POST["ethnicity"]."','".$_POST["marital"]."','".$_POST["home_phone"]."','".$_POST["cell_phone"]."','".$_POST["work_phone"]."','".$_POST["email"]."','".$_POST["allergies"]."');") or die(mysqli_error($conn));
			$demo_ID = mysqli_insert_id($conn) or die(mysqli_error($conn));

			//Generate Medical History Entry
			mysqli_query($conn, "INSERT INTO Medical_history VALUES(NULL,'".$_POST["prev_cond"]."','".$_POST["past_surg"]."','".$_POST["blood_type"]."','".$_POST["past_prescript"]."');") or die(mysqli_error($conn));
			$med_hist_ID = mysqli_insert_id($conn) or die(mysqli_error($conn));

			//Generate Family History Entry
			mysqli_query($conn, "INSERT INTO Family_history VALUES(NULL,'".$_POST["family_hist"]."');") or die(mysqli_error($conn));
			$fam_hist_ID = mysqli_insert_id($conn) or die(mysqli_error($conn));

			//Generate New Patient
			mysqli_query($conn, "INSERT INTO Patients VALUES(".$PID.",'".$_POST["pwd"]."','".$_POST["First_name"]."','".$_POST["Last_name"]."',".$_POST["SSN"].",".$demo_ID.",".$med_hist_ID.",".$fam_hist_ID.", NULL);") or die(mysqli_error($conn));


			$_SESSION['loggedin'] = TRUE;
		    $_SESSION['PID'] = $PID;
		    $_SESSION['Name'] = $_POST["First_name"];
		    $_SESSION['User_Type'] = "Patient";
		    $_SESSION['Has_GP'] = FALSE;

			echo "<h2>Thank for joing UH Medical Clinic</h2>";
			echo "Your PID is ".$PID."<br>";
			echo "<a href='patient_portal.php'> Continue to your patient portal </a>";
			

	}

?>
</body>
</html>
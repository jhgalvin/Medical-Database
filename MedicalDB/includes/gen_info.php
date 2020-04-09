<?php

	function gen_patient_info($PID) {

		$dbServerName = "localhost";
		$dbUserName = "user";
		$dbPassword = "password";
		$dbName = "meddb";

		$conn = mysqli_connect($dbServerName, $dbUserName, $dbPassword, $dbName) or die("Bad connection: ".mysqli_connect_error());
	
		$sql_patient = mysqli_query($conn, "SELECT * FROM Patients WHERE PID= '$PID' ;") or die(mysqli_error($conn));
		$data = mysqli_fetch_assoc($sql_patient);
		
		$sql_demo = mysqli_query($conn, "SELECT * FROM Demographics WHERE Demo_ID= '$data[Demographics_ID]';") or die(mysqli_error($conn));
		$demo = mysqli_fetch_assoc($sql_demo);

		$sql_med = mysqli_query($conn, "SELECT * FROM Medical_history WHERE Med_Hist_ID='$data[Med_Hist_ID]';") or die(mysqli_error($conn));
		$med = mysqli_fetch_assoc($sql_med);

		$sql_fam = mysqli_query($conn, "SELECT * FROM Family_history WHERE Fam_Hist_ID='$data[Fam_Hist_ID]';") or die(mysqli_error($conn));
		$fam = mysqli_fetch_assoc($sql_fam);

		$sql_doc = mysqli_query($conn, "SELECT * FROM Doctors WHERE NPI IN (SELECT NPI FROM Doctor_patient WHERE PID='$PID') AND Specialist='Yes';") or die(mysqli_error($conn));
		$sql_gp = mysqli_query($conn, "SELECT * FROM Doctors WHERE NPI IN (SELECT NPI FROM Doctor_patient WHERE PID='$PID') AND Specialist='No';") or die(mysqli_error($conn));
		$doc_gp = mysqli_fetch_assoc($sql_gp);

		$sql_nurse = mysqli_query($conn, "SELECT * FROM Nurses WHERE NID= '$data[NID]';");
		$nurse = mysqli_fetch_assoc($sql_nurse);

		//Name
		echo "<div class='row'><div class='column'>";
		echo "<h2> Name </h2>";
		echo $data['First_Name']." ".$data['Last_Name']."</div>";

		//PID
		echo "<div class='column'>";
		echo "<h2> PID </h2>";
		echo $PID."</div>";

		//Last 4 SSN
		echo "<div class='column'>";
		echo "<h2> Last 4 SSN </h2>";
		echo $data['Last_4_SSN']."</div>";	

		//Age
		echo "<div class='column'>";
		echo "<h2> Age </h2>";
		echo $demo['Age']."</div>";

		//Date of Birth
		echo "<div class='column'>";
		echo "<h2> Date of Birth </h2>";
		echo $demo['Date_of_birth']."</div>";

		//Insurance
		echo "<div class='column'>";
		echo "<h2> Has insurance? </h2>";
		echo $demo['Has_insurance']."</div>";

		//Ethnicity
		echo "<div class='column'>";
		echo "<h2> Ethnicity </h2>";
		echo $demo['Ethinicity']."</div>";

		//Marital Status
		echo "<div class='column'>";
		echo "<h2> Marital Status </h2>";
		echo $demo['Marital_status']."</div>";

		//End row
		echo "</div>";

		//Home phone
		echo "<div class='row'><div class='column'>";
		echo "<h2> Home Phone </h2>";
		echo $demo['Home_phone']."</div>";

		//Cell Phone
		echo "<div class='column'>";
		echo "<h2> Cell Phone </h2>";
		echo $demo['Cell_phone']."</div>";

		//Work phone
		echo "<div class='column'>";
		echo "<h2> Work Phone </h2>";
		echo $demo['Work_phone']."</div>";

		//Email
		echo "<div class='column'>";
		echo "<h2> Email </h2>";
		echo $demo['Email']."</div>";

		//End row
		echo "</div>";

		//Previous Conditions
		echo "<div class='row'><div class='column'>";
		echo "<h2> Previous Conditions </h2>";
		echo $med['Prev_conditions']."</div>";

		//Past Surgeries
		echo "<div class='column'>";
		echo "<h2> Past Surgeries </h2>";
		echo $med['Past_surgeries']."</div>";

		//Blood Type
		echo "<div class='column'>";
		echo "<h2> Blood Type </h2>";
		echo $med['Blood_type']."</div>";

		//End row
		echo "</div>";

		//Past Prescriptions
		echo "<div class='row'><div class='column'>";
		echo "<h2> Past Prescriptions </h2>";
		echo $med['Past_prescriptions']."</div>";

		//Family History
		echo "<div class-'column'>";
		echo "<h2> Family History </h2>";
		echo $fam['Fam_History']."</div>";

		//End row
		echo "</div>";
	
		//Primary Care
		echo "<div class='row'><div class='column'>";
		echo "<h2> Primary Care </h2>";
		echo $doc_gp['Name']."</div>";

		//Other Doctors
		echo "<div class='column'>";
		echo "<h2> Other Doctors </h2>";

		while($docs = mysqli_fetch_assoc($sql_doc)) {
			echo $docs['Name']." (".$docs['Specialization'].") <br>";
		}
		echo "</div>";

		//Nurse
		echo "<div class='column'>";
		echo "<h2> Nurse </h2>";
		echo $nurse['Name']."</div>";

		//End row
		echo "</div>";

	}

	function gen_prescriptions($PID) {

		$dbServerName = "localhost";
		$dbUserName = "user";
		$dbPassword = "password";
		$dbName = "meddb";

		$conn = mysqli_connect($dbServerName, $dbUserName, $dbPassword, $dbName) or die("Bad connection: ".mysqli_connect_error());

		$sql_pres = mysqli_query($conn, "SELECT * FROM Prescriptions WHERE Patient='$PID';");

		if (mysqli_num_rows($sql_pres)==0) {
			echo "No prescriptions";
		}

		while($pres = mysqli_fetch_assoc($sql_pres)) {

			//Drug Name
			echo "<div class='row'><div class='column'>";
			echo "<h2> Drug </h2>";
			echo $pres['Prescript_Name']."</div>";

			//Dosage
			echo "<div class='column'>";
			echo "<h2> Dosage </h2>";
			echo $pres['Dosage']."</div>";

			//Refill
			echo "<div class='column'>";
			echo "<h2> Refill </h2>";
			echo $pres['Refill']."</div>";

			//Prescribing Doctor
			echo "<div class='column'>";
			echo "<h2> Prescribing Doctor</h2>";

			$sql_doc = mysqli_query($conn, "SELECT * FROM Doctors WHERE NPI='$pres[Prescribing_doc]';");
			$doc = mysqli_fetch_assoc($sql_doc);

			echo $doc['Name']."</div>";

			//End row
			echo "</div>";

		}

	}

?>

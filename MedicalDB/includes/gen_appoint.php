
<?php

    function sql_connect() {

        $dbServerName = "localhost";
        $dbUserName = "user";
        $dbPassword = "password";
        $dbName = "meddb";

        $conn = mysqli_connect($dbServerName, $dbUserName, $dbPassword, $dbName) or die("Bad connection: ".mysqli_connect_error());

        return $conn;
    }

    function select_GP() {

        $conn = sql_connect();

        $gp_result = mysqli_query($conn, "SELECT * FROM Doctors WHERE Specialist='No';") or die(mysqli_error($conn));

        echo "Choose a general practitioner:";
        echo "<p><select name='Doctor' required>";
        echo "<option value='' selected disabled></option>";
            
        while ($gp_rows = mysqli_fetch_assoc($gp_result)) {
            echo "<option value='".$gp_rows["NPI"]."'>".$gp_rows["Name"]."</option>";
        }

        echo "</select></p>";
    }

    function select_specialist() {

        $conn = sql_connect();

        $doc_result = mysqli_query($conn, "SELECT * FROM Doctors WHERE Specialist='Yes';") or die(mysqli_error($conn));

        echo "Choose a specialist:";
        echo "<p><select name='Doctor' required>";
        echo "<option value='' selected disabled></option>";
            
        while ($doc_rows = mysqli_fetch_assoc($doc_result)) {
            echo "<option value='".$doc_rows["NPI"]."'>".$doc_rows["Name"]." (".$doc_rows["Specialization"].") </option>";
        }

        echo "</select></p>";
    }

    function select_clinic() {

        $conn = sql_connect();

        $loc_result = mysqli_query($conn, "SELECT * FROM Clinics;") or die(mysqli_error($conn));
        echo "Which clinic would you like to have your appointment at?";

        echo "<p><select name='Clinic' required>";
        echo "<option value='' selected disabled></option>";

        while ($loc_rows = mysqli_fetch_assoc($loc_result)){
            echo "<option value='".$loc_rows["Clinic_ID"]."'>".$loc_rows["Clinic_name"]."</option>";
        }
        
        echo "</select></p>";
    }

    function select_datetime() {
        echo "Choose the desired appointment date and time:";
        echo "<p><input type='datetime-local' step=1800 value='2020-01-01T08:00' name='Time' required></p>";
    }


    function gen_patient_info($PID) {

        $conn = sql_connect();
    
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
        echo $demo['Ethnicity']."</div>";

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

        $conn = sql_connect();

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
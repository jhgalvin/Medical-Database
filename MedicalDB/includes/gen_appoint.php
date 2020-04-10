
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





?>
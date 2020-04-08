
<?php
    include_once 'includes/dbh.php';
?>

<!DOCTYPE html>
<html>
<head>
	<title>Appointment Scheduler</title>
<head>
<body>

<?php
    $doc_result = mysqli_query($conn, "SELECT * FROM Doctors;");
    $gp_result = mysqli_query($conn, "SELECT * FROM Doctors WHERE Specialist='No';");
?>

<form action="appoint_end.php" method="POST">

Which doctor are you scheduling with?
<p><select name="Doctor">
<option value='0'></option>
<?php
    while ($doc_rows = mysqli_fetch_assoc($doc_result)) {
	    $doc_name = $doc_rows['Name'];
	    $doc_val = $doc_rows['NPI'];
	    echo "<option value='$doc_val'>$doc_name</option>";
    }
?>
</select></p>

Who is your general practitioner?
<p><select name="GP">
<option value = 'No'></option>
<?php
    while ($gp_rows = mysqli_fetch_assoc($gp_result)) {
	    $gp_name = $gp_rows['Name'];
	    echo "<option value='Yes'> $gp_name</option>";
    }
?>
</select></p>

Choose the desired appointment date and time:
<p><input type="datetime-local" name="Time"></p>

<?php
    $loc_result = mysqli_query($conn, 'SELECT * FROM Clinics');
?>

Which clinic will the appointment be at?
<p><select name="Clinic">
<option value = 0></option>
<?php
    while ($loc_rows = mysqli_fetch_assoc($loc_result)){
	    $loc_name = $loc_rows['Clinic_name'];
	    $loc_ID = $loc_rows['Clinic_ID'];
	    echo "<option value=".$loc_ID.">".$loc_name."</option>";
    }
?>
</select></p>

Enter your PID to confirm:
<p><input type="text" minlength="6" maxlength="6" name="PID"></p>

<p><input type="submit" name="submit" value="Submit"></p>

</form>

</body>
</html>


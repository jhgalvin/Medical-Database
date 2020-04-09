<?php
    include_once "includes/dbh.php";
    include_once "includes/session_check.php";
?>

<html>
<head>
<title>Patient Portal</title>
</head>

<body>

<?php
    echo "Welcome ".$_SESSION['Name']." !";
?>

<p><a href='patient_info.php'>Check your medical records</a></p>
<p><a href='patient_prescript.php'>Check your prescriptions </a></p>
<p>Schedule an appointment </p> 

</body>


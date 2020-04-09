<?php
    include_once "includes/dbh.php";
    include_once "includes/session_check.php";
    include_once "includes/gen_info.php";

    gen_prescriptions($_SESSION['PID']);
?>
<!DOCTYPE html>
<html>

<h1> <center> Are you a Patient or Doctor? </center> </h1>
<h2> <center> Please choose one </center> </h2>

<head>
    <link rel="stylesheet" type = "text/css" href="style.css" />
</head>
    
<body>

<center> <input type = "radio" name = "choose" value = "Doctor" onclick = "document.location.href = 'login_doc.php'") />Doctor </center><br>
<center> <input type = "radio" name = "choose" value = "Patient" onclick = "document.location.href = 'login_pt.php'" />Patient </center><br> 
<center> <input type = "radio" name = "choose" value = "Admin" onclick = "document.location.href = 'login_admin.php'" /> Admin </center>

</body>
</html>

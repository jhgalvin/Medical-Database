<!DOCTYPE html>
<html>
    
<link rel="stylesheet" type = "text/css" href="login_style.css" />
<div class="box">  
    <h1> <center> Are you a Patient or Doctor? </center> </h1>
    <br>
    <h2> <center> Please Choose One: </center> </h2>
    
    <body>
        
        <center> <input type = "radio" name = "choose" value = "Doctor" onclick = "document.location.href = 'doc_index.html'") /> Doctor </center><br>
        <center> <input type = "radio" name = "choose" value = "Patient" onclick = "document.location.href = 'login_pt.php'" /> Patient </center><br> 
		 <center> <input type = "radio" name = "choose" value = "Nurse" onclick = "document.location.href = 'nurse_index.html'" /> Nurse </center><br>
	   <center> <input type = "radio" name = "choose" value = "Admin" onclick = "document.location.href = 'admin_index.php'" /> Admin </center>

    </body>
</div>
</html>

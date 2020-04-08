<!DOCTYPE html>
<html>

<link rel="stylesheet" type="text/css" href="style.css" />
<?php
	include_once 'db_connection.php';
?>

<h1> <center> UH Medical Clinic </center> </h1>
<h2> <center> Please fill out the following form. </center> </h2>

<center>
	<?php
		$id_array = array(11);
		srand(time());
	
		for($x = 0; $x < 11; $x++){
			$id_array[$x] = rand(0,9);
		}
	
		echo "Your Patient ID is: ";
	
		foreach($id_array as $value){
			echo "<strong>$value</strong>";
		}
		
	?>
	<form action="process-form.php" method="post">
        <p>
            <label for="inputName">First Name<sup>*</sup><br></label>
            <input type="text" name="name" id="inputName">
        </p>
        <p>
            <label for="inputSSN">Last 4 SSN<sup>*</sup><br></label>
            <input type="text" name="email" id="inputEmail">
        </p>
        <p>
            <label for="inputPrimary">Primary Care Doctor<br></label>
            <input type="text" name="subject" id="inputSubject">
        </p>
        <input type="submit" value="Submit">
        <input type="reset" value="Reset">
    </form>

	</center>

</html>
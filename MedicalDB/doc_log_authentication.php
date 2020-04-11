<?php
	session_start();
	//connects to database
	include_once 'connection_index.php';

	// Now we check if the data from the login form was submitted, isset() will check if the data exists.
	if ( !isset($_POST['NPI'], $_POST['password']) ){
		// Could not get the data that should have been sent.
		exit('Please fill both the username and password fields!');
	}

	if ($stmt = $conn -> prepare('SELECT NPI, Password FROM doctors WHERE NPI = ?')){
		// Bind parameters (s = string, i = int, b = blob, etc), in our case the username is a string so we use "s"
		$stmt->bind_param('i', $_POST['NPI']);
		$stmt->execute();
		
		// Store the result so we can check if the account exists in the database.
		$stmt->store_result();

		if ($stmt->num_rows > 0){
		$stmt->bind_result($id, $password);
		$stmt->fetch();
		
		// Account exists, now we verify the password.
		// Note: remember to use password_hash in your registration file to store the hashed passwords.
			if ($_POST['password'] === $password){
				// Verification success! User has loggedin!
				// Create sessions so we know the user is logged in, they basically act like cookies but remember the data on the server.
				session_regenerate_id();
				$_SESSION['loggedin'] = TRUE;
				$_SESSION['name'] = $_POST['Name'];
				$_SESSION['NPI'] = $id;
				header('Location: doc_home.php');
			}else{
			echo 'Incorrect password!';
			}
		}else{
		echo 'Incorrect username!';
		}

		$stmt->close();
	}
?>
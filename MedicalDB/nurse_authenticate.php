<?php
	session_start();
	include_once 'connection_index.php'; //establishes the connection

	// Now we check if the data from the login form was submitted, isset() will check if the data exists.
if ( !isset($_POST['username'], $_POST['password']))
	{
	// Could not get the data that should have been sent.
	exit('Please fill both the username and password fields!');
	}

// Prepare our SQL, preparing the SQL statement will prevent SQL injection.
if ($stmt = $conn->prepare('SELECT NID, Nurse_pass FROM nurses WHERE Nurse_User = ?')) 
{
	//'SELECT NPI, Doc_Pass FROM doctors WHERE Doc_User = ?'
	// Bind parameters (s = string, i = int, b = blob, etc), in our case the username is a string so we use "s"
	$stmt->bind_param('s', $_POST['username']);
	$stmt->execute();
	// Store the result so we can check if the account exists in the database.
	$stmt->store_result();

	if ($stmt->num_rows > 0) 
	{
	$stmt->bind_result($id, $password);
	$stmt->fetch();
	// Account exists, now we verify the password.
	// Note: remember to use password_hash in your registration file to store the hashed passwords.
	if ($_POST['password'] === $password)  
	{
		// Verification success! User has loggedin!
		// Create sessions so we know the user is logged in, they basically act like cookies but remember the data on the server.
		session_regenerate_id();
		$_SESSION['loggedin'] = TRUE;
		$_SESSION['name'] = $_POST['username'];
		$_SESSION['username'] = $id;
		
		echo 'Welcome ' . $_SESSION['name'] . '!';
		header('Location: nurse_home.php'); 

	} else 
	{
		echo 'Incorrect password!';
	}
} 
else
	{
	echo 'Incorrect username!';
}

	$stmt->close();
}
?>
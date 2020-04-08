

<?php


if(isset($_POST['submit'])) //this sends an actual email 
{
	$firstName = $_POST['name'];
	echo "<br>";
	$lastName = $_POST['name'];
	echo "<br>";
	$mailFrom = $_POST['mail'];
	echo "<br>";
	$subject = $_POST['subject'];
	echo "<br>";
	$message = $_POST['message'];
	
	$mailSentTo = "zankar.rashia99@gmail.com"; //admin email for the contact form
	$headerForMail = "From: " . "$mailFrom";
	$customMessage = "You have received an e-mail from " . $lastName ." ". $lastName . ".\n\n". $message;
	mail($mailSentTo, $subject, $customMessage, $headerForMail);
	header("Location: contact_form_index.php?Mailsend");
}
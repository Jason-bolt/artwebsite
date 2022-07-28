<?php
	session_start();

	// Check for empty fields
	if(!isset($_POST['contact_submit'])) {
	  header("Location: ../../about.php");
	}

	$firstName = strip_tags(htmlspecialchars($_POST['firstName']));
	$lastName = strip_tags(htmlspecialchars($_POST['lastName']));
	$mailFrom = strip_tags(htmlspecialchars($_POST['email']));
	$message = strip_tags(htmlspecialchars($_POST['message']));

	$name = $firstName . " " . $lastName;

	// Create the email and send the message
	$mailTo = "gotskillsh@gotskillshub.com"; // Add your email address in between the "" replacing yourname@yourdomain.com - This is where the form will send a message to.
	$subject = "Website Contact Form:  $name";
	$body = "You have received a new message from your website contact form.\n\n"."Name: " . $name . "\n\n" . $message;
	$header = "From: ". $mailFrom; // This is the email address the generated message will be from. We recommend using something like noreply@yourdomain.com.

	if(!mail($mailTo, $subject, $body, $header)){
		$_SESSION['message'] = "Message not sent!";
	 	header("Location: ../../contact.php");
	}else{
		$_SESSION['message'] = "Message sent successfully!";
	 	header("Location: ../../contact.php");
	}
	
?>

<?php

	session_start();
	include('../../../includes/db.php');
	include('../../../includes/functions.php');

	if (!isset($_GET['update_about_submit'])) {
		redirect_to('../../../index.php');
	}

	$about_the_artist = mysql_prep(trim($_GET['about_the_artist']));
	$phone_number = mysql_prep(trim($_GET['phone_number']));
	$email = mysql_prep(trim($_GET['email']));

	// Update Banner table
	$query = "UPDATE about SET about_text = '{$about_the_artist}', phone_number = '{$phone_number}', email = '{$email}' where about_id = 1";
	$result = mysqli_query($connection, $query);

	if (!$result) {
		$_SESSION['update_about_message'] = "Could not update about info, please try again!";
		redirect_to('../about.php');
	}else{
		$_SESSION['update_about_message'] = "About info updated successful!";
		redirect_to('../about.php');
	}


?>
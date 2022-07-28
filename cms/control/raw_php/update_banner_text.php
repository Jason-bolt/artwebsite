<?php

	session_start();
	include('../../../includes/db.php');
	include('../../../includes/functions.php');

	if (!isset($_GET['banner_text_submit'])) {
		redirect_to('../../../index.php');
	}

	$banner_text = mysql_prep(trim($_GET['banner_text']));

	// Update Banner table
	$query = "UPDATE banner_info SET banner_text = '{$banner_text}' where banner_id = 1";
	$result = mysqli_query($connection, $query);

	if (!$result) {
		$_SESSION['update_banner_message'] = "Could not update banner text, please try again!";
		redirect_to('../admin.php');
	}else{
		$_SESSION['update_banner_message'] = "Banner update successful!";
		redirect_to('../admin.php');
	}


?>
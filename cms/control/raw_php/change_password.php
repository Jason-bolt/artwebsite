<?php

	session_start();
	include('../../../includes/db.php');
	include('../../../includes/functions.php');

	if (!isset($_POST['password_submit'])) {
		redirect_to('../admin.php');
	}

	$new_password = mysql_prep(trim($_POST['new_password']));

	if ($new_password == '') {
		$_SESSION['update_password_message'] = "Field can not be left blank!";
		redirect_to('../about.php');
	}

	$hashed_password = password_encrypt($new_password);

	// Update Password
	$query = "UPDATE admins SET admin_password = '{$hashed_password}'";
	$result = mysqli_query($connection, $query);

	if (!$result) {
		$_SESSION['update_password_message'] = "Could not update password, please try again!";
		redirect_to('../about.php');
	}else{
		$_SESSION['update_password_message'] = "Password updated successful!";
		redirect_to('../about.php');
	}

?>
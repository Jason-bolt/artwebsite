<?php

	session_start();
	include('../../../includes/db.php');
	include('../../../includes/functions.php');

	if (!isset($_POST['login_submit'])) {
		// Probably a GET request
		redirect_to('../login.php');
	}else{
		// POST request
		$username = mysql_prep(trim($_POST['username']));
		$password = (trim($_POST['password']));

		if (trim($username) == '' || trim($password) == '') {
			$_SESSION['login_notice'] = "Fields can not be left blank!";
		}

		$admin = attempt_admin_login($username, $password);

		if ($admin) {
			$_SESSION['admin_id'] = $admin['admin_id'];
			$_SESSION['username'] = $admin['username'];

			redirect_to('../admin.php');	
		}else{
			$_SESSION['login_notice'] = "Invalid username or password!";
			redirect_to('../login.php');
		}
		
	}

?>
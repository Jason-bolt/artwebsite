<?php

	session_start();
	include('../../../includes/db.php');
	include('../../../includes/functions.php');

	if (!isset($_GET['art_description_submit'])) {
		redirect_to('../../../index.php');
	}

	$id = $_GET['id'];

	$art_name = mysql_prep(trim($_GET['art_name']));
	$art_description = mysql_prep(trim($_GET['art_description']));

	// Update Banner table
	$query = "UPDATE artworks SET artwork_name = '{$art_name}', artwork_description = '{$art_description}' where artwork_id = {$id}";
	$result = mysqli_query($connection, $query);

	if (!$result) {
		$_SESSION['update_art_text_message'] = "Could not update artwork text, please try again!";
		redirect_to('../edit_art.php?id=' . $id);
	}else{
		$_SESSION['update_art_text_message'] = "Artwork text updated successful!";
		redirect_to('../edit_art.php?id=' . $id);
	}


?>
<?php

	session_start();
	include('../../../includes/db.php');
	include('../../../includes/functions.php');

	$artwork_id = $_GET['id'];

	// DELETE QUERY
	$query = "DELETE from artworks WHERE artwork_id = {$artwork_id}";
	$result = mysqli_query($connection, $query);

	if ($result) {
		$_SESSION['delete_message'] = "Artwork deleted successfully";
		redirect_to("../admin.php#artworks");
	}

?>
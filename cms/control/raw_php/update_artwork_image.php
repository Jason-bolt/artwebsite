<?php

	session_start();
	include('../../../includes/db.php');
	include('../../../includes/functions.php');

	define('MB', 1048576);

	if (!isset($_POST['art_image_submit'])) {
		redirect_to('../../../index.php');
	}

	$id = $_POST['id'];

	$artwork_image_file = $_FILES['art_image'];

	// Checking if image was submitted
	if ($artwork_image_file['name'] == null) {
		$_SESSION['update_art_image_message'] = "No change was made.";
		redirect_to('../edit_art.php?id=' . $id);
	}

	// Get details of image file
	$artwork_image_fileName = $artwork_image_file['name'];
	$artwork_image_fileTmpName = $artwork_image_file['tmp_name'];
	$artwork_image_fileSize = $artwork_image_file['size'];
	$artwork_image_fileError = $artwork_image_file['error'];
	$artwork_image_fileType = $artwork_image_file['type'];

	// Breaking the image file name
	$artwork_image_fileNameBreak = explode('.', $artwork_image_fileName);
	// Get file extension
	$artwork_image_fileExt = strtolower(end($artwork_image_fileNameBreak));

	// Allowed extensions
	$allowed = array('jpeg', 'jpg', 'png');

	// Check if the extension is allowed
	if (in_array($artwork_image_fileExt, $allowed)) { // Good extension
		// Checking for errors
		if ($artwork_image_fileError === 0) { // No error found
			// Checking file size
			if ($artwork_image_fileSize < (10*MB)) { // Image of good size
				// Giving each business image a unique name
				$artwork_image_fileNameNew = 'banner_image' . $id . '.' . $artwork_image_fileExt;
				// New image location
				$artwork_image_fileDestination = '../../../assets/artworks/' . $artwork_image_fileNameNew;
				// move file into location
				move_uploaded_file($artwork_image_fileTmpName, $artwork_image_fileDestination);

				// Database query to uplaod info except image
				$query = "UPDATE artworks SET artwork_image_name = '{$artwork_image_fileName}', ";
				$query .= "artwork_image_location = '{$artwork_image_fileNameNew}' ";
				$query .= "WHERE artwork_id = {$id}";
				if (mysqli_query($connection, $query)){
					$_SESSION['update_art_image_message'] = "Artwork image updated successfully!";
					redirect_to('../edit_art.php?id=' . $id);
				}

			}else{
				// Image size is too big
				$_SESSION['update_art_image_message'] = "Banner image size is too big! Can not be above 10MB!";
				redirect_to('../edit_art.php?id=' . $id);
			}
		}else{
			// Error found
			$_SESSION['update_art_image_message'] = "Sorry an error occured when uploading file.";
			redirect_to('../edit_art.php?id=' . $id);
		}
	}else{
		// Image not allowed delete previous information submitted
		$_SESSION['update_art_image_message'] = "You can not upload files of this type!";
		// redirect_to('../edit_art.php?id=' . $id);
	}


?>
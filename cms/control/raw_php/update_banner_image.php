<?php

	session_start();
	include('../../../includes/db.php');
	include('../../../includes/functions.php');

	define('MB', 1048576);

	if (!isset($_POST['banner_image_submit'])) {
		redirect_to('../../../index.php');
	}

	$banner_image_file = $_FILES['banner-image'];

	$id = 1;

	// Get details of image file
	$banner_image_fileName = $banner_image_file['name'];
	$banner_image_fileTmpName = $banner_image_file['tmp_name'];
	$banner_image_fileSize = $banner_image_file['size'];
	$banner_image_fileError = $banner_image_file['error'];
	$banner_image_fileType = $banner_image_file['type'];

	// Breaking the image file name
	$banner_image_fileNameBreak = explode('.', $banner_image_fileName);
	// Get file extension
	$banner_image_fileExt = strtolower(end($banner_image_fileNameBreak));

	// Allowed extensions
	$allowed = array('jpeg', 'jpg', 'png');

	// Check if the extension is allowed
	if (in_array($banner_image_fileExt, $allowed)) { // Good extension
		// Checking for errors
		if ($banner_image_fileError === 0) { // No error found
			// Checking file size
			if ($banner_image_fileSize < (10*MB)) { // Image of good size
				// Giving each business image a unique name
				$banner_image_fileNameNew = 'banner_image' . $id . '.' . $banner_image_fileExt;
				// New image location
				$banner_image_fileDestination = '../../../assets/images/banner/' . $banner_image_fileNameNew;
				// move file into location
				move_uploaded_file($banner_image_fileTmpName, $banner_image_fileDestination);

				// Database query to uplaod info except image
				$query = "UPDATE banner_info SET banner_image_name = '{$banner_image_fileName}', ";
				$query .= "banner_image_location = '{$banner_image_fileNameNew}' ";
				$query .= "WHERE banner_id = {$id}";
				if (mysqli_query($connection, $query)){
					$_SESSION['update_banner_message'] = "Banner image updated successfully!";
					redirect_to('../admin.php');
				}

			}else{
				// Image size is too big
				$_SESSION['update_banner_message'] = "Banner image size is too big! Can not be above 10MB!";
				redirect_to('../admin.php');
			}
		}else{
			// Error found
			$_SESSION['update_banner_message'] = "Sorry an error occured when uploading file.";
			redirect_to('../admin.php');
		}
	}else{
		// Image not allowed delete previous information submitted
		$_SESSION['update_banner_message'] = "You can not upload files of this type!";
		// redirect_to('../admin.php');
	}


?>
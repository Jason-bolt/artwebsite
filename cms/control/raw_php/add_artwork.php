<?php

	session_start();
	include('../../../includes/db.php');
	include('../../../includes/functions.php');

	define('KB', 1024);
	define('MB', 1048576);
	define('GB', 1073741824);
	define('TB', 1099511627776);

	if (!isset($_POST['new_artwork_submit'])) {
		redirect_to('../../../index.php');
	}

	$new_art_name = mysql_prep(trim($_POST['new_art_name']));
	$new_art_description = mysql_prep(trim($_POST['new_art_description']));

	if (trim($new_art_name) == '' || trim($new_art_description) == '') {
		$_SESSION['add_art_message'] = "All fileds are required!";
		redirect_to('../admin.php');
	}


	// Checking if artwork already exists
	$artwork_exists =  get_artwork_by_name($new_art_name);
	if ($artwork_exists) {
		$_SESSION['add_art_message'] = "Artwork already exists!";
		redirect_to('../admin.php');
	}

	// Get image file
	$artwork_image_file = $_FILES['new_art_image'];

	// No picture has been subitted
	if ($artwork_image_file['name'] == null) {
		$_SESSION['add_art_message'] = "Artwork addition failed, please add an image!";
		redirect_to('../admin.php');
	}else{

		// Database query to uplaod info except image
		$query = "INSERT INTO artworks (";
		$query .= "artwork_name, artwork_description";
		$query .= ") VALUES (";
		$query .= "'{$new_art_name}', '{$new_art_description}')";
		mysqli_query($connection, $query);

		// Get artwork name and id of artwork
		$artwork = get_artwork_by_name($new_art_name);
		$id = $artwork['artwork_id'];

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
					$artwork_image_fileNameNew = 'artwork_image' . $id . '.' . $artwork_image_fileExt;
					// New image location
					$artwork_image_fileDestination = '../../../assets/artworks/' . $artwork_image_fileNameNew;
					// move file into location
					move_uploaded_file($artwork_image_fileTmpName, $artwork_image_fileDestination);

					// Database query to uplaod info except image
					$query = "UPDATE artworks SET artwork_image_name = '{$artwork_image_fileName}', ";
					$query .= "artwork_image_location = '{$artwork_image_fileNameNew}' ";
					$query .= "WHERE artwork_id = {$id}";
					if (mysqli_query($connection, $query)){
						$_SESSION['add_art_message'] = "Artwork added successfully!";
						redirect_to('../admin.php');
					}

				}else{
					// Image size is too big
					$_SESSION['add_art_message'] = "Image size is too big!";
					redirect_to('../admin.php');
				}
			}else{
				// Error found
				$_SESSION['add_art_message'] = "Sorry an error occured when uploading file!";
				redirect_to('../admin.php');
			}
		}else{
			// Image not allowed delete previous information submitted
			$_SESSION['add_art_message'] = "You can not upload files of this type!";
			redirect_to('../admin.php');
		}

	}



?>
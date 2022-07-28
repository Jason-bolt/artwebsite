<?php

function redirect_to($website){
	header("Location: " . $website);
	exit;
}

function query_check($query){
	if (!$query) {
		die("Database query failed");
	}
}

function mysql_prep($string){
	global $connection;
	$escaped_string = mysqli_real_escape_string($connection, $string);
	return $escaped_string;
}


// PASSWORD FUNCTIONS
function password_encrypt($password){
	$hash_format = "$2y$10$"; // Tells PHP to use Blowfish with "cost" of 10
	$salt_length = 23; // Blowfish salts should be 22-characters or more
	$salt = generate_salt($salt_length);
	$format_and_salt = $hash_format . $salt;
	$hash = crypt($password, $format_and_salt);
	return $hash;
}

function generate_salt($length){
	// Not 100% unique or random
	// MD5 returns 32 characters
	$unique_random_string = md5(uniqid(mt_rand(), true));
	// Valid characters for salt ar [a-zA-Z0-9./]
	$base64_string = base64_encode($unique_random_string);
	// But not '+' which is valid in base64 encoding
	$modified_base64_string = str_replace('+', '.', $base64_string);
	// Truncate to the correct length
	$salt = substr($modified_base64_string, 0, $length);
	return $salt;
}

function password_check($password, $existing_hash){
	// Existing hash contains format and salt to start
	$hash = crypt($password, $existing_hash);
	if ($hash === $existing_hash) {
		return true;
	}else{
		return false;
	}
}

function admin_logged_in(){
	return isset($_SESSION["admin_id"]);
}

function attempt_admin_login($username, $password){
	$admin = get_admin_by_username($username);
	if ($admin) {
		// Found admin, now check passord
		if (password_check($password, $admin["admin_password"])) {
			// Password matches
			return $admin;
		}else{
			// Password was not match
			return false;
		}
	}else{
		// admin not found
		return false;
	}
}

function get_admin_by_username($username){
	global $connection;
	// peforming query for specific admin
	$safe_username = mysql_prep($username);
	$query = "SELECT * FROM admins";
	$query .= " WHERE admin_username = '{$safe_username}'";
	$query .= " LIMIT 1";
	$results = mysqli_query($connection, $query);
	// Testing if there was a query error
	query_check($results);
	if ($admin = mysqli_fetch_assoc($results)) {
		return $admin;
	}else{
		return null;
	}
}

function get_artworks(){
	global $connection;
	// performing query for all artworks
	$query = "SELECT * from artworks";
	$results = mysqli_query($connection, $query);
	// Testing query
	query_check($results);
	return $results;
}

function get_artwork_by_name($artwork_name){
	global $connection;
	// peforming query for specific admin
	$safe_artwork_name = mysql_prep($artwork_name);
	$query = "SELECT * FROM artworks";
	$query .= " WHERE artwork_name = '{$safe_artwork_name}'";
	$query .= " LIMIT 1";
	$results = mysqli_query($connection, $query);
	// Testing if there was a query error
	query_check($results);
	if ($artwork = mysqli_fetch_assoc($results)) {
		return $artwork;
	}else{
		return null;
	}
}

function get_artwork_by_id($artwork_id){
	global $connection;
	// peforming query for specific admin
	$query = "SELECT * FROM artworks";
	$query .= " WHERE artwork_id = '{$artwork_id}'";
	$query .= " LIMIT 1";
	$results = mysqli_query($connection, $query);
	// Testing if there was a query error
	query_check($results);
	if ($artwork = mysqli_fetch_assoc($results)) {
		return $artwork;
	}else{
		return null;
	}
}

function get_banner_info(){
	global $connection;
	// Query to get banner text
	$query = "SELECT * FROM banner_info WHERE banner_id = 1";
	$results = mysqli_query($connection, $query);
	// Testing query
	query_check($results);
	if ($banner_text = mysqli_fetch_assoc($results)) {
		return $banner_text;
	}else{
		return null;
	}
}

function get_about_info(){
	global $connection;
	// performing query for aout info
	$query = "SELECT * from about";
	$results = mysqli_query($connection, $query);
	// Testing query
	query_check($results);
	if ($about_info = mysqli_fetch_assoc($results)) {
		return $about_info;
	}else{
		return null;
	}
}


?>
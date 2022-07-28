<?php

	define("DB_HOST", "localhost");
	define("DB_USER", "root");
	define("DB_PASSWORD", "");
	define("DB_NAME", "okanta");

	$connection = mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);

	if (mysqli_connect_error()) {
		die("Database connection failed "
			.
		 mysqli_connect_error()
		);
	}

	// define("DB_HOST", "sql6.freesqldatabase.com");
	// define("DB_USER", "sql6448765");
	// define("DB_PASSWORD", "WcDWJxbtmA");
	// define("DB_NAME", "sql6448765");

	// $connection = mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);

	// if (mysqli_connect_error()) {
	// 	die("Database connection failed "
	// 		.
	// 	 mysqli_connect_error()
	// 	);
	// }

?>
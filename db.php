<?php
	// DO NOT MODIFY(this is the database connection)


	$user="root";
	$pass="Group3";
	$dsn="mysql:host=localhost;dbname=se265win17group3;";

	try {

		$db = new PDO($dsn, $user, $pass);
		$db->setAttribute( PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION );

		//echo "Database connected successfully! "; //displayed on every page where a database connection is made.
	}
	catch (PDOException $e) {
	
		echo 'ERROR: ' . $e->getMessage();
	}
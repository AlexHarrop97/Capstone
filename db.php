<?php
	// DO NOT MODIFY(this is the database connection)


	$user="group3";
	$pass="Group3";
	$dsn="mysql:host=sql.neit.edu;port=5500;dbname=se265win17group3;";

	try {

		$db = new PDO($dsn, $user, $pass);
		$db->setAttribute( PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION );

		echo 'Connected!';
	}
	catch (PDOException $e) {
	
		echo 'ERROR: ' . $e->getMessage();
	}
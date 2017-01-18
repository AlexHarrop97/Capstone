<?php

	$user="group3";
	$pass="group3";
	$dsn="sqlsrv:Server=sql.neit.edu,4500;Database=SE265Win17Group3";

	try {

		$db = new PDO($dsn, $user, $pass);
		$db->setAttribute( PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION );

		echo 'Connected!';
	}
	catch (PDOException $e) {
	
		echo 'ERROR: ' . $e->getMessage();
	}
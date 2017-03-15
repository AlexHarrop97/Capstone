<?php

//Connection to Database

$user="group3";
$pass="Group3";
$dsn="mysql:host=sql.neit.edu;port=5500;dbname=se265win17group3;";
	//$user="test";
	//$pass="qwe";
	//$dsn="mysql:host=localhost;dbname=test2;";
try {
        $db = new PDO($dsn, $user, $pass);
        $db->setAttribute( PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION );
} catch (PDOException $e) {
        echo 'ERROR: ' . $e->getMessage();
}

//Check Session info, redirect to login if no info
Function isLoggedIn ($Email, $UserID) {
        if ($Email == "" && $UserID == ""){
                header('Location: index.php');
        }
}


<?php

//Connection to Database
$user="group3";
$pass="Group3";
$dsn="mysql:host=sql.neit.edu;port=5500;dbname=se265win17group3;";
	//$user="user";
	//$pass="qwe";
	//$dsn="mysql:host=localhost;dbname=test;";
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

Function proUserCount ($Admin, $ProjectName) {
        require_once('command.php');
        $st = $db->prepare('SELECT User_ID FROM projects WHERE Admin=:Admin AND ProjectName=:ProjectName');
        $st->bindParam(':Admin', $Admin);
        $st->bindParam(':ProjectName', $ProjectName);
        $st->execute();
        $r = $st->rowCount();
        echo $r;
}
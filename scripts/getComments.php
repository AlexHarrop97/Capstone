<?php

require_once('../dependencies/db.php');

try { 

	$getUser = $db->prepare('SELECT * FROM users');
	$getUser->execute();
	$users = $getUser->fetchAll();

	$sendComment = $db->prepare('INSERT INTO comments (User_ID, Message_Text, Message_Time, Project_ID) VALUES (:uID, :mText, :mTime, :pID)');
	$sendComment->bindParam(':uID', $getUser);
	$sendComment->bindParam(':mText', $_POST["commentBox"]);
	$sendComment->bindParam(':mTime', date("m/d/Y H:i:s"));
	$sendComment->bindParam(':pID', '000');
	$sendComment->execute();

	$getComment = $db->prepare('SELECT * FROM comments');
	$getComment->execute();
	$comments = $getComment->fetchAll();

	foreach ($comments as $comment) {

		echo $comment[""]

		if ($comment["User_ID"])
	}


	foreach ($users as $user) {

		$userFirst = $user["FirstName"];
		$userLast = $user["LastName"];
	}

}
catch (PDOException $e) { 

}




















?>
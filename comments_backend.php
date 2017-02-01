<?php

require_once(../db.php);

try { 

	$getUser = $db->prepare('SELECT User_ID FROM users WHERE (Email = :email');
	$getUser->bindParam(':email', $_SESSION["User"]);
	$getUser->execute();

	$sendComment = $db->prepare('INSERT INTO comments (User_ID, Message_Text, Message_Time) VALUES (:uID, :mText, :mTime)');
	$sendComment->bindParam(':uID', $getUser);
	$sendComment->bindParam(':mText', $_POST["commentBox"]);
	$sendComment->bindParam(':mTime', date("m/d/Y H:i:s"));
	$sendComment->execute();
}
catch (PDOException $e) { 

}




















?>
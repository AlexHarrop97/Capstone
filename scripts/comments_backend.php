<?php

require_once(../db.php);

try { 
	$sendComment = $db->prepare('INSERT INTO comments (Message_ID, User_ID, Message_Text, Message_Time, Project_ID) VALUES (:mID, :uID, :mText, :mTime, :pID)');

	$getUser = $db->prepare('SELECT User_ID FROM users WHERE (Email = :email');
	$getUser->bindParam(':email', $_SESSION["User"]);
	$getUser->execute();
	$userInfo = $getUser->fetchAll();

	echo
}
catch (PDOException $e) { 

}




















?>
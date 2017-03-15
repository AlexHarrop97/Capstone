
<?php

require_once('command.php');

try { 

	$getUser = $db->prepare('SELECT * FROM users');
	$getUser->execute();
	$users = $getUser->fetchAll();

	$getComment = $db->prepare('SELECT * FROM comments');
	$getComment->execute();
	$comments = $getComment->fetchAll();

	$template = $user["FirstName"] . $user["LastName"]

}
catch (PDOException $e) { 

}
?>
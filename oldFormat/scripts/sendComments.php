<<<<<<< HEAD
<?php

require_once('command.php');

$dateAndTime = date("m/d/Y H:i:s");
$tempProjectID = 0;

try {
	
	$sendComment = $db->prepare('INSERT INTO comments (User_ID, Message_Text, Message_Time, Project_ID) VALUES (:uID, :mText, :mTime, :pID)');
	$sendComment->bindParam(':uID', $_SESSION["User_ID"]);
	$sendComment->bindParam(':mText', $_POST["msgBox"]);
	$sendComment->bindParam(':mTime', $dateAndTime);
	$sendComment->bindParam(':pID', $tempProjectID);
	$sendComment->execute();

	header('Location: ../comments.php');

}
catch (PDOException $e) { 

	die('WARNING: ' . $e->getMessage());
}


=======
<?php

require_once('command.php');

try { 

	$getUser = $db->prepare('SELECT User_ID FROM users WHERE (Email = :email');
	$getUser->bindParam(':email', $_SESSION["User"]);
	$getUser->execute();

	$sendComment = $db->prepare('INSERT INTO comments (User_ID, Message_Text, Message_Time, Project_ID) VALUES (:uID, :mText, :mTime, :pID)');
	$sendComment->bindParam(':uID', $getUser);
	$sendComment->bindParam(':mText', $_POST["commentBox"]);
	$sendComment->bindParam(':mTime', date("m/d/Y H:i:s"));
	$sendComment->bindParam(':pID', '000');
	$sendComment->execute();

	header('Location: ../comments.php');

}
catch (PDOException $e) { 

}




















>>>>>>> 35519da983aaf91d4bd283179e2f634f3e51daa7
?>
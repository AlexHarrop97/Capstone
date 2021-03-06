
<?php
session_start();

require_once('command.php');

$dateAndTime = date("m/d/Y H:i:s");
$ProjectID = $_GET['ProjectID'];

try {
	
	$sendComment = $db->prepare('INSERT INTO comments (User_ID, Message_Text, Message_Time, Project_ID) '.
                                'VALUES (:uID, :mText, :mTime, :pID)');
	$sendComment->bindParam(':uID', $_GET["User_ID"]);
	$sendComment->bindParam(':mText', $_POST["msgBox"]);
	$sendComment->bindParam(':mTime', $dateAndTime);
	$sendComment->bindParam(':pID', $ProjectID);
	$sendComment->execute();

	header('Location: ../project.php?ProjectID='.$_GET['ProjectID']);

}
catch (PDOException $e) { 

	die('WARNING: ' . $e->getMessage());
}

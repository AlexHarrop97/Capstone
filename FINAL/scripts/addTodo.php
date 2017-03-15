<?php
session_start();
require_once('command.php');

echo $_GET['ProjectID'];
try {

    $Description = $_POST["add"];
    $UserID = $_GET['UserID'];
    $ProjectID = $_GET['ProjectID'];
    $Status = $_GET['Status'];

    $stmt = $db->prepare("INSERT INTO todo (User_ID, Project_ID, Description, Status) VALUES (:user_id, :project_id, :description, :status)");
    $stmt->bindParam(':description', $Description);
    $stmt->bindParam(':user_id', $UserID);
    $stmt->bindParam(':project_id', $ProjectID);
    $stmt->bindParam(':status', $Status);
    $stmt->execute();

    echo "fuck yea";
    header('Location: ../project.php?ProjectID='.$ProjectID);

}
catch (PDOException $e) {
    echo $UserID.$Description.$ProjectID.$Status;
    die('New Todo Failed!');

}

echo $UserID
?>


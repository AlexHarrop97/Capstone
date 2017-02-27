<?php
session_start();
require_once('../db.php');


try {

    $Description = $_POST["add"];
    $UserID = $_GET['userID'];
    $ProjectID = 4;

    $stmt = $db->prepare("INSERT INTO todo (User_ID, Project_ID, Description) VALUES (:user_id, :project_id, :description)");
    $stmt->bindParam(':description', $Description);
    $stmt->bindParam(':user_id', $UserID);
    $stmt->bindParam(':project_id', $ProjectID);
    $stmt->execute();

    echo "fuck yea";

}
catch (PDOException $e) {
    echo $UserID.$Description;
    die('New Todo Failed!');

}

echo $UserID;
?>


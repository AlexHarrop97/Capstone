<?php
session_start();
require_once('command.php');


try {

    $ProjectName = $_POST["add"];
    $UserID = $_GET['userID'];

    $stmt = $db->prepare("INSERT INTO projects (User_ID, Admin, ProjectName) VALUES (:user_id, :admin_id, :projectname)");
    $stmt->bindParam(':user_id', $UserID);
    $stmt->bindParam(':admin_id', $UserID);
    $stmt->bindParam(':projectname', $ProjectName);
    $stmt->execute();

    echo "fuck yea";

}
catch (PDOException $e) {
    echo $UserID.$Description;
    die('New Todo Failed!');

}

echo $UserID
?>


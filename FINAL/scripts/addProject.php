<?php
session_start();
require_once('command.php');


try {

    $ProjectName = $_POST["ProjectName"];
    $UserID = $_GET['userID'];

    $stmt = $db->prepare("INSERT INTO projects (User_ID, Admin, ProjectName) VALUES (:user_id, :admin_id, :projectname)");
    $stmt->bindParam(':user_id', $UserID);
    $stmt->bindParam(':admin_id', $UserID);
    $stmt->bindParam(':projectname', $ProjectName);
    $stmt->execute();

    echo "fuck yea";
    header('Location: ../profile.php');

}
catch (PDOException $e) {
    echo $UserID.$ProjectName;
    die('New Project Failed!');

}

echo $UserID
?>

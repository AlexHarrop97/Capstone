<?php
session_start();
require_once('command.php');
    $projectID = $_GET["ProjectID"];
    $adminID = $_GET["Admin"];
    $userEmail = $_POST["email"];
    $projectName = $_GET["ProjectName"];
try{
    $stmt = $db->prepare('SELECT * FROM users');
    $stmt->bindParam(':email', $UserEmail);
    $stmt->execute();
    $invite = $stmt->fetchAll();
    foreach ($invite as $r) {
        if ($userEmail == $r["Email"]) {
            $inviteUser = $r['User_ID'];
            $stmt = $db->prepare('INSERT INTO Projects (User_ID, Admin, ProjectName) VALUES (:User_ID, :Admin, :ProjectName)');
            $stmt->bindParam(':User_ID', $inviteUser);
            $stmt->bindParam(':Admin', $adminID);
            $stmt->bindParam(':ProjectName', $projectName);
            $stmt->execute();
            echo "Invite sent";
        }
        header('Location: ../project.php?ProjectID='.$_GET['ProjectID']);
    }
}
catch (PDOException $e) {

    die('Invite Failed!');
}
?>

<?php
session_start();
require_once('../db.php');
    $projectID = $_GET["ProjectID"];
    $adminID = $_GET["Admin"];
    $userEmail = $_POST["email"];
try{
    echo $userEmail;
    $stmt = $db->prepare('SELECT * FROM users');
    $stmt->bindParam(':email', $UserEmail);
    $stmt->execute();
    $invite = $stmt->fetchAll();
    foreach ($invite as $r) {
        if ($userEmail == $r["Email"]) {
            $inviteUser = $r['User_ID'];
            $detail = "invitedToID:".$projectID.",byUserID:".$_SESSION['UserID'];
            $stmt = $db->prepare('INSERT INTO Projects (User_ID, Admin, ProjectName) VALUES (:User_ID, :Admin, :ProjectName)');
            $stmt->bindParam(':User_ID', $inviteUser);
            $stmt->bindParam(':Admin', $adminID);
            $stmt->bindParam(':ProjectName', $detail);
            $stmt->execute();
            echo "Invite sent";
        }
        //try{
        //$stmt = $db->prepare('INSERT INTO Projects (User_ID, Admin, ProjectName) VALUES (:User_ID, :Admin, :ProjectName)');
        //$stmt->bindParam(':User_ID', $inviteUser);
        //$stmt->bindParam(':Admin', $adminID);
        //$stmt->bindParam(':ProjectName', $detail);
        //$stmt->execute();
        //echo "Invite sent";
        //}
        //catch (PDOException $e) {
        //    die('Invite Failed!');
        //}
    }
}
catch (PDOException $e) {

    die('Invite Failed!');
}
?>
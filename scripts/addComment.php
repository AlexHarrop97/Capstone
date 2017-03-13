<?php
session_start();
require_once('command.php');

try {

    $Message_Text = $_POST["add"];
    $UserID = $_GET['UserID'];
    $ProjectID = $_GET['ProjectID'];
    $Message_Time = $date = date('m/d/Y h:i:s a', time());

    

    $stmt = $db->prepare("INSERT INTO comments (User_ID, Message_Text, Message_Time) ".
                              "VALUES (:user_id, :messagetext, :messagetime)");
    $stmt->bindParam(':messagetext', $Message_Text);
    $stmt->bindParam(':user_id', $UserID);
    $stmt->bindParam(':messagetime', $Message_Time);
    $stmt->execute();

    echo "fuck yea";
    header('Location: ../project.php?ProjectID='.$ProjectID);

}
catch (PDOException $e) {
    echo $UserID.$Message_Text.$ProjectID;
    die('Adding Comment Failed!');

}

echo $_POST["add"].$_GET['UserID'].$_GET['ProjectID'];
?>


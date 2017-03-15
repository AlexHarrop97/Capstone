<?php

require_once('command.php');
$TodoID = $_GET["Todo_ID"];
$ProjectID = $_GET['ProjectID'];
$Status = 1;
try {

    // Select the proper to-do id
    $stmt = $db->prepare('UPDATE todo SET Status=:Status WHERE (Todo_ID=:Todo_ID');
    $stmt->bindParam(':Todo_ID', $TodoID);
    $stmt->bindParam(':Status', $Status);
    $stmt->execute();
    $results = $stmt->fetchAll();

    foreach ($results as $a) {

        echo "did";
    }
}
catch (PDOException $e) {

    die('Update Failed! ');
}
?>
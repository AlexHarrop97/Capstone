<?php

require_once('command.php');

try {

    $TodoID = $_GET["Todo_ID"];
    $ProjectID = $_GET['ProjectID'];
    $Status = 1;

    // Select the proper to-do id
    $stmt = $db->prepare('DELETE FROM todo WHERE Todo_ID=:Todo_ID');
    $stmt->bindParam(':Todo_ID', $TodoID);
    $stmt->execute();
    $results = $stmt->fetchAll();

    header('Location: ../project.php?ProjectID='.$ProjectID);

}
catch (PDOException $e) {

    header('Location: ../project.php?ProjectID='.$ProjectID);
    
}
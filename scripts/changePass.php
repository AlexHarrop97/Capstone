<?php
session_start();
require_once('command.php');

try {
    $OldPass = $_POST["oldPass"];
    $Email = $_SESSION['Email'];
    $NewPass = $_POST["newPass"];
    $NewPassConfirm = $_POST["newPassConfirm"];
    //Match passwords
    if ($NewPass == $NewPassConfirm){
        $a = $db->prepare('SELECT P4WD FROM users WHERE Email=:Email');
        $a->bindParam(':Email', $Email);
        $a->execute();
        $a = $a->fetch();
        print_r($a);
        //current pass match old
        if (password_verify($OldPass, $a[0])){
            $Password = password_hash($NewPass, PASSWORD_DEFAULT);
            $b = $db->prepare('UPDATE users SET P4WD=:pw WHERE Email=:Email');
            $b->bindParam(':pw', $Password);
            $b->bindParam(':Email', $Email);
            $b->execute();
            header('Location: ../index.php?pwchange=1');
        } else {
            header('Location: ../profile.php?pwchange=current');
        }
    } else {
        header('Location: ../profile.php?pwchange=match');
    }
} catch (PDOException $e) {

    die('Failed Query: ' . $e->getMessage());
}
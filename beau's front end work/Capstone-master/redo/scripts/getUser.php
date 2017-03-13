<?php

// This file completes the login, users are sent here from the login page
// login.php is the default page of the website.

require_once('command.php');

try {

    $Email = $_POST["userName"];
    $Password = $_POST["password"];

    // Select all using user and password textboxes on login.php
    $stmt = $db->prepare('SELECT * FROM users WHERE Email=:email');
    $stmt->bindParam(':email', $Email);
    $stmt->execute();
    $users = $stmt->fetchAll();

    // start the session, set the session variable for User
    // then redirect back to index.php
    session_start();

    // check the user to see if it exists within the database
    foreach ($users as $user) {

        if (password_verify($Password, $user["P4WD"])) {

            $_SESSION['Email'] = $Email;
            $_SESSION['Password'] = $Password;
            $_SESSION['UserID'] = $user['User_ID'];
            header('Location: ../profile.php');

        }

        else {

            header('Location: ../index.php?loginSuccess=0');
            echo "<p>Password doesn't match</p>";
        }
    }
}
catch (PDOException $e) {

    die('Sign In Failed! ');
}
?>

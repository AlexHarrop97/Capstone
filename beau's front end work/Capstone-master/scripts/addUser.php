<?php
// this is where the user is created
// the information is obtained from the register_user.php file using post method
require_once('command.php');
try {

    $Email = $_POST["userName"];
    $FirstName = $_POST["firstName"];
    $LastName = $_POST["lastName"];
    $Password = $_POST["password"];
    $PassConfirm = $_POST["passConfirm"];

    $emailCheck = $db->prepare("SELECT * FROM users WHERE (Email = :email)");
    $emailCheck->bindParam(':email', $Email);
    $emailCheck->execute();
    $result = $emailCheck->fetchAll();
    $stmt = $db->prepare("INSERT INTO users (Email, P4WD, FirstName, LastName) VALUES (:email, :pass, :fname, :lname)");
    $stmt->bindParam(':email', $Email);
    $stmt->bindParam(':pass', $Password);
    $stmt->bindParam(':fname', $FirstName);
    $stmt->bindParam(':lname', $LastName);
    // PASSWORD CHECK
    if ($_POST["password"] != $_POST["passConfirm"]) {
        echo "The passwords do not match!";
    }
    // EMAIL CHECK
    else if ( !emailCheck($result, $Email) == false ) {
        echo "This email address is already registered to an account. ";
    }
    else {
        $Password = password_hash($_POST["password"], PASSWORD_DEFAULT);
        $stmt->execute();

        echo "Successfully Registered!";
        //header('Location: ../index.php');
    }
}
catch (PDOException $e) {

    die('Failed Query: ' . $e->getMessage());
}
function emailCheck($fetchResults, $emailIn) {
    foreach($fetchResults as $found) {
        if($found["Email"] == $emailIn) {
            return false;
        }
        else {
            return true;
        }
    }
}
?>
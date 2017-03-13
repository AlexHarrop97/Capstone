
<?php
session_start();


// this is where the user is created
// the information is obtained from the register_user.php file using post method

require_once('command.php');

// check if the old pass is right
try {
    //get old posted old pass
    $OldPass = $_POST["oldPass"];
    $Email = $_SESSION['Email'];

    $stmt = $db->prepare('SELECT * FROM users WHERE Email=:email');
    $stmt->bindParam(':email', $Email);
    $stmt->execute();
    $users = $stmt->fetchAll();

    // Get the user's password to verify
    foreach ($users as $user) {

        if (password_verify($OldPass, $user["P4WD"])) {

           // Get adding the new passwords

            try {

                $NewPass = $_POST["newPass"];
                $NewPassConfirm = $_POST["newPassConfirm"];

                //This is a password check so the user enters the correct password
                if ($_POST["newPass"] != $_POST["newPassConfirm"]) {

                    echo "The passwords do not match!";
                }
                //This occurs if the above statements are not true
                //the email cannot match an existing email and the passwords must match on register.php
                else {

                    $stmt = $db->prepare("UPDATE users SET P4WD=:newPass WHERE (Email = :email)");
                    $stmt->bindParam(':newPass', password_hash($NewPass, PASSWORD_DEFAULT));
                    $stmt->bindParam(':email', $_SESSION["User_Email"]);
                    $stmt->execute();

                    echo "Password Successfully Changed!";

                    //redirect user back to homepage
                    session_unset();
                    session_destroy();
                    header('Location: ../index.php?passChange=true');
                }
            }
            catch (PDOException $e) {

                die('Failed Query: ' . $e->getMessage());
            }

        }

        else {

            //YOU TYPED THE WRONG PASS
            header('Location: ../Profile.php?pwchange=1');
        }
    }
}
catch (PDOException $e) {

    die('Sign In Failed! ');
}


catch (PDOException $e) {

    die('Failed Query: ' . $e->getMessage());
}
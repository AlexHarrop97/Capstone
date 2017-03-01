
<?php
// this is where the user is created
// the information is obtained from the register_user.php file using post method

require_once('../dependencies/db.php');

try {
	
	$NewPass = $_POST["newPass"];
	$NewPassConfirm = $_POST["newPassConfirm"];

	if (!password_verify($_POST["currentPass"], $_SESSION["User_Password"])) {

		echo "Your current password is incorrect!";
	}
	//This is a password check so the user enters the correct password
	else if ($_POST["newPass"] != $_POST["newPassConfirm"]) {

		echo "The passwords do not match!";
	}
	//This occurs if the above statements are not true
	//the email cannot match an existing email and the passwords must match on register.php
	else {

		$stmt = $db->prepare("UPDATE users SET P4WD=:pass WHERE (Email = :email)");
		$stmt->bindParam(':pass', password_hash($NewPass, PASSWORD_DEFAULT));
		$stmt->bindParam(':email', $_SESSION["User_Email"]);
		$stmt->execute();
		
		echo "Password Successfully Changed!";

		//redirect user back to homepage
		session_unset();
		session_destroy();
		header('Location: ../login.php?passChange=true');
	}
}
catch (PDOException $e) {
	
	die('Failed Query: ' . $e->getMessage());
}
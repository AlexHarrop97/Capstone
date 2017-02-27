<?php
// this is where the user is created
// the information is obtained from the register_user.php file using post method

require_once('../dependencies/db.php');

try {
	
	$NewPass = $_POST["newPass"];
	$NewPassConfirm = $_POST["newPassConfirm"];

	$stmt = $db->prepare("UPDATE users SET P4WD=:pass");
	$stmt->bindParam(':pass', $NewPass);

	if (!password_verify($_POST["currentPass"], $_SESSION["User_Pass"])) {

		echo "Your current password is incorrect!";
	}
	//This is a password check so the user enters the correct password
	else if ($_POST["newPass"] != $_POST["newPassConfirm"]) {

		echo "The passwords do not match!";
	}
	//This occurs if the above statements are not true
	//the email cannot match an existing email and the passwords must match on register.php
	else {

		$stmt->execute();
		
		echo "Password Successfully Changed!";

		//redirect user back to homepage
		//header('Location: ../index.php');
	}
}
catch (PDOException $e) {
	
	die('Failed Query: ' . $e->getMessage());
}
?>
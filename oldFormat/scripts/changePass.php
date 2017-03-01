<?php
// this is where the user is created
// the information is obtained from the register_user.php file using post method

require_once('../dependencies/db.php');

try {
	
	$NewPass = $_POST["newPass"];
	$NewPassConfirm = $_POST["newPassConfirm"];
	$User_ID = $_SESSION["User_ID"]
	//WHAT THE FUCK IS THIS SHIT
	//$passCheck = $db->prepare("SELECT * FROM users");
	//YOU SHITTING ME RIGHT NOW
	//GAWD DAMN, NO WONDER ONLY THE LATEST USER CAN LOG IN
	//FUCK
	$passCheck = $db->prepare('SELECT * FROM users WHERE User_ID=:User_ID');
	$stmt->bindParam(':User_ID', $User_ID);
	$passCheck->execute();
	$users = $passCheck->fetchAll();

	foreach ($users as $user) {

		if (password_verify($_POST["currentPass"], $user["P4WD"])) 
		{
			$password = $user["P4WD"];
		}
		
	}

	if (!password_verify($_POST["currentPass"], $password)) {

		echo "Your current password is incorrect!";
	}
	//This is a password check so the user enters the correct password
	else if ($_POST["newPass"] != $_POST["newPassConfirm"]) {

		echo "The passwords do not match!";
	}
	//This occurs if the above statements are not true
	//the email cannot match an existing email and the passwords must match on register.php
	else {

		$stmt = $db->prepare("UPDATE users SET P4WD=:pass");
		$stmt->bindParam(':pass', password_hash($NewPass, PASSWORD_DEFAULT));
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
?>
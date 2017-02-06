<?php
// this is where the user is created
// the information is obtained from the register_user.php file using post method

require_once('../db.php');

try {
	
	$stmt = $db->prepare("SELECT * FROM users)");
	$stmt->execute();
	$users = $stmt->fetchAll();
	
	foreach ($users as $user) {

		if ($user["Email"] == $_SESSION["User"]) {

			$userID = $user["User_ID"];
			$userFName = $user["FirstName"];
			$userLName = $user["LastName"];
			$userEmail = $user["Email"];
			$userPass = $user["P4WD"];
		}
	}

	if ($_POST["password"] != $_POST["passConfirm"]) {

		echo "The passwords do not match! ";
	}
	else {

		$Password = password_hash($_POST["password"], PASSWORD_DEFAULT);
		$stmt->execute();
		
	}
	
	
	echo "Successfully Registered!";
	
	//redirect user back to homepage
	//header('Location: index.php');
}
catch (PDOException $e) {
	
	die('Registration Failed! ');
}
?>
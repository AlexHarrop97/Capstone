<?php
// this is where the user is created
// the information is obtained from the register_user.php file using post method

require_once('../dependencies/db.php');

try {
	
	$emailCheck = $db->prepare("SELECT Email FROM users)");
	$emailCheck->execute();
	$result = $emailCheck->fetchAll();

	$stmt = $db->prepare("INSERT INTO users (Email, P4WD, FirstName, LastName) VALUES (:email, :pass, :fname, :lname)");
	$stmt->bindParam(':email', $Email);
	$stmt->bindParam(':pass', $Password);
	$stmt->bindParam(':fname', $FirstName);
	$stmt->bindParam(':lname', $LastName);
	
	$Email = $_POST["userName"];
	$FirstName = $_POST["firstName"];
	$LastName = $_POST["lastName"];
	

	// this checks to see if both password and passConfirm match before it is thrown into the database
	// if the passwords match, the statment will execute
	// if not, the user will have to try again.
	


	foreach ($result as $email) {

		if ($email["Email"] == $_POST["userName"]) {

			echo "This email address is already registered to an account. ";
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
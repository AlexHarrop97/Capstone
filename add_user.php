<?php
// this is where the user is created
// the information is obtained from the register_user.php file using post method

require_once('db.php');

try {
	
	
	$stmt = $db->prepare("INSERT INTO users (Email, P4WD, FirstName, LastName, AccessLevel) VALUES (:email, :pass, :fname, :lname, :accesslvl)");
	$stmt->bindParam(':email', $Email);
	$stmt->bindParam(':pass', $Password);
	$stmt->bindParam(':fname', $FirstName);
	$stmt->bindParam(':lname', $LastName);
	$stmt->bindParam(':accesslvl', $AccessLevel);
	
	$Email = $_POST["userName"];
	$FirstName = $_POST["firstName"];
	$LastName = $_POST["lastName"];
	
	// 0=User AccessLevel       
	// 1=Admin AccessLevel
	// This line sets the default access level
	$AccessLevel = '0';
	

	// this checks to see if both password and passConfirm match before it is thrown into the database
	// if the passwords match, the statment will execute
	// if not, the user will have to try again.
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
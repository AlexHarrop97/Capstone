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
	
	print_r($_POST);

	$stmt = $db->prepare("INSERT INTO users ".
						 "(Email, P4WD, FirstName, LastName) ".
						 "VALUES (:email, :pass, :fname, :lname)");
						 //" WHERE Email REGEXP '[a-zA-Z0-9]+(?:(\.|_)[A-Za-z0-9!#$%&'*+/=?^`{|}~-]+)".
						 //"*@(?!([a-zA-Z0-9]*\.[a-zA-Z0-9]*\.[a-zA-Z0-9]*\.))(?:[A-Za-z0-9](?:".
						 //"[a-zA-Z0-9-]*[A-Za-z0-9])?\.)+[a-zA-Z0-9](?:[a-zA-Z0-9-]*[a-zA-Z0-9])?'")
	$stmt->bindParam(':email', $Email);
	$stmt->bindParam(':pass', $Password);
	$stmt->bindParam(':fname', $FirstName);
	$stmt->bindParam(':lname', $LastName);

	$Password = password_hash($_POST["password"], PASSWORD_DEFAULT);
	$stmt->execute();

	echo "Successfully Registered!";
	
	
	//redirect user back to homepage
	//header('Location: index.php');
}
catch (PDOException $e) {
	
	die('Registration Failed! ');
}
?>

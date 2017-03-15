<?php
// this is where the user is created
require_once('command.php');

try {
	
	$Email = $_POST["userName"];
	$FirstName = $_POST["firstName"];
	$LastName = $_POST["lastName"];
	$Password = $_POST["password"];
	$PassConfirm = $_POST["passConfirm"];
	
	//no blank fields
	if ($Email != "" && $FirstName != "" && $LastName != "" && $Password != "" && $PassConfirm != ""){
		//passwords need to match
		if ($Password == $PassConfirm){
			//validate email
			if (!filter_var($Email, FILTER_VALIDATE_EMAIL) === false) {
				//No existing email
				$a = $db->prepare('SELECT * FROM users WHERE Email=:email');
				$a->bindParam(':email', $Email);
				$a->execute();
				if ($a->rowCount() == 0){
					//hash pass
					$Password = password_hash($_POST["password"], PASSWORD_DEFAULT);
					//insert
					$b = $db->prepare("INSERT INTO users (Email, P4WD, FirstName, LastName) VALUES (:email, :pass, :fname, :lname)");
					$b->bindParam(':email', $Email);
					$b->bindParam(':pass', $Password);
					$b->bindParam(':fname', $FirstName);
					$b->bindParam(':lname', $LastName);
					$b->execute();

					//redirect user back to homepage
					header('Location: ../index.php?register=1');
				} else {
					header('Location: ../register.php?regfail=existing');
				}
			} else {
				header('Location: ../register.php?regfail=email');
			}
		} else {
			header('Location: ../register.php?regfail=pass');
		}
	} else {
		header('Location: ../register.php?regfail=blank');
	}
} catch (PDOException $e) {
	
	die('Registration Failed! ');
	header('Location: register.php?regfail=1');
}
?>

<<<<<<< HEAD
<?php
// this is where the user is created
// the information is obtained from the register_user.php file using post method

require_once('../dependencies/db.php');

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

	//This is an email check to see if a user already exists with the specified username
	foreach ($result as $found) {

		if ($found["Email"] == $_POST["userName"]) {

			echo "This email address is already registered to an account. ";
		}
	}

	//This is a password check so the user enters the correct password
	if ($_POST["password"] != $_POST["passConfirm"]) {

		echo "The passwords do not match!";
	}

	//This is an email check to see if a user already exists with the specified username
	else if ( !emailCheck($results, $Email) == false ) {

		echo "This email address is already registered to an account. ";
	}
	//This occurs if the above statements are not true
	//the email cannot match an existing email and the passwords must match on register.php
	else {

		$Password = password_hash($_POST["password"], PASSWORD_DEFAULT);
		$stmt->execute();

		echo $result[0];
		echo "Successfully Registered!";

		//redirect user back to homepage
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

<?php
// this is where the user is created
// the information is obtained from the register_user.php file using post method

require_once('../dependencies/db.php');

try {
	
	$Email = $_POST["userName"];
	$FirstName = $_POST["firstName"];
	$LastName = $_POST["lastName"];
	$Password = $_POST["password"];
	$PassConfirm = $_POST["passConfirm"];
	

	$stmt = $db->prepare("INSERT INTO users (Email, P4WD, FirstName, LastName) VALUES (:email, :pass, :fname, :lname)");
	$stmt->bindParam(':email', $Email);
	$stmt->bindParam(':pass', $Password);
	$stmt->bindParam(':fname', $FirstName);
	$stmt->bindParam(':lname', $LastName);


	// this checks to see if both password and passConfirm match before it is thrown into the database
	// if the passwords match, the statment will execute
	// if not, the user will have to try again.
	


	foreach ($result as $email) {

		if ($email["Email"] == $_POST["userName"]) {

			echo "This email address is already registered to an account. ";
		}
	}

	if ($_POST["password"] != $_POST["passConfirm"]) {

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

<?php
session_start();
require_once("db.php");

if (isset($_POST['username']))
{
  $username = $_POST['username'];
  $pword = $_POST['password'];
  try
  {
    //grabs record for the username
    $stmt = $db->prepare("SELECT * FROM users WHERE uName = :username");
    $stmt->bindParam(':username', $username, PDO::PARAM_STR);
    $stmt->execute();
    $results = $stmt->fetch();
    //plug store pass into $hashPass
    $hashPass = $results['pwd'];
    $username = $results['uName'];
    $firstName = $results['fName'];
    $lastName = $results['lName'];
    $admin = $results['admin'];
    //compares stored Password($hashPass) against password entered($pword)
    if(password_verify($pword, $hashPass))
    {

      $_SESSION['valid'] = true;
      $_SESSION['username'] = $username;
      $_SESSION['firstName'] = $firstName;
      $_SESSION['lastName'] = $lastName;
      $_SESSION['admin'] = $admin;
      //redirect back to index
      header('Location: index.php');

    }

  } catch (PDOException $e)
  {
    die("User $username, does not exist.");
  }

}
?>
<!doctype html>
  <html>
    <head>
      <link rel="stylesheet" type="text/css" href="main.css">
    </head>
    <body>
<?php
//login form
echo "\n<form action='login.php' method='post' id='signup-login'>";
    echo "\n\tName: <input type='text' name = 'username' /><br/>";
    echo "\n\tPassword: <input type='password' name='password' /><br/>";
    echo "\n\t<input type='submit' />";
echo "\n</form>";
echo "\n<p>You do not have an account?</p>";
//links to get around
echo "\n<a href='signup.php' >Sign-up Here</a>";
echo "\n<a href='index.php' >Home</a>";
?>
</body>
</html>

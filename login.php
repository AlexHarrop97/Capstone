<?php
session_start();
require_once("db.php");

if (isset($_POST['email']))
{
  $email = $_POST['email'];
  $password = $_POST['password'];
  try
  {
    //grabs record for the email
    $stmt = $db->prepare("SELECT * FROM users WHERE Email = :email");
    $stmt->bindParam(':email', $email, PDO::PARAM_STR);
    $stmt->execute();
    $results = $stmt->fetch();
    //plug store pass into $hashPass
    $hashPass = $results['P4WD'];
    $email = $results['email'];
    $accessLvl = $results['AccessLevel'];
    //compares stored Password($hashPass) against password entered($pword)
    if(password_verify($password, $hashPass))
    {

      $_SESSION['valid'] = true;
      $_SESSION['Email'] = $email;
      $_SESSION['AccessLevel'] = $accessLvl;
      //redirect back to index
      header('Location: index.php');

    }

  } catch (PDOException $e)
  {
    die("User $email, does not exist.");
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

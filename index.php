<html>
<head>
    <!--Import Google Icon Font-->
    <link href="http://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <!--Import materialize.css-->
    <link type="text/css" rel="stylesheet" href="css/materialize.min.css" media="screen,projection"/>
    <!--Link to Main css document-->
    <link rel="stylesheet" type="text/css" href="css/main.css"
    <!--Let browser know website is optimized for mobile-->
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
</head>
<body>


<!-- Navbar -->
<nav>
    <div class="nav-wrapper black">
        <a href="index.php" class="brand-logo left">Project LinQ</a>
        <ul id="nav-mobile" class="right">
            <li><a href="index.php">Home</a></li>
            <li><a href="profile.php">Profile</a></li>
        </ul>
    </div>
</nav>


<?php
require_once('dependencies/db.php');
session_start();
// check if the session exists(it should have been created in validateUser.php)
// if it exists, send the user back to index and display the logged in message
// if not, send the user back to login.php with a message reading "the account does not exist"
if (isset($_SESSION["User_ID"]) != "") {
    echo "You are currently logged in as <strong>" . $_SESSION["User_FName"] . " " . $_SESSION["User_LName"] . "</strong>";
    echo "<br/>";
    echo "You have a user id of " . $_SESSION["User_ID"] . " (at some point this might be important to you)";

} else {
    //redirect user back to login.php if the session does not exist
    header('Location: login.php');
}
?>


<!-- CHANGE PASSWORD -->
<?php
if (isset($_SESSION["User_ID"]) != "") {
    echo "Change your password here: ";

} else {
    //redirect user back to login.php if the session does not exist
    header('Location: login.php');
}
?>
<div class="row">
    <div class="col s4">
        <div class="card green accent-2">
            <div class="card-content">
                <form action="scripts/changePass.php" method="post">
                    <input placeholder="New Password" type="password" name="newPass"/><br/>
                    <input placeholder="Confirm New Password" type="password" name="newPassConfirm"/><br/>
                    <input type="submit" value="Change Password" name="submitPassChange"/>
                </form>
            </div>
        </div>
    </div>
</div>


<!-- SEND COMMENT -->
<form action="scripts/sendComments.php" method="post">
    <input type="textarea" name="msgBox" value=""/>
    <input type="submit" value="Send" name="submitMsg"/>
</form>


<!-- GRAB COMMENTS -->
<?php
try {
    $getComments = $db->prepare('SELECT * FROM comments INNER JOIN users ON users.User_ID = comments.User_ID WHERE Project_ID = :projectID ORDER BY Message_Time DESC');
    $getComments->bindParam(':projectID', $_GET["Project_ID"]);
    $getComments->execute();
    $results = $getComments->fetchAll();
    foreach ($results as $line) {
        $template = "<p><strong>" . $line["User_FName"] . " " . $line["User_LName"] . "</strong> (" . $line["Message_Time"] . "):" . $line["Message_Text"] . ".</p><br/>";
        echo $template;
    }
} catch (PDOException $e) {
    echo "Query Failed: " . $e->getMessage();
}
?>

<!--Logout-->

<form action="scripts/logout.php" method="post"><input type="submit" value="Logout"/></form>

<!-- This is the footer -->

<footer class="page-footer black">
    <div class="container">
        <div class="row">
            <div class="col l6 s12">
                <h5 class="white-text">Creators</h5>
                <p class="grey-text text-lighten-4">Brendan, Nate, Alex, and Beau.</p>
            </div>
        </div>
    </div>
    <div class="footer-copyright">
        <div class="container">
            © 2017 Copyright Text
            <a class="grey-text text-lighten-4 right" href="#!">Press Me!</a>
        </div>
    </div>
</footer>


<script type="text/javascript" src="https://code.jquery.com/jquery-2.1.1.min.js"></script>
<script type="text/javascript" src="js/materialize.min.js"></script>

</body>
</html>

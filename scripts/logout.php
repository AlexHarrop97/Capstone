<?php
// This file starts the session, sets the session variable for 'User' to a blank string
// destroys the session, then sends the user back to index.php
session_start();
$_SESSION["User"] = "";

session_destroy();
header('Location: ../login.php');

?>

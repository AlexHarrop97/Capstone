<?php
session_unset();
$_SESSION = array();
session_destroy();
header('Location: ../login.php');
?>
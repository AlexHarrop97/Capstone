<html>
<body>
<!-- LOGIN FORM -->
<?php
session_start();
?>
<form action="scripts/getUser.php" method="post">
<ul>
    <li><h2>Login</h2></li>
    <li>Email Address: <input type="text" name="userName" /></li>
    <li>Password: <input type="password" name="password" /></li>
    <li><input type="submit" /></li>
</ul>
</form>

<!-- REGISTER FORM -->
<form action="scripts/addUser.php" method="post">
<ul>
    <li><h2>Register</h2></li>
    <li>Email Address: <input type="text" name="userName" /></li>
    <li>First Name: <input type="text" name="firstName" /></li>
    <li>Last Name: <input type="text" name="lastName" /></li>
    <li>Password: <input type="password" name="password" /></li>
    <li>Confirm Password: <input type="password" name="passConfirm" /></li>
    <li><input type="submit" /></li>
</ul>
</form>




</body>
</html>
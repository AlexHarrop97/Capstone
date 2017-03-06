<html>
<body>
<?php
session_start();
?>

<!-- LOGIN FORM -->
<form action="scripts/getUser.php" method="post">
<table>
    <th><h2>Login</h2></th>
    <tr><td>Email Address:</td><td><input type="text" name="email" /></td></tr>
    <tr><td>Password:</td><td><input type="password" name="password" /></td></tr>
    <tr><td></td><td><input type="submit" /></td></tr>
</table>
</form>

<span><a href="register.php">Register Here</a></span><br/>




</body>
</html>
<?php
session_start();





?>
<html>
<head>

</head>

<body>
	<form action="scripts/sendComments.php" method="post">
	<input type="textarea" name="msgBox" value="Type your message here..."></input>
	<input type="submit" />
	</form>
</body>
<?php
session_start();

require('scripts/getComments.php');




?>
<html>
<head>

</head>

<body>
	<form action="scripts/sendComments.php" method="post">
	<textarea name="commentBox">Type your message here...</textarea>
	<input type="submit" />
	</form>
</body>

</html>
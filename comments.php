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
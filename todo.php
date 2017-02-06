<?php /*
require_once('db.php');

session_start();

if ($_SESSION["User"] != "" && $_SESSION["User"] != null) {

	echo "You are currently logged in as " . $_SESSION["User"];
}
else {

	//redirect user back to login.php if the session does not exist
	header('Location: login.php');
}

if (!isset($_GET["loggedIn"])) {

	SignOut();
}
// Displays the contents in database for todo's
$getTodo = db->prepare("Select * FROM todo INNER JOIN projects ON todo.PROJECT_ID = projects.Project_ID");

$userCheck = db->prepare("Select * FROM projects INNER JOIN users ON users.User_ID = projects.User_ID");

$getTodo->FetchAll();
$userCheck->FetchAll();

foreach ($userCheck as $user) {
 	if ($user["User_ID"] = ) {
 		echo "You have access";
 	}
 	else
 	{
 		echo "you do not have access to this project";
 	}
 }

*/
?> 



<!DOCTYPE html>
<html>
<head>
	<title>Todo List</title>
	<script type="text/javascript"
    src="http://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.js"></script>
</head>
<style type="text/css">
	ul {
		list-style-type: none;
	}

</style>

<body>
	<div id="todo">
		<input type="text" id="newTask">
		<input type="button" id="addTask" value="Add Task">	
		<input type="button" id="delTask" value="Delete Task">	
		<input type="button" id="updateTask" value="Update Task">
	</div>
	<div id="list">
		<h1>To-Do List</h1>
			<ul>
				
			</ul>
	</div>
</body>
<script type="text/javascript">

$(function() {
  var list = [];
  $('#addTask').click(function (){
    var newTask = $('#newTask').val();
    if(newTask != "") {
      list.push('#item');
    }
    if ($('ul').length === 0) {
      $('<ul></ul>').appendTo('#list')
    }
    $('<li>' + newTask + '<input type="checkbox" id="chkbox">' + '</li>'
    	).appendTo('ul')
  });
});

</script>
</html>


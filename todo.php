<?php
require_once('dependencies/db.php');


session_start();

if ($_SESSION["User"] != "" && $_SESSION["User"] != null) {

	echo "You are currently logged in as " . $_SESSION["User"];
}

$query = $db->prepare("
	SELECT todo.User_ID, Description, Status
	FROM todo INNER JOIN projects ON todo.Project_ID = projects.Project_ID
	WHERE todo.User_ID = projects.User_ID;
");

$query->execute([
	'user' => $_SESSION["User"]
	]);

$items = $query->rowCount() ? $query : [];

foreach ($items as $item) {
	echo $item['Description']->Description;
}

?> 



<!DOCTYPE html>
<html>
<head>
	<title>Todo List</title>
	<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.js"></script>
</head>
<style type="text/css">
	ul {
		list-style-type: none;
	}

	.item .done {
		text-decoration: line-through;
	}

</style>

<body>
	<div id="list">
		<h1>To-Do List</h1>
			<?php if(!empty($items)): ?>
			<ul>
				<li><span class="item<?php echo $item['Status'] ? ' Status' : '' ?>"><?php echo $item['Description'];?></span>
					<?php if(!$item['Status']): ?>
						<a href="done.php?as=status&item=<?php echo $item['Todo_ID']; ?>" class="mark-done">
					<?php endif; ?>
				</li>	
			</ul>
			<?php endif; ?>
			<form action="redo/scripts/addTodo.php<?php echo $_SESSION['UserID']?>" method="post">
				<input type="text" name="add" placeholder="Add a new task" class="input" autocomplete="off" action="add.php">
				<input type="submit" value="Add" class="submit">
			</form>
	</div>
</body>
<!-- <script type="text/javascript">

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

</script> -->
</html>



<?php
require_once('dependencies/db.php');
require_once('todo.php');

$getUser = $db->prepare("SELECT * FROM users");
$getUser->execute();
$users = $getUser->fetchAll();

foreach($users as $user) {

	if ($user["Email"] == $_SESSION["User"]) {

		$userId = $user["User_ID"];
	}
	
}


if(isset($_POST['User_ID'])) {
	$userid = trim($_POST['User_ID']);

	if (!empty($userid)) {
		$addedQuery = $db->prepare("
				INSERT INTO todo(User_ID, Project_ID, Description, Status)
				VALUES (:uID, pID, :descr, :stat)
			");
		$addedQuery->bindparam(':uID', $userId);
		$addedQuery->bindparam('pID', '001');
		$addedQuery->bindparam(':descr', $Description);
		$addedQuery->bindparam(':stat', '0');

		$addedQuery->execute();
	}
}
header('Location: todo.php');

<?php
require_once('db.php');
require_once('todo.php');

if(isset($_POST['User_ID'])) {
	$userid = trim($_POST['User_ID']);

	if (!empty($userid)) {
		$addedQuery = $db->prepare("
				INSERT INTO todo(userid, description, status)
				VALUES (:User_ID, :Description, 0())
			");
		$addedQuery->bindparam(':User_ID', $User_ID);
		$addedQuery->bindparam(':Description', $Description);
		$addedQuery->bindparam(':Status', $Status);

		$addedQuery->execute([
			'userid' = $_SESSION['User_ID'],
			'description' = $Description,

			]);
	}
}
header('Location: todo.php');
?>
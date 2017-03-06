<?php
session_start();
require_once('db.php');


try{

    $Email = $_SESSION['Email'];
    $UserID = $_SESSION['UserID'];

    //echo $Email;
    //Select all using user and password textboxes on login.php
    $stmt = $db->prepare('SELECT * FROM users WHERE Email=:email');
    $stmt->bindParam(':email', $Email);
    $stmt->execute();
    $users = $stmt->fetchAll();

    foreach ($users as $user) {

        $UserEmail = $user["Email"];
        $UserFName = $user["FirstName"];
        $UserLName = $user["LastName"];

    }
}
catch (PDOException $e) {

    die('Sign In Failed! ');
}


?>
<!DOCTYPE html>
<html>
<head>
    <title>Profile</title>
    <script type="text/javascript"
            src="http://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.js"></script>
</head>
<style type="text/css">
    ul {
        list-style-type: none;
    }
</style>

<body>
<h1>PROFILE PAGE</h1>
<h2>Welcome, <?php echo $UserFName." ".$UserLName?> | ID: <?php echo $UserID?></h2>

<h3>Info</h3>
<li>TBD...</li>
<h3>Projects</h3>
<?php
$stmt = $db->prepare('SELECT * FROM projects WHERE User_ID=:User_ID');
$stmt->bindParam(':User_ID', $_SESSION['UserID']);
$stmt->execute();
while ($row = $stmt ->fetch(PDO::FETCH_ASSOC)){
    $ProjectName =$row["ProjectName"];
    $ProjectID = $row["Project_ID"];
    $ProjectAdmin =$row["Admin"];
    $ProjectUser = $row["User_ID"];

    //////////////////
    //Admin check
    if ($ProjectUser == $ProjectAdmin){
        ?>
        <a href="project.php?ProjectID=<?php echo $ProjectID?>">
            ID: <?php echo $ProjectID?> |  <?php echo $ProjectName?></a><br />
        <?php
    }
    else {
        $stmt = $db->prepare('SELECT * FROM projects WHERE Admin=:Admin AND ProjectName=:ProjectName');
        $stmt->bindParam(':Admin', $ProjectAdmin);
        $stmt->bindParam(':ProjectName', $ProjectName);
        $stmt->execute();
        while ($reroute = $stmt ->fetch(PDO::FETCH_ASSOC)){
            $ProjectName = $reroute["ProjectName"];
            $ProjectID = $reroute["Project_ID"];
            ?>
            <a href="project.php?ProjectID=<?php echo $ProjectID?>">
                ID: <?php echo $ProjectID?> |  <?php echo $ProjectName?></a><br />
            <?php
        }
    }
}
?>
<br /><br />
New Project<br />
<form action="scripts/addProject.php?userID=<?php echo $_SESSION['UserID']?>" method="post">
    <input type="text" name="ProjectName" placeholder="New project name" class="input" autocomplete="off">
    <input type="submit" value="Add" class="submit">
</form>
</body>



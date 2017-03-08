<?php
session_start();
require_once('dependencies/db.php');
if($_SESSION['Email'] == null){
        header('Location: login.php');
    }
try {
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
} catch (PDOException $e) {
    die('Sign In Failed! ');
}
?>
<!DOCTYPE html>
<html>
<head>
    <!--Import Google Icon Font-->
    <link href="http://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <!--Import materialize.css-->
    <link type="text/css" rel="stylesheet" href="css/materialize.min.css" media="screen,projection"/>
    <!--Link to Main css document-->
    <link rel="stylesheet" type="text/css" href="css/main.css"
    <!--Let browser know website is optimized for mobile-->
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
</head>
<style type="text/css">
    ul {
        list-style-type: none;
    }
</style>

<body>

<!-- Navbar -->
<nav>
    <div class="nav-wrapper black">
        <a href="index.php" class="brand-logo left">Project LinQ</a>
        <ul id="nav-mobile" class="right">
            <li><a href="index.php">Home</a></li>
            <li><a href="profile.php">Profile</a></li>
            <li><a href="scripts/logout.php">Logout</a></li>
        </ul>
    </div>
</nav>

<h4>Welcome, <?php echo $UserFName . " " . $UserLName ?> | ID: <?php echo $UserID ?></h4>

<h3>Info</h3>
<!-- CHANGE PASSWORD -->
<?php
if (isset($_SESSION["User_ID"]) != "") {
    echo "Change your password here: ";

} else {
    //redirect user back to login.php if the session does not exist
    //header('Location: login.php');
}
?>
<div class="row">
    <div class="col s4">
        <div class="card green accent-2">
            <div class="card-content">
                <form action="scripts/changePass.php" method="post">
                    <input placeholder="New Password" type="password" name="newPass"/><br/>
                    <input placeholder="Confirm New Password" type="password" name="newPassConfirm"/><br/>
                    <input type="submit" class="btn wave-effect black" value="Change Password" name="submitPassChange"/>
                </form>
            </div>
        </div>
    </div>
</div>
<br/>


<h3>Projects</h3>
<?php
//ADMIN PROJECTS
$stmt = $db->prepare('SELECT * FROM projects WHERE Admin=:User_ID');
$stmt->bindParam(':User_ID', $_SESSION['UserID']);
$stmt->execute();
while ($row = $stmt ->fetch(PDO::FETCH_ASSOC)){
    $ProjectName =$row["ProjectName"];
    $ProjectID = $row["Project_ID"];
    $ProjectAdmin =$row["Admin"];
    $ProjectUser = $row["User_ID"];
    if ($ProjectUser == $ProjectAdmin){
         ?>
    ADMIN - <a href="project.php?ProjectID=<?php echo $ProjectID?>">
    ID: <?php echo $ProjectID?> |  <?php echo $ProjectName?></a><br />
    <?php
    }
}
//INVITED PROJECTS
echo "INVITED<br />";
//Get invited projects pointers
$stmt = $db->prepare('SELECT * FROM projects WHERE User_ID=:User_ID AND NOT User_ID=Admin');
$stmt->bindParam(':User_ID', $_SESSION['UserID']);
$stmt->execute();
while ($row = $stmt ->fetch(PDO::FETCH_ASSOC)){
    $ProjectName =$row["ProjectName"];
    $ProjectAdmin =$row["Admin"];
    $st = $db->prepare('SELECT * FROM projects WHERE Admin=:Admin AND  ProjectName=:ProjectName LIMIT 1');
    $st->bindParam(':Admin',$ProjectAdmin);
    $st->bindParam(':ProjectName',$ProjectName);
    $st->execute();
    while ($route = $st->fetch(PDO::FETCH_ASSOC)){
        if ($route["User_ID"] == $route["Admin"]){
             ?>
    Invited - <a href="project.php?ProjectID=<?php echo $route["Project_ID"]?>">
    ID: <?php echo $route["Project_ID"]?> |  <?php echo $route["ProjectName"]?></a><br />
    <?php
        }
    }
}
?>
<br/><br/>

<h4>New Project</h4><br/>
<div class="row">
    <div class="col s8">
        <div class="card green accent-2">
            <div class="card-content">
                <form action="scripts/addProject.php?userID=<?php echo $_SESSION['UserID'] ?>" method="post">
                    <input type="text" name="ProjectName" placeholder="New project name" class="input"
                           autocomplete="off">
                    <input class="btn wave-effect black" type="submit" value="Add">
                </form>
            </div>
        </div>
    </div>
</div>


<!-- This is the footer -->

<footer class="page-footer black">
    <div class="container">
        <div class="row">
            <div class="col l6 s12">
                <h5 class="white-text">Creators</h5>
                <p class="grey-text text-lighten-4">Brendan, Nate, Alex, and Beau.</p>
            </div>
        </div>
    </div>
    <div class="footer-copyright">
        <div class="container">
            © 2017 Copyright Text
            <a class="grey-text text-lighten-4 right" href="#!">Press Me!</a>
        </div>
    </div>
</footer>


<script type="text/javascript" src="https://code.jquery.com/jquery-2.1.1.min.js"></script>
<script type="text/javascript" src="js/materialize.min.js"></script>
</body>
</html>

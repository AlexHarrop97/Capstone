<?php
session_start();
require_once('dependencies/db.php');
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
<li>TBD...</li>


<h3>Projects</h3>
<?php
$stmt = $db->prepare('SELECT * FROM projects WHERE User_ID=:User_ID');
$stmt->bindParam(':User_ID', $_SESSION['UserID']);
$stmt->execute();
while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
    $ProjectName = $row["ProjectName"];
    $ProjectID = $row["Project_ID"];
    ?>
    <a href="project.php?ProjectID=<?php echo $ProjectID ?>">
        ID: <?php echo $ProjectID ?> | <?php echo $ProjectName ?></a><br/>
    <?php
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

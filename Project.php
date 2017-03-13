<?php
session_start();
        $Email = $_SESSION['Email'];
        $UserID = $_SESSION['UserID'];
require('scripts/command.php');

isLoggedIn($Email, $UserID);
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


<?php
try {
    $Email = $_SESSION['Email'];
    $UserID = $_SESSION['UserID'];
    $ProjectID = $_GET['ProjectID'];
    $stmt = $db->prepare('SELECT * FROM Projects WHERE Project_ID=:Project_ID');
    $stmt->bindParam(':Project_ID', $_GET['ProjectID']);
    $stmt->execute();
    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
        $ProjectName = $row["ProjectName"];
        $ProjectAdminID = $row["Admin"];
    }
} catch (PDOException $e) {
    die('Project Failed! ');
}
?>

<body>
<h1>PROJECT PAGE</h1>
<a href="profile.php">Back to profile...</a>
<h2>Project Title: <?php echo $ProjectName?> | ID: <?php echo $ProjectID?></h2>
<br /><br />

<!--Adding user to project-->
<h2>Invite User</h2>
<form action="scripts/inviteUser.php?ProjectID=<?php echo $ProjectID?>&Admin=<?php echo $ProjectAdminID?>
                    &ProjectName=<?php echo $ProjectName ?>" method="post">
    <input type="text" name="email" placeholder="Enter user's email" class="input" autocomplete="off">
    <input type="submit" value="Add" class="submit">
</form>


<h4>TODOs</h4><br/>
<?php
$stmt = $db->prepare('SELECT * FROM todo WHERE Project_ID=:Project_ID');
$stmt->bindParam(':Project_ID', $ProjectID);
$stmt->execute();
while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
    $Todo = $row["Todo_ID"];
    $Description = $row["Description"];
    ?>
    ID: <?php echo $Todo ?> | Description: <?php echo $Description ?><br/>
    <?php
}
?>
<div class="row">
    <div class="col s8">
        <div class="card green accent-2">
            <div class="card-content">
                <form action="scripts/addTodo.php?UserID=<?php echo $UserID ?>&ProjectID=<?php echo $ProjectID ?>"
                      method="post">
                    <input type="text" name="add" placeholder="Add a new task" class="input" autocomplete="off">
                    <input class="btn wave-effect black" type="submit" value="Add" class="submit">
                </form>
            </div>
        </div>
    </div>
</div>


<br/><br/>
<h4>Comments</h4><br/>

<!-- SEND COMMENT -->
<div class="row">
    <div class="col s8">
        <div class="card green accent-2">
            <div class="card-content">
                <form action="scripts/sendComments.php?ProjectID=<?php echo $ProjectID; ?>&User_ID=<?php echo $UserID;?>" method="post">
                    <input placeholder="Add Comment" class="input" type="text" name="msgBox" value="">
                    <input class="btn wave-effect black" type="submit" value="Send" name="submitMsg"/>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- GRAB COMMENTS -->
<?php
try {
    $getComments = $db->prepare('SELECT * FROM comments INNER JOIN users ON users.User_ID = comments.User_ID WHERE Project_ID = :projectID ORDER BY Message_Time DESC');
    $getComments->bindParam(':projectID', $ProjectID);
    $getComments->execute();
    $results = $getComments->fetchAll();
    foreach ($results as $line) {
        //print_r($line);
        $template = "<p><strong>" . $line["FirstName"] . " " . $line["LastName"] . "</strong> (" . $line["Message_Time"] . "):" . $line["Message_Text"] . ".</p><br/>";
        echo $template;
    }
} catch (PDOException $e) {
    echo "Query Failed: " . $e->getMessage();
}
?>

<!--Profile Link-->
<div class="row center-align">
    <a href="profile.php" class="waves-effect btn black">Back to profile...</a><br/><br/>
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



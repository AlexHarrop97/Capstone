<?php
session_start();
$Email = $_SESSION['Email'];
$UserID = $_SESSION['UserID'];
require('scripts/command.php');
isLoggedIn($Email, $UserID);
try {
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
<title>Profile - LinQ - <?php echo $UserFName." ".$UserLName?></title>

<script type="text/javascript">
    function userEdit() {
        var x = document.getElementById('edit');
        if (x.style.display === 'none') {
            x.style.display = 'block';
        } else {
            x.style.display = 'none';
        }
    }
</script>
    
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
        <a href="profile.php" class="brand-logo left">Project LinQ</a>
        <ul id="nav-mobile" class="right">
            <li><a href="scripts/logout.php">Logout</a></li>
        </ul>
    </div>
</nav>

<h4>Welcome, <?php echo $UserFName . " " . $UserLName ?></h4>

<!-- show/hide details-->
<input class="btn wave-effect black" type="submit" value="Edit Profile" onclick="userEdit();">
<div id="edit" style="display: none;">
        <?php
    if (isset($_SESSION["User_ID"]) != "") {
        echo "Change your password here: ";
    
    } elseif (isset($_GET["pwchange"]) == 1) {
        echo "Error: Wrong current password:";
    } else {
        echo "";
    }
    ?>
    <div class="row">
        <div class="col s4">
            <div class="card green accent-2">
                <div class="card-content">
                    <form action="scripts/changePass.php" method="post">
                        <input placeholder="Current Password" type="password" name="oldPass"/><br/>
                        <input placeholder="New Password" type="password" name="newPass"/><br/>
                        <input placeholder="Confirm New Password" type="password" name="newPassConfirm"/><br/>
                        <input type="submit" class="btn wave-effect black" value="Change Password" name="submitPassChange"/>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <br/>
</div>
<!--projects-->


<div class="row">
    <div class="col s6">
        <h4>Current Projects</h4>       
                <?php
                //ADMIN PROJECTS
                $stmt = $db->prepare('SELECT * FROM projects WHERE Admin=:User_ID ORDER BY Project_ID DESC;');
                $stmt->bindParam(':User_ID', $_SESSION['UserID']);
                $stmt->execute();
                while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                    $ProjectName = $row["ProjectName"];
                    $ProjectID = $row["Project_ID"];
                    $ProjectAdmin = $row["Admin"];
                    $ProjectUser = $row["User_ID"];
                    if ($ProjectUser == $ProjectAdmin) {
                        ?>
                        <div class="row">
                            <a href="project.php?ProjectID=<?php echo $ProjectID ?>">
                            <div class="card green accent-2 hoverable" style="border:3px solid #000000 !important;">
                              <div class="card-content black-text">
                                <span class="card-title"><?php echo $ProjectName?></span>
                                <?php
                                $st = $db->prepare('SELECT User_ID FROM projects WHERE Admin=:Admin AND ProjectName=:ProjectName');
                                $st->bindParam(':Admin', $ProjectAdmin);
                                $st->bindParam(':ProjectName', $ProjectName);
                                $st->execute();
                                echo $st->rowCount()." connected accounts<br /> | ";
                                $users = $st->fetchAll();
                                foreach ($users as $u) {
                                    $s = $db->prepare('SELECT * FROM users WHERE User_ID=:User_ID');
                                    $s->bindParam(':User_ID', $u["User_ID"]);
                                    $s->execute();
                                    $get = $s->fetchAll();
                                    foreach ($get as $name){
                                        echo $name["FirstName"]." ".$name["LastName"]." | ";
                                    }
                                }
                                ?>
                              </div>
                              <div class="card-action red-text right-align">
                                Owner
                              </div>
                            </div>
                            </a>
                        </div>
                        <?php
                    }
                }
                //INVITED PROJECTS
                //Get invited projects pointers
                $stmt = $db->prepare('SELECT * FROM projects WHERE User_ID=:User_ID AND NOT User_ID=Admin');
                $stmt->bindParam(':User_ID', $_SESSION['UserID']);
                $stmt->execute();
                while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                    $ProjectName = $row["ProjectName"];
                    $ProjectAdmin = $row["Admin"];
                    $st = $db->prepare('SELECT * FROM projects WHERE Admin=:Admin AND  ProjectName=:ProjectName LIMIT 1');
                    $st->bindParam(':Admin', $ProjectAdmin);
                    $st->bindParam(':ProjectName', $ProjectName);
                    $st->execute();
                    while ($route = $st->fetch(PDO::FETCH_ASSOC)) {
                        if ($route["User_ID"] == isset($route["Admin"])) {
                            ?>
                            <div class="row">
                            <a href="project.php?ProjectID=<?php echo $route["Project_ID"] ?>">
                            <div class="card green accent-2" style="border:3px solid #000000 !important;">
                              <div class="card-content black-text">
                                <span class="card-title"><?php echo $route["ProjectName"]?></span>
                                <?php
                                $stm = $db->prepare('SELECT User_ID FROM projects WHERE Admin=:Admin AND ProjectName=:ProjectName');
                                $stm->bindParam(':Admin', $route["Admin"]);
                                $stm->bindParam(':ProjectName', $route["ProjectName"]);
                                $stm->execute();
                                echo $stm->rowCount()." connected accounts<br /> | ";
                                $users = $stm->fetchAll();
                                foreach ($users as $u) {
                                    $s = $db->prepare('SELECT * FROM users WHERE User_ID=:User_ID');
                                    $s->bindParam(':User_ID', $u["User_ID"]);
                                    $s->execute();
                                    $get = $s->fetchAll();
                                    foreach ($get as $name){
                                        echo $name["FirstName"]." ".$name["LastName"]." | ";
                                    }
                                }
                                ?>
                              </div>
                              <div class="card-action red-text right-align">
                                Invited
                              </div>
                            </div>
                            </a>
                        </div>
                            <?php
                        } 
                    }
                }
                ?>

            
    </div>

    <div class="col s6">
        <!-- new Project -->
        <div class="row">
            <h4>Create Project</h4>
            <div class="card green accent-2" style="border:3px solid #000000 !important;">
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
</div>

<!-- CHANGE PASSWORD -->


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
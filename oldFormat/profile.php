<?php
require_once('dependencies/db.php');

session_start();

try {
    
    $stmt = $db->prepare("SELECT * FROM users");
    $stmt->execute();
    $users = $stmt->fetchAll();
    
    foreach ($users as $user) {

        if ($user["Email"] == $_SESSION["User"]) {

            $userID = $user["User_ID"];
            $userFName = $user["FirstName"];
            $userLName = $user["LastName"];
            $userEmail = $user["Email"];
            $userPass = $user["P4WD"];
        }
    }
}
catch (PDOException $e) {
    
    die('ERROR: ' . $e->getMessage());
}

echo 'my name is ' . $userFName;

if ($_SESSION["User"] != "" && $_SESSION["User"] != null) {

    echo "You are currently logged in as " . $_SESSION["User"];
    //header('Location: .php?user=' . $_SESSION["User"]);
}
else {

    //redirect user back to login.php if the session does not exist
    header('Location: index.php');
}
?>

<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Profile</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/0.98.0/css/materialize.min.css">
</head>
<body>
<nav>
    <div class="nav-wrapper">
        <a href="#" class="brand-logo">Logo</a>
        <ul id="nav-mobile" class="right hide-on-med-and-down">
            <li><a href="#">Sass</a></li>
            <li><a href="#">Components</a></li>
            <li><a href="#">JavaScript</a></li>
        </ul>
    </div>
</nav>



<div class="row">
    <div class="col s4">
        <div class="card">
            <div class="card-image">
                <img src="images/sample-1.jpg">
                <span class="card-title">Card Title</span>
            </div>
            <div class="card-content">
                <p>Basic Profile Info.</p>
            </div>
            <div class="card-action">
                <div class="row">
                    <div class="col s12">
                    </div>
                    <div id="profileTab" class="col s12"><a href="#">Profile Settings</a></div>
                    <div id="manageTab" class="col s12"><a href="#">Manage Current Groups</a></div>
                    <div id="createTab" class="col s12"><a href="#">Create New Group</a></div>
                </div>
            </div>
        </div>
    </div>

    <div class="col s4" id="profile" style="display:none">
        <div class="card">
            <div class="card-content">
                <p>This is your profile information.</p>
            </div>
            <div class="card-action">
                <div class="row">
                    <div class="col s12">
                        <form class="col s12" id="profileForm" action="scripts/getUser.php" method="post">
                            <div class="row">
                                <div class="input-field col s6">
                                    <label for="first_name">First Name</label><br/>
                                    <input id="first_name" type="text" class="validate" value="<?php
                                    echo $userFirstName;?>">
                                </div>
                                <div class="input-field col s6">
                                    <label for="last_name">Last Name</label><br/>
                                    <input id="last_name" type="text" class="validate" value="<?php
                                    echo $userLastName?>">
                                </div>
                            </div>

                            <div class="row">
                                <div class="input-field col s12">
                                    <label for="password">Password</label><br/>
                                    <input id="password" type="password" class="validate">
                                </div>
                            </div>
                            <div class="row">
                                <div class="input-field col s12">
                                    <label for="email">Email</label><br/>
                                    <input id="email" type="email" class="validate" name="userEmail" value="<?php
                                    echo @$_POST['userEmail'];?>">
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>



    <div class="col s4" id="manage" style="display:none">
        <div class="card">
            <div class="card-image">
                <img src="images/sample-1.jpg">
                <span class="card-title">Card Title</span>
            </div>
            <div class="card-content">
                <p>Basic Profile Info.</p>
            </div>
            <div class="card-action">
                <div class="row">
                    <div class="col s12">
                        <p>Content</p>
                    </div>
                </div>
            </div>
        </div>
    </div>




    <form class="col s12" id="create" style="display: none">
        <div class="row">
            <div class="input-field col s6">
                <label for="first_name">First Name</label><br/>
                <input id="first_name" type="text" class="validate">
            </div>
            <div class="input-field col s6">
                <label for="last_name">Last Name</label><br/>
                <input id="last_name" type="text" class="validate">
            </div>
        </div>

        <div class="row">
            <div class="input-field col s12">
                <label for="password">Password</label><br/>
                <input id="password" type="password" class="validate">
            </div>
        </div>
        <div class="row">
            <div class="input-field col s12">
                <label for="email">Email</label><br/>
                <input id="email" type="email" class="validate">
            </div>
        </div>
    </form>


</div>





<footer class="page-footer">
    <div class="container">
        <div class="row">
            <div class="col l6 s12">
                <h5 class="white-text">Footer Content</h5>
                <p class="grey-text text-lighten-4">You can use rows and columns here to organize your footer content.</p>
            </div>
            <div class="col l4 offset-l2 s12">
                <h5 class="white-text">Links</h5>
                <ul>
                    <li><a class="grey-text text-lighten-3" href="#!">Link 1</a></li>
                    <li><a class="grey-text text-lighten-3" href="#!">Link 2</a></li>
                    <li><a class="grey-text text-lighten-3" href="#!">Link 3</a></li>
                    <li><a class="grey-text text-lighten-3" href="#!">Link 4</a></li>
                </ul>
            </div>
        </div>
    </div>
    <div class="footer-copyright">
        <div class="container">
            © 2014 Copyright Text
            <a class="grey-text text-lighten-4 right" href="#">More Links</a>
        </div>
    </div>
</footer>



<script
        src="https://code.jquery.com/jquery-3.1.1.js"
        integrity="sha256-16cdPddA6VdVInumRGo6IbivbERE8p7CQR3HzTBuELA="
        crossorigin="anonymous"></script>
<script type="text/javascript">
    $(document).ready(function(){
        $("#profileTab").on("click", function () {
            $("#profile").toggle();
        });
        $("#manageTab").on("click", function () {
            $("#manage").toggle();
        });
        $("#createTab").on("click", function () {
            $("#create").toggle();
        });
        });
</script>
</body>
</html>

<!DOCTYPE html>
<html>
<title>Streaming Information</title>
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
<body>


<!-- Navbar -->
<nav>
    <div class="nav-wrapper black">
        <a href="index.php" class="brand-logo left">Project LinQ</a>
        <ul id="nav-mobile" class="right">
            <li><a href="index.php">Home</a></li>
            <li><a href="profile.php">Profile</a></li>
        </ul>
    </div>
</nav>

<?php
if (isset($_GET['loginSuccess']) && !empty($_GET['loginSuccess'])) {

    echo " ";
} else {

    echo "Please log in using existing user credentials. ";
}


?>


<!-- LOGIN FORM -->


<div class="row">
    <div class="col s12" id="error" style="display: none">
        <div class="card red accent-1" >
            <div class="card-content red-text darken-2 center" ">
                <p><i class="small material-icons">info_outline</i>
                    <?php
                    if (isset($_GET['loginSuccess']) && !empty($_GET['loginSuccess']) && $_GET['loginSuccess'] == 'false') {

                        echo "You have entered an invalid email and password combination.";

                    }
                    ?></p>
            </div>
        </div>
    </div>
</div>




<div class="row">
    <div class="col s4">
        <div class="card green accent-2" id="login-card">
            <div class="card-action">
                <div class="row">
                    <div class="col s12">
                        <form class="col s12" action="scripts/getUser.php" method="post">
                            <div class="row">

                                <div class="input-field col s12">
                                    <input placeholder="Email" type="text" name="email"/>
                                </div>

                                <br/>

                                <div class="input-field col s12">
                                    <input placeholder="Password" type="password" name="password"/>
                                </div>
                                <br/><br/>
                                <input id="submit" class="wave-effect black btn" type="submit"/><br/><br/>
                                <span><a href="register.php" class="wave-effect black btn">Register</a></span><br/>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    <div class="col s7 right-align">
        <div class="card-image">
            <img src="images/logo.png" style="width: 600px; height: 400px;">
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

<!-- should toggle error message on when submit is pressed -->
<script type="text/javascript">
    $(document).ready(function(){
        $("#submit").on("click", function () {
            $("#error").toggle();
        });
</script>

</body>
</html>

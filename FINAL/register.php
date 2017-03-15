<!DOCTYPE html>
<html>
<title>Register Here</title>
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
        </ul>
    </div>
</nav>



<div class="row">

    <!-- REGISTER FORM -->

    <div class="col s6">
        <h4>Register Here</h4>
        <?php switch (isset($_GET["regfail"])){
            case "blank":
                echo "Error: please enter into every text field.";
                break;
            case "pass":
                echo "Error: Passwords don't match.";
                break;
            case "email":
                echo "Error: Invalid email.";
                break;
            case "existing":
                echo "Error: An account already exist under that email.";
                break;
        }?>
        <div id="register-card" class="card green accent-2">
            <div class="card-content ">
                <form id="registerForm" action="scripts/addUser.php" method="post">
                    <div class="row">
                        <div class="col s12">
                            <input class="validate" placeholder="Email" type="text" name="userName"/>
                        </div>

                        <div class="col s4">
                            <input placeholder="First Name" type="text" name="firstName"/>
                            <input placeholder="Last Name" type="text" name="lastName"/>
                        </div>

                        <div class="col s8">
                            <input placeholder="Password" type="password" name="password"/>
                            <input placeholder="Confirm Password" type="password" name="passConfirm"/>
                        </div>

                        <input type="submit" class="btn wave-effect black"/>
                    </div>
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
        </div>
    </div>
</footer>


<script type="text/javascript" src="https://code.jquery.com/jquery-2.1.1.min.js"></script>
<script type="text/javascript" src="js/materialize.min.js"></script>

</body>
</html>

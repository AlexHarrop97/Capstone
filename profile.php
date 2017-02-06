<?php
session_start();

require_once("db.php");
if ($_SESSION["User"] != "" && $_SESSION["User"] != null) {

    echo "You are currently logged in as " . $_SESSION["User"];
    //header('Location: .php?user=' . $_SESSION["User"]);
}
else {

    //redirect user back to login.php if the session does not exist
    header('Location: login.php');
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
                    <div id="profileTab" class="col s12"><a href="#test1">Test 1</a></div>
                    <div id="test2" class="col s12"><a href="#test1">Test 1</a></div>
                    <div id="test3" class="col s12"><a href="#test1">Test 1</a></div>
                    <div id="test4" class="col s12"><a href="#test1">Test 1</a></div>
                </div>
            </div>
        </div>
    </div>

    <div class="col s4" id="settings" style="display:none">
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
                    <div id="test1" class="col s12"><a href="#test1">Test 1</a></div>
                    <div id="test2" class="col s12"><a href="#test1">Test 1</a></div>
                    <div id="test3" class="col s12"><a href="#test1">Test 1</a></div>
                    <div id="test4" class="col s12"><a href="#test1">Test 1</a></div>
                </div>
            </div>
        </div>
    </div>

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
        /*$('ul.tabs').tabs();
        $( "#profileTab" ).on("click", function() {
            $( "#settings" ).show( "slow", function() {
                // Animation complete.
            });*/
        $("#profileTab").on("click", function () {
            $("#settings").show();
        });
        });
</script>
</body>
</html>
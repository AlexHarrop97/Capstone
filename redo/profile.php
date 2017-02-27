<?php
session_start();
require_once('db.php');


try{

    $Email = $_SESSION['Email'];
    $Password = $_SESSION['Password'];

    echo $Email;
    //Select all using user and password textboxes on login.php
    $stmt = $db->prepare('SELECT * FROM users WHERE Email=:email');
    $stmt->bindParam(':email', $Email);
    $stmt->execute();
    $users = $stmt->fetchAll();

    foreach ($users as $user) {

        if (password_verify($Password, $user["P4WD"])) {

            $UserID = $user["User_ID"];
            $UserEmail = $user["Email"];
            $UserFName = $user["FirstName"];
            $UserLName = $user["LastName"];


            ?>
           <h2>Welcome to your profile page, <?php echo $UserFName." ".$UserLName. "<br /> userID ".$UserID ?></h2>
            <?php
        }

        else {
            header('Location: login.php');
        }
    }
}
catch (PDOException $e) {

    die('Sign In Failed! ');
}

//*************** NEED TO ADD IN THE GOD DAMN SEARCH FOR THE CURRENT TO-DO LIST

?>
<!DOCTYPE html>
<html>
<head>
<<<<<<< HEAD
    <title>Profile</title>
=======
    <title>Todo List</title>
>>>>>>> 35519da983aaf91d4bd283179e2f634f3e51daa7
    <script type="text/javascript"
            src="http://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.js"></script>
</head>
<style type="text/css">
    ul {
        list-style-type: none;
    }

</style>

<body>
<div id="list">
    <h1>To-Do List</h1>
    <?php if(!empty($items)): ?>
        <ul>
            <li><span class="item<?php echo $item['Status'] ? ' Status' : '' ?>"><?php echo $item['Description'];?></span>
                <?php if(!$item['Status']): ?>
                <a href="done.php?as=status&item=<?php echo $item['id']; ?>" class="mark-done">
                    <?php endif; ?>
            </li>
        </ul>
    <?php endif; ?>
    <form action="scripts/addTodo.php?userID=<?php echo $UserID?>" method="post">
        <input type="text" name="add" placeholder="Add a new task" class="input" autocomplete="off">
        <input type="submit" value="Add" class="submit">
    </form>
</div>
</body>

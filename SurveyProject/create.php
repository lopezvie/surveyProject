<?php
/*
 * Author: Omar Lopez Vie 
 *  */
session_start();
$username = $_SESSION['username'];
$username = strtoupper($username);
?>
<html>
    <head>
        <title>Survey</title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta name="description" content="">
        <link rel="stylesheet" href="css/surveyHomeStyle.css">
        <link rel="stylesheet" href="css/styleRegisterPage.css">
    </head>
    <body>
        <ul>
            <li><a class="active"><?php strtoupper($_SESSION['username']) ?></a></li>
            <li><a href="surveyHome.php">HOME</a></li>
            <li><a href="destroySession.php">SIGN OUT</a></li>
        </ul>
        <div>
            <form action="create2.php" method="post">
                <b style="text-align: center; font-size: 25px;">CREATE A NEW SURVEY</b><br><br>
                <label for="topic">Topic:</label><br>
                <input type="text" name="topic" placeholder="SURVEY'S SUBJECT"/><br><br>
                <button id="btn" type="submit" name="submit">CREATE</button>
            </form>
            <button id="btn" onclick="window.location.href = 'surveyHome.php'">HOME</button>
        </div>
    </body>
</html>


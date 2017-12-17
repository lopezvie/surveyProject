<?php
/*
 * Author: Omar Lopez Vie 
 *  */
session_start();
$_SESSION['Nquest'] = 0;
?>
<html>
    <head>
        <title>Survey</title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta name="description" content="">
        <link rel="stylesheet" href="css/surveyHomeStyle.css">
    </head>
    <body>
        <ul>
            <li><a class="active"><?php echo strtoupper($_SESSION['username']); ?></a></li>
            <li><a class="active" href="#home">HOME</a></li>
            <li><a href="destroySession.php">SIGN OUT</a></li>
        </ul>
    <botton onclick="window.location.href = 'create.php'" id="one">Create a New Survey</botton>
    <botton onclick="window.location.href = 'display.php'" id="two">See Your Existing Surveys</botton>
</body>
</html>


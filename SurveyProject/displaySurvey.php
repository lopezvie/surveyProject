<?php
/*
 * Author: Omar Lopez Vie 
 *  */
session_start();

include 'DatabaseClass.php';
?>
<html>
    <head>
        <title>Survey</title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta name="description" content="">
        <link rel="stylesheet" href="css/tables.css">
        <link rel="stylesheet" href="css/surveyHomeStyle.css">
    </head>
    <body>
        <ul>
            <li><a class="active"><?php echo strtoupper($_SESSION['username']); ?></a></li>
            <li><a href="surveyHome.php">HOME</a></li>
            <li><a href="destroySession.php">SIGN OUT</a></li>
        </ul>
        <?php
        $db->displaySurvey($_SESSION['id'],$_GET['submit']);
        ?>
    </body>
</html>

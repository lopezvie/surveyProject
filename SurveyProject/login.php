<?php 
/*
 * Author: Omar Lopez Vie 
 *  */
session_start();
?>
<html>
    <head>
        <title>Login Form - Survey</title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta name="description" content="">
    </head>
    <body>
        <?php
        include 'DatabaseClass.php';

        if (isset($_POST['submit'])) {
            $_SESSION['username'] = $_POST['uid'];
            $_SESSION['pass'] = $_POST['pwd'];
            $_SESSION['id'] = $db->getUserByID($_SESSION['username'], $_SESSION['pass']);
            $db->selectU($_SESSION['username'], $_SESSION['pass']);
        } else {
            echo "Invalid User";
            header("Location: loginPage.html");
        }
        ?>
    </body>
</html>
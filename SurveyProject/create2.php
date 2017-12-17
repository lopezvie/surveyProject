<?php
/*
 * Author: Omar Lopez Vie 
 *  */
session_start();
include 'DatabaseClass.php';
$_SESSION['topic'] = $_POST["topic"];
$db->insertSurvey($_SESSION['id'], $_SESSION['topic']);
$_SESSION['Nquest'] ++;
$_SESSION['survey_id'] = $db->getSurveyByID($_SESSION['id'], $_SESSION['topic']);
header("Location: createSurvey.php");

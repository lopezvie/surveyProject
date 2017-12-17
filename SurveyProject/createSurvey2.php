<?php
/*
 * Author: Omar Lopez Vie 
 *  */
session_start();

include 'DatabaseClass.php';
$db->insertQuestion($_SESSION['id'], $_POST['question'], $_SESSION['topic'], $_SESSION['survey_id']);
$_SESSION['q_id']=$db->getQuestionByID($_SESSION['id'], $_POST['question'], $_SESSION['topic']);
$db->insertANS($_SESSION['q_id'], $_SESSION['id'], $_POST['answer1'],$_SESSION['survey_id']);
$db->insertANS($_SESSION['q_id'], $_SESSION['id'], $_POST['answer2'],$_SESSION['survey_id']);
$db->insertANS($_SESSION['q_id'], $_SESSION['id'], $_POST['answer3'],$_SESSION['survey_id']);
header("Location: createSurvey.php");
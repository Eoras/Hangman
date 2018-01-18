<?php
session_start();
// SET SESSION START WHEN NO SESSION AND VARIABLES
if (!isset($_SESSION['word'])) $_SESSION['word'] = '';
if (!isset($_SESSION['try'])) $_SESSION['try'] = [];
if (!isset($_SESSION['errors'])) $_SESSION['errors'] = 0;
if (!isset($_SESSION['result'])) $_SESSION['result'] = '';
if (!isset($_SESSION['alert'])) $_SESSION['alert'] = [];

$builtWord = '';

$authorizedCharacter = ['A', 'B', 'C', 'D', 'E', 'F', 'G', 'H', 'I', 'J', 'K', 'L', 'M', 'N', 'O', 'P', 'Q', 'R', 'S', 'T', 'U', 'V', 'W', 'X', 'Y', 'Z', '-', ' '];

$unauthorizedCharacterWhenTry = [' ', '$'];

// FUNCTION FOR RESET ALL SESSIONS
function resetAll()
{
    $_SESSION['word'] = '';
    $_SESSION['try'] = [];
    $_SESSION['errors'] = 0;
    $_SESSION['result'] = '';
    $_SESSION['alert'] = [];
}

// DO FUNCTION FOR HEADER LOCATION
function headerLocation()
{
    header('location: index.php');
    exit();
}

//RESET ALL SESSIONS WHEN CHANGE WORD
if (isset($_GET['reset'])) {
    $word = $_SESSION['word'];
    resetAll();
    $_SESSION['word'] = $word;
    $_SESSION['alert'] = ['dark' => 'Reset completed !'];
    headerLocation();
}

if (isset($_GET['changeWord'])) {
    resetAll();
    $_SESSION['word'] = strtoupper($_POST['changeWord']);
    $_SESSION['alert'] = [];
    headerLocation();
}

// CONSTRUCT WORD WITH _
$word = str_split(strtoupper($_SESSION['word']));
$try = $_SESSION['try'];

foreach ($word as $key => $letter) {
    if (in_array($letter, $try) OR $letter === '-') {
        $builtWord .= $letter;
    } elseif ($letter === ' ') {
        $builtWord .= '&emsp;';
    } else {
        $builtWord .= ' _ ';
    }
}

// IF NO _ IN RESULT, IS WIN
if (strpos($builtWord, '_') === false) $_SESSION['result'] = 'win';
// IF MORE THAN 5 ERRORS IS LOST
if ($_SESSION['errors'] > 5) $_SESSION['result'] = 'lost';

if ($_SESSION['result'] === 'win') {
    $_SESSION['alert'] = ['img' => "youwin.png"];
} elseif ($_SESSION['result'] === 'lost') {
    $_SESSION['alert'] = ['img' => "gameover.png"];
}

if (!empty($_POST) && isset($_POST['try'])) {

    $letterPost = strtoupper($_POST['letter']);

    if (strlen($letterPost) > 1 OR strlen($letterPost) <= 0 OR !in_array($letterPost, $authorizedCharacter) OR $letterPost === ' ' OR $letterPost === '-') {
        // SI PLUSIEURS LETTRES
        $_SESSION['alert'] = ['warning' => '<strong class="text-warning">' . $letterPost. '</strong> - This character is not allowed or you have entered several letters.'];
        headerLocation();
    }

    if (in_array($letterPost, $_SESSION['try'])) {
        // SI LETTRE DÉJÀ RENTRÉE
        $_SESSION['alert'] = ['warning' => 'You already tried this letter! I don\'t remove a point because you\'re cool: D'];
        headerLocation();
    } elseif (in_array($letterPost, $word)) {
        $_SESSION['try'][] = $letterPost;
        $_SESSION['alert'] = ['success' => '<strong>GREAT</strong>, you found a new letter!'];
        headerLocation();
    } else {
        $_SESSION['try'][] = $letterPost;
        $_SESSION['alert'] = ["danger" => '<strong class="text-danger">' . $letterPost. '</strong> - This letter is not in the word, you are close to death...'];
        $_SESSION['errors']++;
        headerLocation();
    }
}

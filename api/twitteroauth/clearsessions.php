<?php
/**
 * @file
 * Clears PHP sessions and continues hunt for access token.
 */
 
/* Load and clear sessions */
session_start();
$prize = $_SESSION['prize'];
$date = $_SESSION['date'];
session_destroy();
session_start();
$_SESSION['prize'] = $prize;
$_SESSION['date'] = $date;


header('Location: ./redirect.php');
die();

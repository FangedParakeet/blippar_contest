<?php
/**
 * @file
 * User has successfully authenticated with Twitter. Access tokens saved to session and DB.
 */

/* Load required lib files. */
session_start();
require_once('twitteroauth/twitteroauth.php');
require_once('config.php');
include('../db_connect.php');

/* If access tokens are not available redirect to connect page. */
if (empty($_SESSION['access_token']) || empty($_SESSION['access_token']['oauth_token']) || empty($_SESSION['access_token']['oauth_token_secret'])) {
    header('Location: ./clearsessions.php');
}
/* Get user access tokens out of the session. */
$access_token = $_SESSION['access_token'];

/* Create a TwitterOauth object with consumer/user tokens. */
$connection = new TwitterOAuth(CONSUMER_KEY, CONSUMER_SECRET, $access_token['oauth_token'], $access_token['oauth_token_secret']);

/* If method is set change API call made. Test is called by default. */
$user = $connection->get('account/verify_credentials');

//check to make sure user hasn't won a prize in the past 24 hours
$today = date('Y-m-d H:i:s');
$unixToday = strtotime($today);
$unixTomorrow = strtotime('+1 day', $unixToday);
$tomorrow = date("Y-m-d H:i:s", $unixTomorrow);

$query = "SELECT count(id) FROM `contestants` WHERE twit_id = '".$user->id."' AND date_created >= '".$today."' AND date_created < '".$tomorrow."'";
$result = mysql_query($query) or die(mysql_error()); 
$results = mysql_fetch_row($result);
if($results[0] > 0){
	header('Location: http://localhost:8888/blipp_contest/?cheater=true');
	die();
}
else {
	//get client location
	$clientIP = get_client_ip();
	$details = json_decode(file_get_contents("http://ipinfo.io/{$clientIP}/json"));
	$location = $details->loc; 

	$sql = 'INSERT INTO contestants '.
	       '(name, twit_id, prize_id, location) '.
	       'VALUES ( "'.$user->name.'", "'.$user->id.'", "'.$_SESSION['prize'].'", "'.$location.'" )';

	$retval = mysql_query( $sql );
	if(! $retval )
	{
	  die('Could not enter data: ' . mysql_error());
	}
	else {
		header('Location: http://localhost:8888/blipp_contest/success?prize='.$_SESSION['prize']);
		die();
	}
}

// Function to get the client IP address
function get_client_ip() {
    $ipaddress = '';
    if ($_SERVER['HTTP_CLIENT_IP'])
        $ipaddress = $_SERVER['HTTP_CLIENT_IP'];
    else if($_SERVER['HTTP_X_FORWARDED_FOR'])
        $ipaddress = $_SERVER['HTTP_X_FORWARDED_FOR'];
    else if($_SERVER['HTTP_X_FORWARDED'])
        $ipaddress = $_SERVER['HTTP_X_FORWARDED'];
    else if($_SERVER['HTTP_FORWARDED_FOR'])
        $ipaddress = $_SERVER['HTTP_FORWARDED_FOR'];
    else if($_SERVER['HTTP_FORWARDED'])
        $ipaddress = $_SERVER['HTTP_FORWARDED'];
    else if($_SERVER['REMOTE_ADDR'])
        $ipaddress = $_SERVER['REMOTE_ADDR'];
    else
        $ipaddress = 'UNKNOWN';
    return $ipaddress;
}


/* Some example calls */
//$connection->get('users/show', array('screen_name' => 'abraham'));
//$connection->post('statuses/update', array('status' => date(DATE_RFC822)));
//$connection->post('statuses/destroy', array('id' => 5437877770));
//$connection->post('friendships/create', array('id' => 9436992));
//$connection->post('friendships/destroy', array('id' => 9436992));

/* Include HTML to display on the page */

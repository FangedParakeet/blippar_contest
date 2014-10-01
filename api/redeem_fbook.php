<?php
	include('session_start.php');
	include('db_connect.php');

	//receive authorisation code from Facebook
	$code = $_GET['code'];

	//get user's access token
	$token = getAccessTokenDetails('351030431737051', 'caf270eac1ee8f52248a2a9382e066ef', 'http://localhost:8888/blipp_contest/api/redeem_fbook.php', $code);

	//get user's details
	$user = getUserDetails($token['access_token']);
	
	// check to make sure user hasn't won a prize in the last 24 hours
	$today = date('Y-m-d H:i:s');
	$unixToday = strtotime($today);
	$unixTomorrow = strtotime('+1 day', $unixToday);
	$tomorrow = date("Y-m-d H:i:s", $unixTomorrow);
	
	$query = "SELECT count(id) FROM `contestants` WHERE fbook_id = '".$user->id."' AND date_created >= '".$today."' AND date_created < '".$tomorrow."'";
	$result = mysql_query($query) or die(mysql_error()); 
	$results = mysql_fetch_row($result);
	if($results[0] > 0){
		header('Location: http://localhost:8888/blipp_contest/?cheater=true');
		die();
	}
	else {
		// get client location from their IP Address
		$clientIP = get_client_ip();
		$details = json_decode(file_get_contents("http://ipinfo.io/{$clientIP}/json"));
		$location = $details->loc; 
		$sql = 'INSERT INTO contestants '.
		       '(name, fbook_id, prize_id, location) '.
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
	

	function getAccessTokenDetails($app_id,$app_secret,$redirect_url,$code)
	{

		$token_url = "https://graph.facebook.com/oauth/access_token?client_id=" . $app_id . "&redirect_uri=" . $redirect_url . "&client_secret=" . $app_secret . "&code=" . $code;
 	
		$response = file_get_contents($token_url);
		$params = null;
		parse_str($response, $params); //parse name value pair
  	
		return $params;
	}

	function getUserDetails($access_token)
	{
		$graph_url = "https://graph.facebook.com/me?access_token=". $access_token;
		$user = json_decode(file_get_contents($graph_url));
		if($user != null && isset($user->name)){
			return $user;
		}
		else {
			return null;
		}

	}
	
	// Function to get the client IP address
	function get_client_ip() {
	    $ipaddress = '';
	    if (getenv('HTTP_CLIENT_IP'))
	        $ipaddress = getenv('HTTP_CLIENT_IP');
	    else if(getenv('HTTP_X_FORWARDED_FOR'))
	        $ipaddress = getenv('HTTP_X_FORWARDED_FOR');
	    else if(getenv('HTTP_X_FORWARDED'))
	        $ipaddress = getenv('HTTP_X_FORWARDED');
	    else if(getenv('HTTP_FORWARDED_FOR'))
	        $ipaddress = getenv('HTTP_FORWARDED_FOR');
	    else if(getenv('HTTP_FORWARDED'))
	       $ipaddress = getenv('HTTP_FORWARDED');
	    else if(getenv('REMOTE_ADDR'))
	        $ipaddress = getenv('REMOTE_ADDR');
	    else
	        $ipaddress = 'UNKNOWN';
	    return $ipaddress;
	}
	
?>
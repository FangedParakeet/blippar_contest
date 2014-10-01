<?php
	include('../api/session_start.php');
	include('../api/db_connect.php');
	
	$username = $_POST['username'];
	$password = $_POST['password'];
	
	$query = "SELECT count(id) FROM `admin` WHERE username = '".$username."' AND password = '".md5($password)."'";
	$results = mysql_query($query) or die(mysql_error()); 
	$result = mysql_fetch_row($results);
	
	if($result[0] > 0){
		// login success
		$_SESSION['user'] = $username;
		header('Location: http://localhost:8888/blipp_contest/login/home');
		die();
	}
	else {
		// login failure
		header('Location: http://localhost:8888/blipp_contest/login/index?login=false');
		die();
		
	}


?>
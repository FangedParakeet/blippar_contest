<?php

	include('../api/session_start.php');
	include('../api/db_connect.php');
	if(!isset($_SESSION) || !isset($_SESSION['user'])){
		header('Location: http://localhost:8888/blipp_contest/login/index?sneaky=true');
		die();
	}
	
	$query = "SELECT * from `contestants`";
	$results = mysql_query($query) or die(mysql_error()); 
	$data = array();
	$i = 0;
	while($row = mysql_fetch_assoc($results)){
		$date = $row['date_created'];
		$unixDate = strtotime($date);
		$cleanTime = date("G:i", $unixDate);
		$data[$i] = array(
			'time' => $cleanTime
		);
		$i+=1;
	};
	
	echo json_encode($data);


?>
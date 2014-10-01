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
		$name = $row['name'];
		$fbookId = $row['fbook_id'];
		$twitId = $row['twit_id'];
		$prizeQuery = "SELECT prize from `prizes` WHERE id = ".$row['prize_id'];
		$prizes = mysql_query($prizeQuery);
		$prize = mysql_fetch_row($prizes)[0];
		$prizeDisplay = ucfirst($prize);
		$date = $row['date_created'];
		$unixDate = strtotime($date);
		$cleanDate = date("d-m-Y H:i:s", $unixDate);
		$location = $row['location'];
		$data[$i] = array(
			'name' => $name,
			'fbookId' => $fbookId,
			'twitId' => $twitId,
			'prize' => $prizeDisplay,
			'date' => $cleanDate,
			'location' => $location
		);
		$i+=1;
	};
	
	echo json_encode($data);


?>
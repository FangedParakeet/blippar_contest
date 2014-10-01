<?php

	include('session_start.php');
	include('db_connect.php');
	
	$xml_output = "<?xml version=\"1.0\"?>\n"; 
	$xml_output .= "<prize>";
	// uncomment below line to participate in competition more than once a day
	// unset($_SESSION['date']);
	if(!isset($_SESSION['date'])){
		
		$xml_output = getPrize($xml_output);	
		
	}
	else {
		$dateLastEntered = $_SESSION['date'];
		$timeThen = strtotime($dateLastEntered);
		$currentTime = date('Y-m-d H:i:s');
		$timeNow = strtotime($currentTime);
		$difference = $timeNow - $timeThen;
		if($difference > 86400){
			// If the last time the contestant entered was greater than 24 hrs
			$xml_output = getPrize($xml_output);	
		}
		else {
			// Negative value denotes that user has entered the competition already today
			$xml_output .= "-1</prize>";
		}
		
	}
	
	echo $xml_output;
	
	function getPrize($xml_output){
		$today = date('Y-m-d');
		$unixToday = strtotime($today);
		$unixTomorrow = strtotime('+1 day', $unixToday);
		$tomorrow = date("Y-m-d", $unixTomorrow);
		
		$query = "SELECT count(id) FROM `contestants` WHERE prize_id != '0' AND date_created >= '".$today."' AND date_created < '".$tomorrow."'";
		$results = mysql_query($query) or die(mysql_error()); 
		$result = mysql_fetch_row($results);
		
		//if fewer than five winners today
		if($result[0] < 5){
			$probability = 3; /* By increasing this number, one can make the likelihood of winning a prize smaller. 
							   MIN VALUE: 2 (Contestant will win a prize every time) */
			$currentTime = date('Y-m-d H:i:s');
			$_SESSION['date'] = $currentTime;
			$prizeChance = rand(0,$probability);
			if($prizeChance == $probability){
				$_SESSION['prize'] = 3;
			}
			else if($prizeChance == $probability - 1){
				$_SESSION['prize'] = 2;
			}
			else if($prizeChance == $probability - 2){
				$_SESSION['prize'] = 1;
			}
			else {
				$_SESSION['prize'] = 0;
			}
			
			$xml_output .= $_SESSION['prize']."</prize>";
		}
		else {
			$xml_output .= "0</prize>";
		}
		
		return $xml_output;			
		
	}
	

?>
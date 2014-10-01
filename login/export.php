<?php

	include('../api/session_start.php');
	include('../api/db_connect.php');
	if(!isset($_SESSION) || !isset($_SESSION['user'])){
		header('Location: http://localhost:8888/blipp_contest/login/index?sneaky=true');
		die();
	}
	
	$output = "";
	$sql = mysql_query("select * from `contestants`");
	$columns_total = mysql_num_fields($sql);
	
	//get headers
	for ($i = 0; $i < $columns_total; $i++) {
		$heading = mysql_field_name($sql, $i);
		$output .= '"'.$heading.'",';
	}
	$output .="\n";
	
	//get data
	while ($row = mysql_fetch_array($sql)) {
		for ($i = 0; $i < $columns_total; $i++) {
			$output .='"'.$row["$i"].'",';
		}
		$output .="\n";
	}
	
	//download
	$filename = "contestants.csv";
	header('Content-type: application/csv');
	header('Content-Disposition: attachment; filename='.$filename);

	echo $output;
	exit;
	
	
	
	
	


?>
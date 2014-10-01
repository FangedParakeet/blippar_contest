<?php

	$hostname = "localhost:8889";
	$username = "root";
	$password = "root";
	$database = "contest";
 
	if(mysql_connect($hostname, $username, $password)) {
		 if(mysql_select_db($database)) {
		 } 
		 else {
			 mysql_error();
		 }
	 } 
	 else 
	 {
		 mysql_error();
	 }


?>
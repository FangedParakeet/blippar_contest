<?php
	
	include('../api/session_start.php');
	if(!isset($_SESSION['user'])){
		header('Location: http://localhost:8888/blipp_contest/login/index?sneaky=true');
		die();
	}

?>
<!DOCTYPE HTML>
<html lang="en">
	<head>
		<meta charset="UTF-8">
		<title>Time Panel</title>
		<link rel="shortcut icon" href="../images/favicon.ico" type="image/x-icon">
		<link rel="icon" href="../images/favicon.ico" type="image/x-icon">
		<link rel="stylesheet" href="../css/style.css">
		<script type="text/javascript" src="../js/jquery.js"></script>
		<script type="text/javascript" src="../js/time_functions.js"></script>
	</head>
	<body>
		<div class="main_wrapper">
			<div class="navbar">
				<div class="row">
					<a class="logo" href="index.php"></a>
					<ul>
						<li><a href="home">Home</a></li>
						<li><a href="map">Map</a></li>
						<li><a href="time">Time</a></li>
						<li><a href="logout">Logout</a></li>
					</ul>
				</div>
			</div>
			<div class="top_content">
				<div class="welcome">
					<h1>Time Tracker</h1>
					<p>When do users Blipp?</p>
				</div>
			</div>
			<div class="main_content">
				<div class="am_clock">
					<img src="../images/clock.png"></img>
					<h1>AM</h1>
				</div>
				<div class="pm_clock">
					<img src="../images/clock.png"></img>
					<h1>PM</h1>
				</div>
			</div>
		</div>
	</body>
</html>
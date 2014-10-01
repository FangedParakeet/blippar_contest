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
		<title>Admin Panel</title>
		<link rel="shortcut icon" href="../images/favicon.ico" type="image/x-icon">
		<link rel="icon" href="../images/favicon.ico" type="image/x-icon">
		<link rel="stylesheet" href="../css/style.css">
		<link rel="stylesheet" href="../css/simplePagination.css">
		<script type="text/javascript" src="../js/jquery-1.7.1.min.js"></script>
		<script type="text/javascript" src="../js/contestant_functions.js"></script>
		<script type="text/javascript" src="../js/jquery.tablesorter.min.js"></script>
		<script type="text/javascript" src="../js/jquery.tablesorter.pager.js"></script>
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
					<h1>Welcome to the Admin Panel</h1>
				</div>
			</div>
			<div class="main_content">
				<table id="contestants" class="tablesorter">
					<thead>
						<tr>
							<th>#</th>
							<th>Name</th>
							<th>Facebook ID</th>
							<th>Twitter ID</th>
							<th>Prize Won</th>
							<th>Date</th>
							<th>Location</th>
						</tr>
					</thead>
					<tbody></tbody>
				</table>
				<div id="paginator" class="dark-theme simple-pagination" style="margin-left:20%">
					<ul>
						<li><a class="page-link first">First</a></li>
						<li><a class="page-link prev">Prev</a></li>
						<li><input type="text" class="pagedisplay ellipse" disabled/></li>
						<li><a class="page-link next">Next</a></li>
						<li><a class="page-link last">Last</a></li>
					</ul>
				</div>
				<a href="export"><div class="submit_button" style="margin-bottom: 40px">Export to CSV</div></a>
			</div>
		</div>
	</body>
</html>
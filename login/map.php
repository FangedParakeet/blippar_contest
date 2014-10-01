<?php
	
	include('../api/session_start.php');
	if(!isset($_SESSION) || !isset($_SESSION['user'])){
		header('Location: http://localhost:8888/blipp_contest/login/index?sneaky=true');
		die();
	}

?>
<!DOCTYPE HTML>
<html lang="en">
	<head>
		<meta charset="UTF-8">
		<title>Map Panel</title>
		<link rel="shortcut icon" href="../images/favicon.ico" type="image/x-icon">
		<link rel="icon" href="../images/favicon.ico" type="image/x-icon">
		<link rel="stylesheet" href="../css/style.css">
		<style>
			.main_content {
				height:100%;
				position:absolute;
			}
			
			html, body, .main_wrapper {
				height: 100%;
			}
			
			
			#map-canvas {
				height: 100%;
				width: 80%;
				margin: 0px auto;
				z-index: 0;
			}
		</style>
		<script type="text/javascript" src="../js/jquery.js"></script>		
	    <script type="text/javascript"
	      src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDlZXvUhdROlhsVLzYdVsdf-6ayluZYX64">
	    </script>
	    <script type="text/javascript">
	      function initialize() {
	        var mapOptions = {
	          center: { lat: -34.397, lng: 150.644},
	          zoom: 2
	        };
	        var map = new google.maps.Map(document.getElementById('map-canvas'),
	            mapOptions);
				addMarkers();
	      }
	      google.maps.event.addDomListener(window, 'load', initialize);
		  
		  function addMarkers(){
			  $.ajax({
				  type: 'post',
				  url: 'http://localhost:8888/blipp_contest/login/get_markers.php',
				  success: function(data){
					  var markers = JSON.parse(data);
					  for(var i = 0; i < markers.length; i++){
						  var coord = markers[i]['location'];
						  var coords = coord.split(",");
						  var lat = parseInt(coord[0]);
						  var long = parseInt(coord[1]); 
						  var myLatlng = new google.maps.LatLng(-27,133);
						  var mapOptions = {
						    zoom: 2,
						    center: myLatlng
						  }
						  var map = new google.maps.Map(document.getElementById("map-canvas"), mapOptions);

						  // To add the marker to the map, use the 'map' property
						  var marker = new google.maps.Marker({
						      position: myLatlng,
						      map: map,
						      title: markers[i]['name']
						  });
					  	
					  }
				  	
				  }
			  });
		  	
		  }
		  
	    </script>
		
		
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
					<h1>Map Time</h1>
					<p>Where are users logging in from?</p>
				</div>
			</div>
			<div class="main_content">
				<div id="map-canvas"></div>
			</div>
		</div>
	</body>
</html>
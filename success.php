<?php
$prize_code = $_GET['prize'];
if($prize_code == '1'){
	$prize = 't-shirt';
}
else if($prize_code == '2'){
	$prize = 'cap';
}
else {
	$prize = 'music download';
}

?>
<!DOCTYPE HTML>
<html lang="en">
	<head>
		<meta charset="UTF-8">
		<title>Congratulations</title>
		<link rel="shortcut icon" href="images/favicon.ico" type="image/x-icon">
		<link rel="icon" href="images/favicon.ico" type="image/x-icon">
		<link rel="stylesheet" href="css/style.css">
		<script type="text/javascript" src="js/jquery.js"></script>
		<script type="text/javascript" src="js/scripts.js"></script>
	</head>
	<body>
		<div class="main_wrapper">
			<div class="navbar">
				<a class="logo" href="index.php"></a>
			</div>
			<div class="top_content">
				<div class="welcome">
					<h1>Congratulations</h1>
					<p>Your <strong><?php echo $prize; ?></strong> has been redeemed!</p>
				</div>
			</div>
			<div class="main_content">
				<div class="submit">
					<p>Keep on Blipping in the free world.</p>
				</div>
				<div class="results">
					<p></p>
				</div>
			</div>
		</div>
		<div class="preloader_overlay">
			<img class="loader_gif" src="images/loading.gif"></img>
		</div>
	</body>
</html>
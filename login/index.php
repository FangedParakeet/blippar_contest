<!DOCTYPE HTML>
<html lang="en">
	<head>
		<meta charset="UTF-8">
		<title>Admin Panel Login</title>
		<link rel="shortcut icon" href="../images/favicon.ico" type="image/x-icon">
		<link rel="icon" href="../images/favicon.ico" type="image/x-icon">
		<link rel="stylesheet" href="../css/style.css">
		<script type="text/javascript" src="../js/jquery.js"></script>
		<script type="text/javascript" src="../js/login.js"></script>
	</head>
	<body>
		<div class="main_wrapper">
			<div class="navbar">
				<a class="logo" href="index.php"></a>
			</div>
			<div class="top_content">
				<div class="welcome">
					<h1>Login</h1>
					<p>If you're not an admin, you shouldn't be here!</p>
				</div>
			</div>
			<div class="main_content">
				<form action="verify_login.php" method="post" id="login">
					<label for="username">Username</label><br />
					<input type="text" name="username" id="username"></input><br />
					<label for="password">Password</label><br />
					<input type="password" name="password" id="password"></input><br />
					<input type="submit" value="Login" id="login_submit"></input><br />
					<p id="errors"></p>
				</form>
			</div>
		</div>
	</body>
</html>
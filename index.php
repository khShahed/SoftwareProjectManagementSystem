<?php
session_start();
require "dbQuery.php";
$query = 'select * from software;';
$result = json_decode(getDBData($query), true);
$name = $result[0]['fullname'];
$logo = $result[0]['logo'];
$sname = $result[0]['shortname'];

?>
	<!DOCTYPE html>
	<html lang="en">

	<head>
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<meta charset="UTF-8" />
		<title>
			<?php echo $sname; ?> - Login</title>
		<link rel="stylesheet" href="w3.css">
		<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
		<link rel="icon" href="<?php echo $logo; ?>" />
	</head>
	<style>
		body {
			background: url(pic.jpg) no-repeat center center fixed;
			background-size: 100% 100%;
			height: 100%;
			position: absolute;
			width: 100%;
		}
		
		.mainDiv {
			background-color: rgba(0, 0, 0, 0.5);
			border: 3px solid rgba(0, 0, 255, 0.4);
			padding: 20px;
			overflow: auto;
			margin-top: 100px;
			width: 600px;
			margin-right: auto;
			margin-left: auto;
			z-index: 3;
		}
		
		#errorMessage {
			font-size: 20px;
			color: white;
			text-align: center;
			background-color: red;
		}

	</style>
	<script>
		function validateForm() {
			var username = document.forms["loginForm"]["username"].value;
			var password = document.forms["loginForm"]["password"].value;
			var error = document.getElementById('errorMessage');
			if (username == "" || password == "") {
				error.innerHTML = "Please fill both field.";
				return false;
			} else {
				return true;
			}
		}

	</script>

	<body>
		<div class="mainDiv w3-block w3-card-2 divC w3-container">
			<div class=" w3-animate-zoom">
				<center>
					<img align="middle" src="<?php echo $logo; ?>" alt="logo">
				</center>
				<h1 class="w3-text-teal w3-serif">
					<?php echo $name; ?>
				</h1>
				<form action="loginCheck.php" method="post" class="w3-block" name="loginForm" onsubmit="return validateForm();">
					<p>
						<label for="username" class="w3-text-teal w3-left">Username</label>
						<input type="text" class="w3-input" name="username" autocomplete="off">
					</p>
					<p>
						<label for="password" class="w3-text-teal w3-left">Password</label>
						<input type="password" class="w3-input" name="password" autocomplete="off">
					</p>
					<p>
						<input type="submit" class="w3-btn w3-teal w3-block">

					</p>
					<p id="errorMessage">
						<?php
						if(isset($_SESSION['errorMessage'])){
							echo $_SESSION['errorMessage'];
						}	
						?>
					</p>
				</form>
			</div>
		</div>
	</body>

	</html>

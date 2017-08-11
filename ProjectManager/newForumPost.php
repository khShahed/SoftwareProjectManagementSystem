<?php
session_start();
require "../dbQuery.php";
if($_SESSION['usertype']!=2){
	header("Location: ../index.php");
	exit();
}
$query = 'select * from software;';
$result = json_decode(getDBData($query), true);
$name = $result[0]['fullname'];
$l = $result[0]['logo'];
$sname = $result[0]['shortname'];
$logo = "../".$l;
?>
	<!DOCTYPE html>
	<html lang="en">

	<head>
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<meta charset="UTF-8" />
		<title>
			<?php echo $_SESSION['username']; ?> - Index</title>
		<link rel="stylesheet" href="../w3.css">
		<link rel="icon" href="<?php echo $logo; ?>" />
		<script src="../jquery.js"></script>
		<style>
			td {
				min-width: 35%;
				padding: 10px;
			}
			
			table {
				min-width: 60%;
			}

		</style>
		<script type="text/javascript">
			function validateForm() {
				var topic = document["newPost"]["topic"].value;
				var des = document["newPost"]["description"].value;
				if (topic.length < 10) {
					return false;
				}
				if (des.length < 20) {
					return false;
				}
				return true;
			}

		</script>
	</head>

	<body>
		<header>
			<img align="left" src="<?php echo $logo; ?>" alt="logo">
			<span style="font-size:40px"><?php echo $name; ?></span>
		</header>
		<div class="w3-container w3-bar w3-teal">
			<span class="w3-bar-item w3-left ">
				<?php echo $sname; ?>
			</span>
			<a href="logout.php" class="w3-bar-item w3-right w3-button">Logout</a>
			<a href="software.php" class="w3-bar-item w3-right w3-button">My Software</a>
			<a href="index.php" class="w3-bar-item w3-right w3-button"><i class="fa fa-home"></i>Home</a>
		</div>
		<div style="width:15%">
			<div class="w3-left w3-bar-block w3-sidenav w3-collapse">
				<a href="addUser.php" class="w3-bar-item w3-center w3-hover-teal w3-button">Add User</a> <br>
				<a href="projects.php" class="w3-bar-item w3-center w3-button w3-hover-teal">Project List</a> <br>
				<a href="forum.php" class="w3-bar-item w3-center w3-button w3-hover-teal">Forum</a><br>
				<a href="notice.php" class="w3-bar-item w3-center w3-button w3-hover-teal">Notice</a><br>
			</div>
		</div>
		<div class="w3-right w3-panel" style="width:85%">

			<div class="w3-section">

				<div class="w3-card-4">
					<div class="w3-container w3-teal">
						<h2>New Post</h2>
					</div>

					<form class="w3-container" method="post" name="newPost" action="newForumPostServer.php" onsubmit="return validateForm();">

						<label>Topic</label>
						<input class="w3-input" type="text" name="topic" id="i1" required>
						<p class="w3-xsmall w3-red" name="topicValidation"></p>


						<label>Description</label><br>
						<input type="text" name="description" form="newPost" class="w3-input" id="i2" required/>
						<p class="w3-xsmall w3-red" name="descriptionValidation"></p>

						<input type="submit" class="w3-btn w3-block w3-teal w3-hover-green" value="Post in Forum">
					</form>
				</div>
			</div>
		</div>
	</body>

	</html>

<?php
session_start();
require "../dbQuery.php";
if($_SESSION['usertype']!=3){
	header("Location: ../index.php");
	exit();
}

if(!isset($_REQUEST['task'])){
	header("location: ../index.php");
	exit();
}
$_SESSION['task'] = $_REQUEST['task'];
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
			<a href="profile.php" class="w3-bar-item w3-right w3-button">My Profile</a>
			<a href="index.php" class="w3-bar-item w3-right w3-button"><i class="fa fa-home"></i>Home</a>

		</div>
		<div class="w3-row-padding">
			<div style="width:20%">
				<div class="w3-left w3-bar-block w3-sidenav w3-collapse">
					<a href="allTask.php" class="w3-bar-item w3-center w3-hover-teal w3-button">All Tasks</a> <br>
					<a href="forum.php" class="w3-bar-item w3-center w3-button w3-hover-teal">Forum</a> <br>
					<a href="notice.php" class="w3-bar-item w3-center w3-button w3-hover-teal">Notice</a> <br>
				</div>
			</div>

			<?php
			$sql = "SELECT task.id, name, description, creationDate, deadline, taskstatus.status,taskpriority.priority, file FROM task,taskpriority,taskstatus WHERE task.id = ".$_REQUEST['task']." and taskpriority.id = task.priority and taskstatus.id = task.status;";
			$result = json_decode(getDBData($sql),true);
			?>
				<div style="width: 80%;  float:left; padding-left:20px;">
					<h1>Upload File With Task</h1>
					<form action="taskFileServer.php" enctype="multipart/form-data" method="post" name="registration">
						<table style="border-collapse:separate; border-spacing:2em;">
							<tr>
								<td width="20%">Name</td>
								<td>
									<?php echo $result[0]["name"];?>
								</td>
							</tr>
							<tr>
								<td width="20%">Description</td>
								<td>
									<?php echo $result[0]["description"];?>
								</td>
							</tr>
							<tr>
								<td>Upload File : </td>
								<td><input type="file" name="file" id="file"></td>
							</tr>

						</table>
						<input type="submit" class="w3-btn w3-block w3-text w3-teal" value="Submit Task">
					</form>
				</div>
		</div>
		<script>
			$('form').submit(function() {
				if (!$('input[type="file"]').val()) {
					// No file is uploaded, do not submit.
					return false;
				} else {
					return true;
				}
			});

		</script>
	</body>

	</html>

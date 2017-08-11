<?php
session_start();
require "../dbQuery.php";
if($_SESSION['usertype']!=3){
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
	</head>
	<script>
		function manage(e) {
			var value = e.value;
			console.log(value);
			if (value == -1) {
				console.log("on if");
				for (j = 1; j < 5; j++) {
					toggle(j.toString(), 'block');
				}
			} else {
				console.log("on else");
				for (j = 1; j < 5; j++) {
					toggle(j.toString(), 'hide');
				}
				toggle(value.toString(), 'block');
			}
		}

		function toggle(className, displayState) {
			var elements = document.getElementsByClassName(className)
			console.log(className + " " + displayState);
			for (var i = 0; i < elements.length; i++) {
				elements[i].style.display = displayState;
				console.log(elements[i]);
			}
		}

	</script>

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
		<div style="width:15%">
			<div class="w3-left w3-bar-block w3-sidenav w3-collapse">
				<a href="allTask.php" class="w3-bar-item w3-center w3-teal w3-button">All Task</a> <br>
				<a href="forum.php" class="w3-bar-item w3-center w3-button w3-hover-teal">Forum</a> <br>
				<a href="notice.php" class="w3-bar-item w3-center w3-button w3-hover-teal">Notice</a> <br>
			</div>
		</div>

		<div class="w3-right w3-panel w3-row-padding" style="width:85%">
			<h1>All Tasks</h1>
			<div class="w3-bar">
				<label for="">Show</label>
				<select name="status" id="ts" onchange="manage(this)">
					<option value="-1" selected>All</option>
					<?php
					$query = "SELECT * from taskstatus;";
					$types = json_decode(getDBData($query), true);
					
					for($i = 0 ; $i<sizeof($types); $i++){
						$id = $types[$i]['id'];
						$name =$types[$i]['status'];
						echo "<option value=\"".$id."\">".$name."</option>";
					}
					?>
				</select>
			</div>
			<div class="w3-panel w3-rest">
				<?php
					$query = "SELECT task.id, task.name, task.description, task.creationDate, project.name as project, taskpriority.priority, task.status from task,project,taskpriority WHERE task.project = project.id and task.priority = taskpriority.id and task.user = ".$_SESSION['id'].";";
					$result = json_decode(getDBData($query), true);
					for($i = 0 ; $i<sizeof($result); $i++){
						echo 
							"<div class='".$result[$i]['status']."'>
								<div class=\"w3-card-2 w3-hover-shadow \" style=\"border-bottom:5px;\">
								  <header class=\"w3-teal\" style= \"padding:10px;\"><h3>".$result[$i]["name"]."</h3></header>
								  <body class = \"w3-container\">
									<p>".$result[$i]["description"]."</p>
									</body>
								  <footer class = \"w3-sand\">
								  	<p >Task Priority: ".$result[$i]["priority"]."</p>
									<p >Project: ".$result[$i]["project"]."</p>
									<p >Creation Date: ".$result[$i]["creationDate"]."</p>

								  </footer>
								</div>
							</div>";
					}
					?>
			</div>
		</div>
	</body>

	</html>

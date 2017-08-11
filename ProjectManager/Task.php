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
				<!--<a href="addUser.php" class="w3-bar-item w3-center w3-hover-teal w3-button">Add User</a> <br>
				<a href="projects.php" class="w3-bar-item w3-center w3-button w3-hover-teal">Project List</a> <br>-->
				<a href="forum.php" class="w3-bar-item w3-center w3-button w3-hover-teal">Forum</a><br>
				<a href="notice.php" class="w3-bar-item w3-center w3-button w3-hover-teal">Notice</a><br>
			</div>
		</div>

		<div style="width:82%; float:right;padding:30px;">
			<div align="center">
				
				<table class="w3-table-all" id="taskDisplayTable"> 
					<tr>
						<th> Id </th>
						<th> name </th>
						<th> descFile </th>
						<th> start_date </th>
						<th> deadline </th>
						<th> priority </th>
						<th> status </th>
						<th> developerName </th>
						<th> Task Files</th>
					</tr>
					<?php
						$query = "SELECT DISTINCT task.id, task.name, description, creationDate, deadline, taskstatus.status, taskpriority.priority, user.username, file FROM user, task, taskpriority, taskstatus where taskpriority.id=task.priority and taskstatus.id= task.status and user.id = task.user and task.project = '".$_REQUEST['id']."'";
						$result = json_decode(getDBData($query), true);
						
						for($i=0;$i<sizeof($result);$i++){
							echo "
							<tr>
								<td>".$result[$i]['id']."</td>
								<td>".$result[$i]['name']."</td>
								<td>".$result[$i]['description']."</td>
								<td>".$result[$i]['creationDate']."</td>
								<td>".$result[$i]['deadline']."</td>
								<td>".$result[$i]['priority']."</td>
								<td>".$result[$i]['status']."</td>
								<td>".$result[$i]['username']."</td>
								<td>".$result[$i]['file']."</td>
							</tr>
							";
						}
					?>
					
				</table>
			</div> <br/>
			<div align='center'>
				<a href='createTask.php?id='.$_REQUEST['pmId'].' class='w3-teal w3-button'  id='Task'>Create New Tasks</a>
			</div>

		</div>
	</body>

	</html>

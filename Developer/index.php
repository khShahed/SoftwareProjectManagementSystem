<?php
require "../dbQuery.php";
session_start();
if($_SESSION['usertype']!=3){
	header("Location: ../index.php");
	exit();
}
$query = "select * from software;";
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
			<a href="index.php" class="w3-bar-item w3-right w3-button w3-blue"><i class="fa fa-home"></i>Home</a>
		</div>
		<div class="w3-row-padding">
			<div style="width:15%">
				<div class="w3-left w3-bar-block w3-sidenav w3-collapse">
					<a href="allTask.php" class="w3-bar-item w3-center w3-hover-teal w3-button">All Tasks</a> <br>
					<a href="forum.php" class="w3-bar-item w3-center w3-button w3-hover-teal">Forum</a> <br>
					<a href="notice.php" class="w3-bar-item w3-center w3-button w3-hover-teal">Notice</a> <br>
				</div>
			</div>
			<!-- Tasks In Queue !-->
			<div style="width: 45%; padding:10px; maximum-heifht:1000px; overflow:auto; float:left;">
				<h1>In Queue</h1>
				<?php
					$sql = "SELECT task.id, name, description, creationDate, deadline, taskstatus.status,taskpriority.priority, file FROM task,taskpriority,taskstatus WHERE user = ".$_SESSION['id']." and taskpriority.id = task.priority and taskstatus.id = task.status and task.status=1;";
					$result = json_decode(getDBData($sql),true);
					for($i=0;$i<sizeof($result); $i++){
						if(is_null($result[$i]["file"])) 
							$result[$i]["file"] = "None";
						if($result[$i]["priority"]=="High")
							$color = "w3-red";
						elseif($result[$i]["priority"]=="Medium")
							$color = "w3-orange";
						else
							$color = "w3-green";
						
						echo "<div class=\"w3-card-2 w3-hover-shadow\" style=\"border-bottom:5px;\">
						  <header class=\"$color\" style= \"padding:10px;\"><h3>".$result[$i]["name"]."</h3></header>
						  <body class = \"w3-container\">
							<p>".$result[$i]["description"]."</p>
							<p class = \"w3-sand\">Task Priority: ".$result[$i]["priority"]."</p>
							<p>Attachment :";
						if(is_null($result[$i]["file"]) or empty($result[$i]["file"]) or (!$result[$i]["file"]) or $result[$i]["file"] ==null or $result[$i]["file"] =="None")
						{
							echo "no attachment.";
						}
						else {
							$url = "../".$result[$i]["file"];
							$output = explode("/",$url);
							$name = $output[count($output)-1];
							echo "<a href=\"$url\" download>$name</a></p>";
						}
						 echo "</body>
						  <footer><a href=\"taskServer.php?start=".$result[$i]["id"]."\" class =\"w3-btn w3-block w3-teal\"> Start Process</a>
						  	
						  </footer>
						</div>";
					}
				?>
			</div>
			<div style="width: 40%; padding:10px; maximum-heifht:1000px; overflow:auto; float:left;">
				<h1>In Progress</h1>
				<?php
					$sql = "SELECT task.id, name, description, creationDate, deadline, taskstatus.status,taskpriority.priority, file FROM task,taskpriority,taskstatus WHERE user = ".$_SESSION['id']." and taskpriority.id = task.priority and taskstatus.id = task.status and task.status=3;";
					$result = json_decode(getDBData($sql),true);
					for($i=0;$i<sizeof($result); $i++){
						if(is_null($result[$i]["file"])) 
							$result[$i]["file"] = "None";
						if($result[$i]["priority"]=="High")
							$color = "w3-red";
						elseif($result[$i]["priority"]=="Medium")
							$color = "w3-orange";
						else
							$color = "w3-green";
						echo "<div class=\"w3-card-2 w3-hover-shadow \" style=\"border-bottom:5px;\">
						  <header class=\"$color\" style= \"padding:10px;\"><h3>".$result[$i]["name"]."</h3></header>
						  <body class = \"w3-container\">
							<p>".$result[$i]["description"]."</p>
							<p class = \"w3-sand\">Task Priority: ".$result[$i]["priority"]."</p>
							<p>Attachment :";
						if(is_null($result[$i]["file"]) or empty($result[$i]["file"]) or (!$result[$i]["file"]) or $result[$i]["file"] ==null or $result[$i]["file"] =="None")
						{
							echo "no attachment.";
						}
						else {
							$url = "../".$result[$i]["file"];
							$output = explode("/",$url);
							$name = $output[count($output)-1];
							echo "<a href=\"$url\" download>$name</a></p>";
						}
						  echo "</body>
						  <footer><a href=\"taskServer.php?complete=".$result[$i]["id"]."\" class =\"w3-btn w3-block w3-teal\"> Complete</a>
						  	<a href=\"taskWithFile.php?task=".$result[$i]["id"]."\" class =\"w3-btn w3-block w3-blue\"> Submit File and Complete</a>
						  </footer>
						</div>";
					}
				?>
			</div>
		</div>
	</body>

	</html>

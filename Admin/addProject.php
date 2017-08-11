<?php
session_start();
require "../dbQuery.php";
if($_SESSION['usertype']!=1){
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
		<script type="text/javascript" src="projectManager.js"></script>
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
		<div class="w3-right w3-panel w3-sand" style="width:85%">

		<div align="center" id='divProject'>
		<h1>Enter Project Details</h1>
		<form name="projectCreateForm" action="addProjectServer.php" enctype="multipart/form-data" method="post">
			<table id="showAllInfoTable" class="projectTable"> 
					
					<tr>
						<td>Project Name: <td/>
						<td> <input type="text" name="pName" onkeyup='checkName()'/> </td>
						<td> <p id="nameCheck"></p>
					</tr>
					<tr>
						<td>Description : <td/>
						<td> <input type="text" name="desc" onkeyup='checkDesc()'/> </td>
						<td> <p id="descCheck"></p>
					</tr>
					<tr>
						<td>Project start date: <td/>
						<td><input type="date" name="startDate" required></td>
						<td></td>
					</tr>
					<tr>
						<td>Project end date:<td/>
						<td><input type="date" name="endDate" required></td>
						<td></td>
					</tr>
					<tr>
						<td>Project manager: <td/>
						<td><select id="pMan" name="projManager">
								<?php
									$query = "select id, name from user where type=2";
									$result = json_decode(getDBData($query), true);

									for($i=0; $i<sizeof($result); $i++)
									{
										echo "<option value= '".$result[$i]['id']."'>".$result[$i]['name']."</option>";
									}
								?>
							</select> </td>
						<td></td>
					</tr>
					<tr>
						<td>Priority: <td/>
						<td>
							<select id="priority" name="priority"> 
								<?php
									$query = "select * from projectpriority";
									$result = json_decode(getDBData($query), true);

									for($i=0; $i<sizeof($result); $i++)
									{
										echo "<option value= '".$result[$i]['id']."'>".$result[$i]['priority']."</option>";
									}
								?>
							</select>
						</td>
						<td></td>
					</tr>
					<tr>
						<td>Status: <td/>
						<td><select id="stat" name="status"> 
								<?php
									$query = "select * from projectstatus";
									$result = json_decode(getDBData($query), true);

									for($i=0; $i<sizeof($result); $i++)
									{
										echo "<option value= '".$result[$i]['id']."'>".$result[$i]['status']."</option>";
									}
								?>
							</select>
						</td>
						<td></td>
					</tr>
					<tr>
						<td></td>
						<td><input class='w3-teal w3-button' type="button" id='submitProject' value="Save" onclick='create()'></td>
						<td></td>
					</tr>
				</table>
			</form>
			</div>
		</div>
	</body>

	</html>

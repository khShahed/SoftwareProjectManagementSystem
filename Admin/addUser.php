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
		<script type="text/javascript" src="admin.js"></script>
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

			<div id="createUserDiv" style="display: block" class="createUser" align="center">
				<form id="form0" name="createUserForm" action="addUserServer.php" method="post" enctype="multipart/form-data">
					<h1 style="margin-top: 0px; margin-bottom: 10px"> Enter User Credentials </h1>
					<table style="font-size: 18px">
						<tr>
							<td> UserName: </td>
							<td> <input type="text" name="username" onkeyup="checkName()" required/></td>
							<td>
								<p id="nameCheck"> </p>
							</td>
						</tr>
						<tr>
							<td> Password: </td>
							<td> <input type="password" name="password" onkeyup="passCheck()" required/></td>
							<td>
								<p id="passCheck"> </p>
							</td>
						</tr>
						<tr>
							<td> Confirm Password: </td>
							<td> <input type="password" name="confirmPassword" onkeyup="confPassCheck()" required/></td>
							<td>
								<p id="confPassCheck"> </p>
							</td>
						</tr>
						<tr>
							<td> Full Name: </td>
							<td> <input type="text" name="fullname" onkeyup="checkFullName()" required/></td>
							<td>
								<p id="fullNameCheck"> </p>
							</td>
						</tr>
						<tr>
							<td> DOB: </td>
							<td><input type="date" name="dob" required></td>
							<td>
								<p id="dobCheck"> </p>
							</td>
						</tr>
						<tr>
							<td>User type</td>
							<td>
								<select name="usertype" id="">
								<?php
								$query = 'select * from usertype;';
								$result = json_decode(getDBData($query), true);
								for($i=0;$i<sizeof($result);$i++){
									echo "
									<option value='".$result[$i]['id']."'>".$result[$i]['type']."</option>
									";
								}
								?>
								</select>
							</td>
						</tr>
						<tr>
							<td>Photo</td>
							<td><input type="file" name="photo" required></td>
							<td></td>
						</tr>
						<tr>
							<td> </td>
							<td> <input type="button" onclick="create()" class="w3-button w3-teal w3-block" value='Submit'> </td>
							<td> </td>
						</tr>
					</table>
				</form>
			</div>
		</div>
	</body>

	</html>

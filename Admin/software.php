<?php
session_start();
if($_SESSION['usertype']!=1 && !isset($_SESSION['id'])){
	header("Location: ../index.php");
	exit();
}
require "../dbQuery.php";
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
		<div class="w3-row-padding">
			<div style="width:15%">
				<div class="w3-left w3-bar-block w3-sidenav w3-collapse">
					<a href="addUser.php" class="w3-bar-item w3-center w3-hover-teal w3-button">Add User</a> <br>
					<a href="projects.php" class="w3-bar-item w3-center w3-button w3-hover-teal">Project List</a> <br>
					<a href="forum.php" class="w3-bar-item w3-center w3-button w3-hover-teal">Forum</a><br>
					<a href="notice.php" class="w3-bar-item w3-center w3-button w3-hover-teal">Notice</a><br>
				</div>
			</div>
			<div style="width:82%; float:right;padding:30px;">
				<form action="softwareUpdate.php" method="post" name="updateSoftware" enctype="multipart/form-data">
					<label for="">Full Name</label>
					<input type="text" class="w3-input" value="<?php echo $name; ?>" name="fullname" onkeyup="validateFullname()" id="fullname">
					<p id="ferror" style="font-color:red; font-size:10px;"></p> <br>

					<label for="">Short Name</label>
					<input type="text" class="w3-input" value="<?php echo $sname; ?>" name="shortname" onkeyup="validateShortname()" id="shortname">
					<p id="serror" style="font-color:red; font-size:10px;"></p> <br>

					<label for="">Logo</label><br>
					<img align="left" src="<?php echo $logo; ?>" alt="logo">
					<input type="file" class="w3-input" value="<?php echo $l; ?>">

					<input type="submit" value="Update Info" class="w3-block w3-button w3-teal w3-hover-shadow" onclick="return validate()">
				</form>
			</div>
		</div>
		<script type="text/javascript">
			function validateFullname() {
				var fname = document.getElementById("fullname").value;
				if (fname.length <= 10) {
					document.getElementById("ferror").value = "Full Name should containg more then 10 character.";
					return false;
				} else {
					document.getElementById("ferror").value = "";
					return true;
				}
			}

			function validateShortname() {
				var shortName = document.getElementById("shortname").value;

				if (shortName.length < 2) {
					document.getElementById("ferror").value = "Short Name should conatain more than 2 character.";
					return false;
				} else if (shortName.length > 6) {
					document.getElementById("ferror").value = "Short Name should conatain less then 6 character.";
					return false;
				} else {
					document.getElementById("ferror").value = "";
					return true;
				}
			}

			function validate() {

				return validateShortname() && validateFullname();
			}

		</script>
	</body>

	</html>

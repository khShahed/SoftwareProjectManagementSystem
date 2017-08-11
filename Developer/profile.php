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
		<script src="../jquery.js"></script>
		<script src="profileUpdateValidate.js"></script>
		<style>
			td {
				min-width: 35%;
				padding: 10px;
			}
			
			table {
				min-width: 60%;
			}

		</style>
		<!-- for change password !-->
		<script type="text/javascript">
			function validateForm() {
				var cp = document.forms["myForm"]["currentPassword"].value;
				var np = document.forms["myForm"]["newPassword"].value;
				var rp = document.forms["myForm"]["retypePassword"].value;
				if (cp == "") {
					return false;
				}
				if (np == "") {
					return false;
				}
				if (np != rp) {
					return false;
				}
				return true;
			}

			function validateAC() {
				var ct = document.forms["myForm"]["contactType"].value;
				var des = document.forms["myForm"]["description"].value;
				if (!ct) {
					return false;
				}
				if (des == "") {
					return false;
				}
				if (des.length < 6)
					return false;
				return true;
			}

			function checkPassword()
			{
				password = document.getElementById('cp').value;
				var xhttp = new XMLHttpRequest();
				console.log("entered");
				xhttp.onreadystatechange = function() {
					if (this.readyState == 4 && this.status == 200) {
						console.log("received");
						document.getElementById("cpError").innerHTML = this.responseText;
						if (this.responseText == "Incorrect password!")
							cpv = false;
						else
							cpv = true;
					}
				};
				xhttp.open("POST", "ajaxPasswordCheck.php", true);
				xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
				xhttp.send("password=" + password);
				console.log("sended");

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
			<a href="profile.php" class="w3-bar-item w3-right w3-button w3-blue">My Profile</a>
			<a href="index.php" class="w3-bar-item w3-right w3-button"><i class="fa fa-home"></i>Home</a>
		</div>

		<div style="width:15%">
			<div class="w3-left w3-bar-block w3-sidenav w3-collapse">
				<a href="allTask.php" class="w3-bar-item w3-center w3-hover-teal w3-button">All Task</a> <br>
				<a href="forum.php" class="w3-bar-item w3-center w3-button w3-hover-teal">Forum</a> <br>
				<a href="notice.php" class="w3-bar-item w3-center w3-button w3-hover-teal">Notice</a> <br>
			</div>
		</div>

		<div style="width:85%">
			<?php
			$query = "";
			if(isset($_REQUEST['id'])){
				$query = "select * from user where id = ".$_REQUEST['id'].";";
			}
			else{
				$query = "select * from user where id = ".$_SESSION['id'].";";
			}
			
			$result = json_decode(getDBData($query), true);
			?>
				<h1>My Profile</h1>
				<table style="padding:20px;">
					<tr>
						<td>Username</td>
						<td>
							<?php echo $result[0]['username'];?>
						</td>
					</tr>
					<tr>
						<td>Name</td>
						<td>
							<?php echo $result[0]['name'];?>
						</td>
					</tr>
					<tr>
						<td>DOB</td>
						<td>
							<?php echo $result[0]['dob'];?>
						</td>
					</tr>
					<tr>
						<td>Photo</td>
						<td>
							<?php
							if(is_null($result[0]["photo"]) or empty($result[0]["photo"]) or (!$result[0]["photo"]) or $result[0]["photo"] ==null or $result[0]["photo"] =="None")
							{
								echo "no photo.";
							}
							else {
								$url = "../".$result[0]["photo"];
								echo "<img src=\"$url\" width=\"100\" height=\"100\">";
							}
							?>
								<a href="" class="w3-btn w3-block w3-teal">Update Photo</a>
						</td>
						<td>

						</td>
					</tr>
					<tr>
						<td colspan="2">Contact</td>
					</tr>
					<tr>
						<td colspan="2">
							<!-- Contact Table!-->
							<table class="w3-table-all w3-centered">
								<tr class="w3-teal">
									<th>Contact Type</th>
									<th>Description</th>
								</tr>
								<?php
								$query = "SELECT contact.id, contacttype.name ,description from contact, contacttype WHERE contact.type = contacttype.id and user = ".$_SESSION['id'].";";
								#$query = "SELECT contact.id, contacttype.name ,description from contact, contacttype WHERE contact.type = contacttype.id and user = 3;";
								$contact = json_decode(getDBData($query), true);
								#echo sizeof($result)." ".$_SESSION['id'];
								for($i = 0 ; $i<sizeof($contact); $i++){
									
									echo "
									<tr class=\"w3-hover-green\">
										<td>".$contact[$i]['name']."</td>
										<td>".$contact[$i]['description']."</td>
									</tr>
									";
								}
								?>
									<tr>
										<td colspan="2"><a onclick="document.getElementById('id03').style.display='block'" class="w3-btn w3-hover-shadow w3-teal w3-block">Add Contact</a></td>
									</tr>
							</table>
						</td>
					</tr>
					<tr>
						<td><a onclick="document.getElementById('id01').style.display='block'" class="w3-btn w3-hover-shadow w3-teal w3-block">Change Password</a></td>
						<td><a onclick="document.getElementById('id02').style.display='block'" class="w3-btn w3-hover-shadow w3-teal w3-block">Update Profile</a></td>
					</tr>
				</table>
				<!-- Add Contact Modal!-->
				<div id="id03" class="w3-modal">
					<div class="w3-modal-content">
						<header class="w3-container w3-teal">
							<span onclick="document.getElementById('id03').style.display='none'" class="w3-button w3-display-topright w3-red">&times;</span>
							<h2>Add Contact</h2>
						</header>
						<form method="post" action="addContact.php" name="ac" onsubmit="return validateAC()">
							<div class="w3-container">
								<label for=""> Contact Type </label>
								<select name="contactType" class="w3-select">
									<?php
									$query = "SELECT id, name from contacttype;";
									$types = json_decode(getDBData($query), true);
									#echo sizeof($result);
									for($i = 0 ; $i<sizeof($types); $i++){
										$id = $types[$i]['id'];
										$name =$types[$i]['name'];
										
										echo "<option value=\"".$id."\">".$name."</option>";
									}
									?>
								</select>
								<label for=""> Description</label>
								<input type="text" class="w3-input" name="description" id="np" required>

							</div>
							<footer class="w3-container w3-teal">
								<input type="submit" class="w3-btn w3-block" value="Add Contact">
							</footer>
						</form>
					</div>
				</div>
				<!-- CHange  password Modal!-->
				<div id="id01" class="w3-modal">
					<div class="w3-modal-content">
						<header class="w3-container w3-teal">
							<span onclick="document.getElementById('id01').style.display='none'" class="w3-button w3-display-topright w3-red">&times;</span>
							<h2>Change Password</h2>
						</header>
						<form method="post" action="changePassword.php" name="myForm" onsubmit="return validateForm()">
							<div class="w3-container">
								<label for=""> Current Password </label>
								<input type="password" class="w3-input" name="currentPassword" id="cp" onkeyup='checkPass()'>
								<p id='pP'></p><br/>
								<span id="cpError"></span> <br>
								<label for=""> New Password :</label>
								<input type="password" class="w3-input" name="newPassword" id="np" onkeyup='checkNewPass()'>
								<p id='nP'></p><br/>
								<label for="">Retype Password :</label>
								<input type="password" class="w3-input" name="retypePassword" id="rp" onkeyup='confPassCheck()'>
								<p id='ncP'></p><br/>
							</div>
							<footer class="w3-container w3-teal">
								<input type="submit" class="w3-btn w3-block" value="Change Password">
							</footer>
						</form>
					</div>
				</div>

				<!-- Update  profile Modal!-->
				<div id="id02" class="w3-modal">
					<div class="w3-modal-content">
						<header class="w3-container w3-teal">
							<span onclick="document.getElementById('id02').style.display='none'" class="w3-button w3-display-topright w3-red">&times;</span>
							<h2>Update Profile</h2>
						</header>
						<form method="post" name="updateProfileForm" action="updateProfile.php" name="up">
							<div class="w3-container">
								<label for=""> Username </label>
								<input type="text" class="w3-input" name="username" value="<?php echo $result[0]['username'];?>" readonly>
								<label for=""> Name</label>
								<input onkeyup='checkFullName()' type="text" class="w3-input" name="name" value="<?php echo $result[0]['name'];?>">
								<p id='nameCheck'></p><br/>
								<label for="">DOB</label>
								<input type="date" class="w3-input" name="dob" value="<?php echo $result[0]['dob'];?>">
							</div>
							<footer class="w3-container w3-teal">
								<input id='updateSubmit' type="type" class="w3-btn w3-block" value="Update Profile">
							</footer>
						</form>
					</div>
				</div>

		</div>
	</body>

	</html>

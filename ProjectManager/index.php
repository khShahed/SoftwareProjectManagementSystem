<?php
session_start();
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
			<a href="profile.php" class="w3-bar-item w3-right w3-button">My Profile</a>
			<a href="index.php" class="w3-bar-item w3-right w3-button"><i class="fa fa-home"></i>Home</a>

		</div>
		<div style="width:15%">
			<div class="w3-left w3-bar-block w3-sidenav w3-collapse">
				<a href="forum.php" class="w3-bar-item w3-center w3-button w3-hover-teal">Forum</a><br>
				<a href="notice.php" class="w3-bar-item w3-center w3-button w3-hover-teal">Notice</a><br>
			</div>
		</div>

		<div style="width:85%; float:right;padding:10px;">
				<table class="w3-table-all">
					<tr>
						<th> Id </th>
						<th> Name </th>
						<th> Description </th>
						<th> StartDate </th>
						<th> EndDate </th>
						<th> Priority </th>
						<th> Status </th>
						<th>Actions</th>
					</tr>
					<?php
				$query = "SELECT project.id, name, description, startDate, endDate, priority, status FROM `project` where PM = '".$_SESSION['id']."'";
				$result = json_decode(getDBData($query), true);
				for($i=0;$i<sizeof($result);$i++){
					echo "
					<tr>
						<td>".$result[$i]['id']."</td>
						<td>".$result[$i]['name']."</td>
						<td>".$result[$i]['description']."</td>
						<td>".$result[$i]['startDate']."</td>
						<td>".$result[$i]['endDate']."</td>
						<td>".$result[$i]['priority']."</td>
						<td>".$result[$i]['status']."</td>
						<td><a href=\"Task.php?id=".$result[$i]['id']."&pmId=".$_SESSION['id']."\">Show and create tasks</a></td>
					</tr>
					";
				}
				?>
				</table>
			</div>
	</body>

	</html>

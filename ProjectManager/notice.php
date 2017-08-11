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
			<div class="w3-bar">
				<h1 class="w3-xxlarge w3-bar-item">Notice</h1>
				<a href="newNotice.php" class="w3-bar-item w3-right w3-btn w3-teal w3-xxlarge w3-circle">+</a>
			</div>

			<div class="w3-section">

				<?php
                
                $sql = "select notice.id, subject, description, time, user.name from notice,user WHERE notice.user = user.id ORDER BY time DESC;";
                $posts = json_decode(getDBData($sql), true);
				if(sizeof($posts)>0){
					
					for($i=0; $i<sizeof($posts);$i++){
						if($i%2==0){
							$color = "w3-white";
						}
						else{
							$color = "w3-signal-grey";
						}
						echo "<div class=\"w3-card-4 $color\">
								<header class=\"w3-container w3-light-grey\">
									<h3>".$posts[$i]["subject"]."</h3>
								</header>
								<body>
								<div class=\"w3-container\">
									<p>".$posts[$i]["description"]."</p>
									<hr style=\"border-width: 5px;display: block;\">
									
									<p>Posted by:".$posts[$i]["name"]."</p>
									<p>
										".$posts[$i]["time"]."
									</p>
								</div>
								</body>
								<footer>
								<button class=\"w3-btn w3-block w3-teal\"></button>
								</footer>
							</div>";
					}
				}
				else
					echo "No notice yet.";
            ?>
			</div>
		</div>
	</body>

	</html>

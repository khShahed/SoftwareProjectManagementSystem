<head>
	<script>
		function redirect()
		{
			window.location.replace("Admin.html");
		}
	</script>
</head>
<?php
	
	if(isset($_POST['id']))
	{
		session_start();
		$_SESSION['update'] = 1;

		echo "<div align='center'>";
		echo "<h1> Edit Data</h1>";
			echo "<form action='AdminPageDataOperation.php' method='post'>";
				echo "<input type='text' name='id' value='".$_POST['id']."' onclick='enableFlag(this)'/> <br/>";
				echo "<input type='text' name='userName' value='".$_POST['userName']."' onclick='enableFlag(this)'/> <br/>";
				echo "<input type='text' name='DOB' value='".$_POST['DOB']."' onclick='enableFlag(this)'/> <br/>
						date must be in yyyy-mm-dd format<br/>";
				echo "<input type='text' name='contact' value='".$_POST['Contact']."' onclick='enableFlag(this)'/> <br/>";
				echo "<input type='text' name='userType' value='".$_POST['Type']."' onclick='enableFlag(this)'/> <br/>";
				echo "choices for user type: admin // projectManager // softwareDeveloper<br/>";
				echo "<input type='submit'/>";
			echo "</form><br/>";

			echo "<button onclick='redirect()'>Home</button>";
		echo "</div>";
		
	}
?>

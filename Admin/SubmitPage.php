<!doctype html>
<html>
<head> 
    <script src="admin.js"> </script>
</head>

<body>
	<?php
        session_start();

		$done = 1;
		foreach($_POST as $k => $val)
		{
			if(strlen($_POST[$k]) == 0)
			{
				echo "the $k field must not be empty</br>";
				echo "<hr/>";
			}
		}
		
		if(!is_numeric($_POST['contact'])){
			echo "contact must be numerical value<br/>";
			$done = 0;
		}
		if(strlen($_POST['password']) < 7){
			echo "pass must be greater than 7 chars<br/>";
			$done = 0;
		}
		
		if(strcmp($_POST['password'],$_POST['confirmPassword']) != 0){
			echo "password dont match<br/>";
			$done = 0;
		}
		if($done == 1)
		{
			foreach($_POST as $k => $val)
			{
				echo "$k: ";
				echo "$val<br/>";
                $_SESSION[$k] = $val;
			}
            $_SESSION['insert'] = 1;
            header("location:AdminPageDataOperation.php");
		}
	?>
</body>
</html>
<?php
session_start();
require "../dbQuery.php";
if($_SESSION['usertype']!=1){
	header("Location: ../index.php");
	exit();
}
$username = $_REQUEST['username'];
$pas = $_REQUEST['password'];
$cpass = $_REQUEST['confirmPassword'];
$usertype = $_REQUEST['usertype'];
$dob = $_REQUEST['dob'];
$fullname = $_REQUEST['fullname'];
$photo = $_FILES["photo"]["name"];

if(is_null($username)||is_null($pas)||is_null($cpass)||is_null($usertype)||is_null($fullname)){
	 echo "<h1 style=\" color:red\">Can't create user!</h1>";
	echo "<script>setTimeout(function(){window.location.href='index.php'},2000);</script>";
}
if($pas != $cpass){
	echo "<h1 style=\" color:red\">Can't create user!</h1>";
	echo "<script>setTimeout(function(){window.location.href='index.php'},2000);</script>";
}
$query = "";

if($photo != null){
	echo "coming if 1";
	$target_dir = "/photo/user/".time();
	$real_dir = $target_dir.$_FILES["photo"]["name"];
	$target_file = "../".$target_dir . $_FILES["photo"]["name"];

	if(move_uploaded_file($_FILES["photo"]["tmp_name"], $target_file)) {
		$query = "insert into user values(null,'".$username."','".$pas."','".$fullname."','".$dob."','".$real_dir."','".$usertype."');";
		$result = getDBData($query);
		if($result >0){
			echo "<h1 style=\" color:green\">Successfully created user!</h1>";
		}
		else{
			echo "<h1 style=\" color:red\">Unknown Error!</h1>";
		}
		echo "<script>setTimeout(function(){window.location.href='index.php'},2000);</script>";
	}
}

else{
	echo 'coming els';
	$query = "insert into user values(null,'".$username."','".$pas."','".$fullname."','".$dob."',null,'".$usertype."');";
	$result = getDBData($query);
	if($result >0){
		echo "<h1 style=\" color:green\">Successfully created user!</h1>";
		}
		else{
			echo "<h1 style=\" color:red\">Unknown Error!</h1>";
		}
		echo "<script>setTimeout(function(){window.location.href='index.php'},2000);</script>";
	}
?>

<?php
require "dbQuery.php";
session_start();
$userName = $_REQUEST['username'];
$password = $_REQUEST['password'];
if(strlen($userName)==0 || strlen($password)==0){
	$_SESSION['errorMessage'] = 'Please fill both field.';
	header("location:index.php");
	#exit();
}
else{
	
	$query = "select * from user where username ='".$userName."' and password = '".$password."'; ";
	$result = json_decode(getDBData($query),true);
	if(sizeof($result)>0){
		$_SESSION['id'] = $result[0]['id'];
		$_SESSION['username'] = $result[0]['username'];
		$_SESSION['usertype'] = $result[0]['type'];
		if($_SESSION['usertype'] == 1){
			header("location: Admin/index.php");
			exit();
		}
		elseif($_SESSION['usertype'] == 2){
			header("location: ProjectManager/index.php");
			exit();
		}
		elseif($_SESSION['usertype'] == 3){
			header("Location: Developer/index.php");
			exit();
		}
	}
	else{
		$_SESSION['errorMessage'] = 'Invalid username or password.';
		header("location:index.php");
		exit();
	}
}
?>

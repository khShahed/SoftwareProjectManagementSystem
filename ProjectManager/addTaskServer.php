<?php
session_start();
require "../dbQuery.php";
if($_SESSION['usertype']!=2){
	header("Location: ../index.php");
	exit();
}
$tName = $_REQUEST['tName'];
$desc = $_REQUEST['desc'];
$startDate = $_REQUEST['startDate'];
$endDate = $_REQUEST['endDate'];
$priority = $_REQUEST['priority'];
$status = $_REQUEST['status'];
$project = $_REQUEST['project'];
$developer = $_REQUEST['developer'];
$file =  $_FILES["photo"]["name"];

if(is_null($tName)||is_null($desc)||is_null($startDate)||is_null($endDate)||is_null($priority)||is_null($status)||is_null($project)||is_null($developer)){
	 echo "<h1 style=\" color:red\">Can't create user!</h1>";
	echo "<script>setTimeout(function(){window.location.href='index.php'},2000);</script>";
}

if($file != null){
	echo "coming if 1";
	$target_dir = "/photo/user/".time();
	$real_dir = $target_dir.$_FILES["photo"]["name"];
	$target_file = "../".$target_dir . $_FILES["photo"]["name"];

	if(move_uploaded_file($_FILES["photo"]["tmp_name"], $target_file)) {
		$query = "insert into task values(null,'".$tName."','".$desc."','".$startDate."','".$endDate."','".$status."','".$priority."','".$developer."','".$file."','".$project."');";
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
	$query = "insert into task values(null,'".$tName."','".$desc."','".$startDate."','".$endDate."','".$status."','".$priority."','".$developer."',null,'".$project."');";
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

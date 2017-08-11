<?php
session_start();
require "../dbQuery.php";
if($_SESSION['usertype']!=3){
	header("Location: ../index.php");
	exit();
}
if(strlen($_REQUEST['description'])==0){
	echo "<h1 style=\"color:red\">Please insert contact desscription.</h1>";
	echo "<script>setTimeout(function(){window.location.href='profile.php'},3000);</script>";
}
elseif(strlen($_REQUEST['description'])<6){
	echo "<h1 style=\"color:red\">Contact desscription should contain more than 5 character.</h1>";
	echo "<script>setTimeout(function(){window.location.href='profile.php'},3000);</script>";
}
else{
	$query = "insert into contact values(null,'".$_REQUEST['contactType']."','".$_REQUEST['description']."','".$_SESSION['id']."');";
	$result = getDBData($query);
	if($result){
		echo "<h1 style=\"color:green\">Contact added successfully.</h1>";
		echo "<script>setTimeout(function(){window.location.href='profile.php'},3000);</script>";
	}
}


?>

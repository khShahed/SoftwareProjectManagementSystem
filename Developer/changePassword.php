<?php
session_start();
require "../dbQuery.php";
if($_SESSION['usertype']!=3){
	header("Location: ../index.php");
	exit();
}
$cp = $_REQUEST['currentPassword'];
$np = $_REQUEST['newPassword'];
$rp = $_REQUEST['retypePassword'];
if(strlen($np)<6){
	echo "<h1 style=\" color:red\">Password is too short!</h1>";
}
elseif($np != $rp){
	echo "<h1 style=\" color:red\">New password and confirm password must be same.</h1>";
}
else{
	
	$query = "update user set password = '".addslashes($np)."' where id='".$_SESSION['id']."' and password='".addslashes($cp)."';";
	$rowsAffected = getDBData($query);
	if($rowsAffected>0){
        echo "<h1 style=\" color:green\">Password changed successfully!</h1>";
    }
    else{
        echo "<h1 style=\" color:red\">Unknown error occured!</h1>";
    } 
	echo "<script>setTimeout(function(){window.location.href='profile.php'},2000);</script>";
}

?>

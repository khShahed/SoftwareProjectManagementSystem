<?php
session_start();
require "../dbQuery.php";
if($_SESSION['usertype']!=2){
	header("Location: ../index.php");
	exit();
}
$query = "select count(*) from user where password = '".$_REQUEST['password']."' and id =".$_SESSION['id'].";";
$result = getDBData($query);
if($result==0)
	echo "Incorrect password!";
else
	echo "password mached!";
?>

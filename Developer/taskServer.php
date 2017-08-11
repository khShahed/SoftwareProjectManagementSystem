<?php
session_start();
require "../dbQuery.php";
if($_SESSION['usertype']!=3){
	header("Location: ../index.php");
	exit();
}

if(isset($_REQUEST['start'])){
	$sql = "UPDATE task set status = 3 WHERE id = ".$_REQUEST['start'].";";
	$result = json_decode(getDBData($sql), true);
	header("location:index.php");
	exit();
}
elseif(isset($_REQUEST['complete'])){
	$sql = "UPDATE task set status = 4 WHERE id = ".$_REQUEST['complete'].";";
	$result = json_decode(getDBData($sql), true);
	header("location:index.php");
	exit();
}
?>

<?php
session_start();
require "../dbQuery.php";
if($_SESSION['usertype']!=1){
	header("Location: ../index.php");
	exit();
}
$projname = $_REQUEST['pName'];
$desc = $_REQUEST['desc'];
$startdate = $_REQUEST['startDate'];
$enddate = $_REQUEST['endDate'];
$manager = $_REQUEST['projManager'];
$priority = $_REQUEST['priority'];
$status = $_REQUEST['status'];

$okFlag=0;

if(is_null($projname)||is_null($desc)||is_null($startdate)||is_null($enddate)||is_null($manager)||is_null($priority)||is_null($status)){
	 echo "<h1 style=\" color:red\">Can't create project!</h1>";
	echo "<script>setTimeout(function(){window.location.href='index.php'},2000);</script>";
	$okFlag = 1;
}

$query = "";

if($okFlag == 0){
	
	$query = "insert into project values(null,'".$projname."','".$desc."','".$startdate."','".$enddate."','".$manager."','".$priority."','".$status."');";
	$result = getDBData($query);
	if($result >0){
		echo "<h1 style=\" color:green\">Successfully created project!</h1>";
	}
	else{
		echo "<h1 style=\" color:red\">Unknown Error!</h1>";
	}
	echo "<script>setTimeout(function(){window.location.href='index.php'},2000);</script>";
}

?>

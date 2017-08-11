<?php
session_start();
require "../dbQuery.php";
if($_SESSION['usertype']!=3){
	header("Location: ../index.php");
	exit();
}
$name = $_REQUEST['name'];
$dob = $_REQUEST['dob'];
$sql = "update user set name='".$name."',dob='".$dob."' where id = '".$_SESSION['id']."';";
$rowsAffected = getDBData($sql);
if($rowsAffected>0){
        echo "<h1 style=\" color:green\">Profile Updated Successfully!</h1>";
    }
    else{
        echo "<h1 style=\" color:red\">Operation Failed!</h1>";
    } 
echo "<script>setTimeout(function(){window.location.href='profile.php'},2000);</script>";
?>

<?php
session_start();
require "../dbQuery.php";
if($_SESSION['usertype']!=3){
	header("Location: ../index.php");
	exit();
}
$time =  date("Y-m-d h:i:s");
$query = "insert into forum values(null,'".$_REQUEST['topic']."','".$_REQUEST['description']."',null,'".$_SESSION['id']."','".$time."');";
$rowsAffected = getDBData($query);
if($rowsAffected>0){
        echo "<h1 style=\" color:green\">Posted Successfully!</h1>";
    }
    else{
        echo "<h1 style=\" color:red\">Posting Failed!</h1>";
    } 
echo "<script>setTimeout(function(){window.location.href='forum.php'},2000);</script>";
?>

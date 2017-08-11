<?php
session_start();
require "../dbQuery.php";
if($_SESSION['usertype']!=1){
	header("Location: ../index.php");
	exit();
}
$time =  date("Y-m-d h:i:s");
$comment = $_REQUEST['comment'];
$query = "insert into forumcomment values(null,'".$comment."','".$_SESSION['post']."','".$_SESSION['id']."','".$time."');";
$rowsAffected = getDBData($query);
if($rowsAffected>0){
        echo "<h1 style=\" color:green\">Comment posted Successfully!</h1>";
    }
    else{
        echo "<h1 style=\" color:red\">Unknown Error!</h1>";
    } 
echo "<script>setTimeout(function(){window.location.href='forumComment.php?post=".$_SESSION['post']."'},2000);</script>";
?>

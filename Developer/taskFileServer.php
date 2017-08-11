<?php
session_start();
require "../dbQuery.php";
if($_SESSION['usertype']!=3){
	header("Location: ../index.php");
	exit();
}

$target_dir = "../file/task/";
$target_file = $target_dir .$_SESSION['task']. $_FILES["file"]["name"];
$realDir = "file/task/".time(). $_FILES["file"]["name"];
if(move_uploaded_file($_FILES["file"]["tmp_name"], $target_file)) {
    $sql = "update task set file = '".$realDir."', status = 4 where id = ". $_SESSION['task'].";";
    $rowsAffected = getDBData($sql);
    if($rowsAffected>0){
        echo "<h1 style=\" color:green\">FIle Uploaded Succefully!</h1>";
    }
    else{
        echo "<h1 style=\" color:red\">FIle Upload Failed!</h1>";
    } 
}
else { 
    echo "<h1 style=\" color:red\">FIle Upload Failed!</h1>";
} 
echo "<script>setTimeout(function(){window.location.href='index.php'},2000);</script>";

?>

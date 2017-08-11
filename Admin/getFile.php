<?php
	$temp = explode("@", $_GET['file']);
	
	$file = $temp[0];
	$type = $temp[1];
	$size = $temp[2];

	if(file_exists(''.$file))
	{
		header("Content-Length: ".$size);
		header("Content-Type: ".$type);
		$name = explode("/", $file);
		header("Content-Disposition: attachment; filename=\"" . $name[sizeof($name)-1] . "\"");
		
		readfile($file);
	}
?>
<?php
	// Retrieve the custom part properties depending on type
	require 'dbAccess.php';
	// get the parameters from URL
	/* xmlhttp.open("POST", "savePart.php?name=" + name + ";type=" + partTypeVal + 
	    	";img=" + imgFile + ";desc=" + desc, true); */
	$name = $_REQUEST["name"];
	$type = $_REQUEST["type"];
	$img = $_REQUEST["img"];
	$desc = $_REQUEST["desc"];
	$result = "";
	$partId = addPart($name, $desc, $img, $type);
	if($partId == -1)
	{
		$result = 'Failed to add part: ' . $name;
	}
	else
	{
		$result = 'Added new part: ' . $name . ' with ID: ' . $partId;
	}
	echo $result;
?>

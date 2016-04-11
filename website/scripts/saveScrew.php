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
	$diameter = $_REQUEST["diam"];
	$partLen = $_REQUEST["len"];
	$head = $_REQUEST["head"];
	$tip = $_REQUEST["tip"];
	$drive = $_REQUEST["drive"];
	$iso = $_REQUEST["iso"];
	$uts = $_REQUEST["uts"];
	$diamUnit = $_REQUEST["diamUnit"];
	$lenUnit = $_REQUEST["lenUnit"];


	$result = "";
	$partId = addPart($name, $desc, $img, $type);
	if($partId == -1)
	{
		$result = 'Failed to add part: ' . $name;
	}
	else
	{
		addScrew($partId, $diameter, $partLen, $head, 
		$tip, $drive, $iso, $uts, $diamUnit, $lenUnit);
		$result = 'Added new screw: ' . $name . ' with ID: ' . $partId;
	}
	echo $result;
?>

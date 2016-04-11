<?php
	// Retrieve the custom part properties depending on type
	require 'generateParts.php';
	// get the parameters from URL
	/* xmlhttp.open("POST", "savePart.php?name=" + name + ";type=" + partTypeVal + 
	    	";img=" + imgFile + ";desc=" + desc, true); */
	$name = $_REQUEST["name"];
	$type = $_REQUEST["type"];
	$img = $_REQUEST["img"];
	$head = $_REQUEST["head"];


	$result = "";
	$partId = buildBolts($name, $head, $type, $img);
	if($partId == -1)
	{
		$result = 'Failed to add bolts: ' . $name;
	}
	else
	{
		$result = 'Successfully added bolts';
	}
	echo $result;
?>

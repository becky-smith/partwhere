<?php
	// select part type - may need to drill down levels
	require 'getImageCard.php';
	// get the id parameter from URL
	$parent = $_REQUEST["id"];
	$method = $_REQUEST["method"];
	if($method == "getPartTypes")
	{
		$result = getPartTypeImageCards($parent);
	}
	echo $result;

?>

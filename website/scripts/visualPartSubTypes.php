<?php
	// select part type - may need to drill down levels
	require 'getImageButtons.php';
	// get the id parameter from URL
	$parent = $_REQUEST["id"];
	$result = getPartTypeImageButtons($parent);
	echo $result;
?>

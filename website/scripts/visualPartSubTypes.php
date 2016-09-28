<?php
	// select part type - may need to drill down levels
	require_once 'getImageButtons.php';
	// get the id parameter from URL
	$parent = $_REQUEST["id"];
	$result = getPartTypeImageCards($parent);
	echo $result;
?>

<?php
	// select part type - may need to drill down levels
	require_once 'dbAccess.php';
	// get the id parameter from URL
	$diameter = $_REQUEST["diam"];
	$unit = $_REQUEST["unit"];
	$result = -1;
	$thread = getTypeForDiameter(floatval($diameter), intval($unit));
	$count = count($thread);
	if($count > 0)
	{
		// only use the first match
		$row = $thread[0];
		$result = $row['Thread'];
	}
	echo $result;
?>

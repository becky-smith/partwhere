<?php
	// select part type - may need to drill down levels
	require_once 'dbAccess.php';
	// get the id parameter from URL
	$length = $_REQUEST["len"];
	$unit = $_REQUEST["unit"];
	$result = -1;
	$lenType = getTypeForLength($length, $unit);
	$count = count($lenType);
	if($count > 0)
	{
		// only use the first match
		$row = $lenType[0];
		$result = $row['LengthTypeId'];
	}
	echo $result;
?>

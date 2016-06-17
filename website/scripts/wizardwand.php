<?php
	// select part type - may need to drill down levels
	require 'dbAccess.php';
	require 'getImageCard.php';
	// get the id parameter from URL
	$parent = $_REQUEST["id"];
	$method = $_REQUEST["method"];
	if($method == "getPartTypes")
	{
		$result = getPartTypeImageCards($parent);
	}
	echo $result;

	function getPartTypeImageCards($parent = -1)
	{
		$output = '';
		$partTypes = getPartTypes($parent);
		if(count($partTypes) > 0)
		{
			$output .= '<div class="row">';
			foreach($partTypes as $row)
			{
				$cmd = 'partTypeSelected(' . $row['PartTypeId'] .', \'' .$row['Name']. '\', \'' .$row['ImageFile']. '\')';
				$output .= getImageCard($row['ImageFile'], $row['Name'], "help text goes here", $row['PartTypeId'], $cmd);
			}
			$output .= '</div>';
		}
		return $output;
	}

	function getPartCatImageCards()
	{
		$output = '';
		$partTypes = getPartTypes(-1);
		if(count($partTypes) > 0)
		{
			$output .= '<div class="row">';
			foreach($partTypes as $row)
			{
				$cmd = 'partCategorySelected(' . $row['PartTypeId'] .', \'' .$row['Name']. '\', \'' .$row['ImageFile']. '\')';
				$output .= getImageCard($row['ImageFile'], $row['Name'], "help text goes here", $row['PartTypeId'], $cmd);
			}
			$output .= '</div>';
		}
		return $output;
	}
?>

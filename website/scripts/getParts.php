<?php
	// select part type - may need to drill down levels
	require 'dbAccess.php';
	// get the id parameter from URL
	$parent = $_REQUEST["id"];
	$parts = getParts($parent);
	$result = '<div class="row">';
	$result .= '<div class="col s12">';
	$partsCount = count($parts);
	if($partsCount > 0)
	{
		$result .= '<span>Found ' .$partsCount. ' parts</span>';
		$result .= '</div>';
		$result .= '</div>';
		$result .= '<div class="row">';
		$result .= '<div class="col s12">';
		
		// this part type has parts
		// create a table to display the parts
		$result .= '<table>';
    $result .= '<thead>';
		$result .= '<tr>';
		$result .= '<th data-field="name">Name</th>';
		$result .= '<th data-field="desc">Description</th>';
		$result .= '<th data-field="img">Image</th>';
		$result .= '</tr>';
		$result .= '</thead>';
		$result .= '<tbody>';
		foreach($parts as $row)
		{
			$result .= '<tr>';
			$result .= '<td>' . $row['Name'] . '</td>';
			$result .= '<td>' . $row['Description'] . '</td>';
			$result .= '<td>';
			$imgFile = $row['ImageFile'];
			if($imgFile != null && strlen($imgFile) > 0)
			{
				// display image?
				$result .= '<img src =../img/' . $imgFile . '>';
			}
			
			$result .= '</td></tr>';
		}
		$result .= '</tbody>';
		$result .= '</table>';
	}
	else
	{
		$result .= 'No Parts found';
	}
	$result .= '</div>';
	$result .= '</div>';
	echo $result;
?>

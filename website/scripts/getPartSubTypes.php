<?php
	// select part type - may need to drill down levels
	require 'dbAccess.php';
	// get the id parameter from URL
	$parent = $_REQUEST["id"];
	$partTypes = getPartTypes($parent);
	$result = '';
	if(count($partTypes) > 0)
	{
		// this part type has subtypes
		$result .= '<div class="row">';
		$result .= '<div class="col 16 s12">';
		$result .= '<div class="col 16 s2">Part Sub Type</div>';
		$result .= '<div class="col 16 s3">';
		$result .= '<select name="PartSubType" class="black-text" onchange="subPartTypeChanged(this)">';
		$result .= '<option value=-1>Select a Part SubType</option>';
		foreach($partTypes as $row)
		{
			$result .= '<option value=' . $row['PartTypeId'] . '>' . $row['Name'] . '</option>';
		}
		$result .= '</select>'; 
		$result .= '</div>';

	}
	else
	{
		// no subtypes - get a list of parts
		$parts = getParts($parent);
		$result .= '<div class="row">';
		$result .= '<div class="col 16 s12">';
		if(count($parts) > 0)
		{
			// this part type has parts
			// create a table to display the parts
			$result .= '<table>';
      $result .= '<thead>';
			$result .= '<tr>';
			$result .= '<th data-field="name">Name</th>';
			$result .= '<th data-field="img">Image</th>';
			$result .= '</tr>';
			$result .= '</thead>';
			$result .= '<tbody>';
			foreach($parts as $row)
			{
				$result .= '<tr>';
				$result .= '<td>' . $row['Name'] . '</td>';
				$imgFile = $row['ImageFile'];
				if($imgFile != null && strlen($imgFile) > 0)
				{
					// display image?
					$result .= '<td><img src =img/' . $imgFile . '></td>';
				}
				$result .= '</tr>';
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
	}
	echo $result;
?>

<?php
	require_once 'dbAccess.php';
	// select part type - may need to drill down levels
	function getPartTypeImageList($parent = -1)
	{
		$output = '';
		$partTypes = getPartTypes($parent);
		if(count($partTypes) > 0)
		{
			$output .= '<ul class="collapsible avatar" data-collapsible="expandable">';
			foreach($partTypes as $row)
			{
				$cmd = 'partTypeSelected(' . $row['PartTypeId'] .', \'' .$row['Name']. '\', \'' .$row['ImageFile']. '\')';
				$output .= getImageListItem($row['ImageFile'], $row['Name'], "help text goes here", $row['PartTypeId'], $cmd);
			}
			$output .= '</ul>';
		}
		return $output;
	}

	function getGradeImageList()
	{
		$output = '';
		$gradeTypes = getGrades();
		if(count($gradeTypes) > 0)
		{
			$output .= '<ul class="collapsible" data-collapsible="expandable">';
			foreach($gradeTypes as $row)
			{				
				$cmd = 'gradeSelected(' . $row['GradeId'] .', \'' .$row['Name']. '\', \'' .$row['Image']. '\')';
				$output .= getImageListItem($row['Image'], $row['Name'], "Other names:" +  $row['AlternateName'], $row['GradeId'], $cmd);
			}
			$output .= '</ul>';
		}
		return $output;
	}

	function getMaterialImageList()
	{
		$output = '';
		$materials = getMaterials();
		if(count($materials) > 0)
		{
			$output .= '<ul class="collapsible" data-collapsible="expandable">';
			foreach($materials as $row)
			{
				$cmd = 'materialSelected(' . $row['MaterialTypeId'] .', \'' .$row['Name']. '\', \'' .$row['Image']. '\')';
				$output .= getImageListItem($row['Image'], $row['Name'], $row['Description'], $row['MaterialTypeId'], $cmd);
			}
			$output .= '</ul>';
		}
		return $output;
	}

	function getFinishImageList()
	{
		$output = '';
		$finishes = getFinishes();
		if(count($finishes) > 0)
		{
			$output .= '<ul class="collapsible" data-collapsible="expandable">';
			foreach($finishes as $row)
			{				
				$cmd = 'finishSelected(' . $row['MaterialTypeId'] .', \'' .$row['Name']. '\', \'' .$row['Image']. '\')';
				$output .= getImageListItem($row['Image'], $row['Name'], $row['Description'], $row['MaterialTypeId'], $cmd);
			}
			$output .= '</ul>';
		}
		return $output;
	}

	function getImageListItem($image, $text, $details, $id, $eventHandler)
	{
		if(strlen($image) == 0)
		{
			$image = 'comingSoon.png';
		}
		$output = '<li>';
    $output .= '<div class="collapsible-header">';
    $output .= '<img height="50"src="img/' . $image . '" style="margin-right:10px">' . $text;
    $output .= '<a class="btn-floating waves-effect waves-teal pull-right" onclick="';
    $output .= $eventHandler . '"><i class="material-icons">play_arrow</i></a>';
    $output .= '</div>';
    $output .= '<div class="collapsible-body"><p>'. $details . '</p></div>';
		$output .= '</li>';
		return $output;
	}
?>
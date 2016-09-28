<?php
	require_once 'dbAccess.php';
	// select part type - may need to drill down levels
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

	function getGradeImageCards()
	{
		$output = '';
		$gradeTypes = getGrades();
		if(count($gradeTypes) > 0)
		{
			$output .= '<div class="row">';
			foreach($gradeTypes as $row)
			{				
				$cmd = 'gradeSelected(' . $row['GradeId'] .', \'' .$row['Name']. '\', \'' .$row['Image']. '\')';
				$output .= getImageCard($row['Image'], $row['Name'], "Other names:" +  $row['AlternateName'], $row['GradeId'], $cmd);
			}
			$output .= '</div>';
		}
		return $output;
	}

	function getMaterialImageCards()
	{
		$output = '';
		$materials = getMaterials();
		if(count($materials) > 0)
		{
			$output .= '<div class="row">';
			foreach($materials as $row)
			{
				$cmd = 'materialSelected(' . $row['MaterialTypeId'] .', \'' .$row['Name']. '\', \'' .$row['Image']. '\')';
				$output .= getImageCard($row['Image'], $row['Name'], $row['Description'], $row['MaterialTypeId'], $cmd);
			}
			$output .= '</div>';
		}
		return $output;
	}

	function getFinishImageCards()
	{
		$output = '';
		$finishes = getFinishes();
		if(count($finishes) > 0)
		{
			$output .= '<div class="row">';
			foreach($finishes as $row)
			{				
				$cmd = 'finishSelected(' . $row['MaterialTypeId'] .', \'' .$row['Name']. '\', \'' .$row['Image']. '\')';
				$output .= getImageCard($row['Image'], $row['Name'], $row['Description'], $row['MaterialTypeId'], $cmd);
			}
			$output .= '</div>';
		}
		return $output;
	}

	function getImageCard($image, $text, $details, $id, $eventHandler)
	{
		if(strlen($image) == 0)
		{
			$image = 'comingSoon.png';
		}
		$output = '<div class="col s6 m3 l2">';
		$output .= '<div class="card small">';
		$output .= '<div class="card-image">';
    $output .= '<img class="activator" src="img/' . $image . '">';
		$output .= '</div>';
		$output .= '<div class="card-content">' . $text . '</div>';
		$output .= '<div class="card-reveal">';
		$output .= '<span class="card-title grey-text text-darken-4">' . $text . '<i class="material-icons right">close</i></span>';
		$output .= '<p>'. $details .'</p>';
		$output .= '</div>';
    $output .= '<div class="card-action">';
    $output .= '<a class="btn-floating waves-effect waves-teal" onclick="';
    $output .= $eventHandler . '"><i class="small material-icons">play_arrow</i></a>';
		$output .= '</div>';
		$output .= '</div>';
		$output .= '</div>';
		return $output;
	}
?>

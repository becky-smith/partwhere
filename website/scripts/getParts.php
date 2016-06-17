<?php
	// select part type - may need to drill down levels
	require 'dbAccess.php';
	// get the id parameter from URL
	$parent = $_REQUEST["id"];
	$headType = -1;
	$lengthType = -1;
	$utsType = -1;
	$isoType = -1;
	$tipType = -1;
	$driveType = -1;
	$gradeType = -1;

	if (array_key_exists("len",$_REQUEST))
	{
		$headType = $_REQUEST["head"];
	}

	if (array_key_exists("head",$_REQUEST))
	{
		$headType = $_REQUEST["head"];
	}
	if (array_key_exists("drive",$_REQUEST))
	{
		$driveType = $_REQUEST["drive"];
	}
	if (array_key_exists("len",$_REQUEST))
	{
		$lengthType = $_REQUEST["len"];
	}
	if (array_key_exists("uts",$_REQUEST))
	{
		$utsType = $_REQUEST["uts"];
	}
	if (array_key_exists("iso",$_REQUEST))
	{
		$isoType = $_REQUEST["iso"];
	}
	if (array_key_exists("tip",$_REQUEST))
	{
		$tipType = $_REQUEST["tip"];
	}
	if (array_key_exists("grade",$_REQUEST))
	{
		$gradeType = $_REQUEST["grade"];
	}
	
//	echo  'partType ' .  $parent . 'head ' .  $headType . ' tip ' .  $tipType  . ' drive ' .  $driveType  . ' length ' .  $lengthType  . ' iso ' .  $isoType . ' uts ' .  $utsType  . ' grade ' .   $gradeType . '<br>';
	// make sure at least one filter is specified...
	$result = '<div class="row">';
	$partsCount = 0;
	$parts = "";
	if(	$parent > -1 || 
			$headType > -1 || 
			$lengthType > -1 || 
			$utsType > -1 || 
			$isoType > -1 || 
			$tipType > -1 || 
			$driveType > -1 || 
			$gradeType > -1)
	{
		$parts = getParts($parent, $headType, $tipType, $driveType, $lengthType, $isoType, $utsType, $gradeType);
		$partsCount = count($parts);
		if($partsCount > 0)
		{
			$result .= '<span><strong>Found ' .$partsCount. ' parts</strong></span>';
			$result .= '</div>';
			$result .= '<div class="row">';
			// this part type has parts
			// create a table to display the parts
			$result .= '<table class="highlight">';
	    $result .= '<thead>';
			$result .= '<tr>';
			$result .= '<th data-field="img">Image</th>';
			$result .= '<th data-field="name">Name</th>';
			$result .= '</tr>';
			$result .= '</thead>';
			$result .= '<tbody>';
			foreach($parts as $row)
			{
				$result .= '<tr>';
				$result .= '<td>';
				$imgFile = $row['ImageFile'];
				if($imgFile != null && strlen($imgFile) > 0)
				{
					// display image?
					$result .= '<img src =img/' . $imgFile . '>';
				}
				else
				{
					$result .= 'Image coming soon';
				}
				$result .= '</td>';
				$result .= '<td>' . $row['Name'] . '</td>';
				$result .= '</tr>';
			}
			$result .= '</tbody>';
			$result .= '</table>';
		}
		else
		{
			$result .= '<strong>No Parts found</strong>';
		}
	}
	else
	{
		$result .= '<strong>Please specify at least one filter</strong>';
	}
	$result .= '</div>';
	echo $result;
?>

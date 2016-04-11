<?php
	// select part type - may need to drill down levels
	require 'dbAccess.php';
	function getPartTypeImageButtons($parent = -1)
	{
		$output = '';
		$partTypes = getPartTypes($parent);
		if(count($partTypes) > 0)
		{
			// up to 4 images in a row...
			$columnCt = 0;
			$output .= '<div class="row">';
			$output .= '<div class="col s12">';
			foreach($partTypes as $row)
			{
				if($columnCt >= 4)
				{
					// start a new row...
					$output .= '</div>';
					$output .= '</div>';
					$output .= '<div class="row">';
					$output .= '<div class="col s12">';
					$columnCt = 0;
				}
				$output .= '<div class="col s3 tooltipped" data-position="bottom" data-delay="50" data-tooltip="' . $row['Name'] . '">';
				$output .= '<img src=../img/' . $row['ImageFile'] . ' alt="' . $row['Name'] . '" onclick=partTypeSelected(' . $row['PartTypeId'] .')>';
				$output .= '</div>';
				$columnCt++;
			}
			$output .= '</div>';
			$output .= '</div>';
		}
		return $output;
	}
?>

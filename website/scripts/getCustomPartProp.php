<?php
	// Retrieve the custom part properties depending on type
	require 'dbAccess.php';
/*
	// get the id parameter from URL
	$type = $_REQUEST["type"];
	$result = "";
	switch(strtoupper($type))
	{
		case 'SCREW':
		{
			$result = getScrewProps();
			break;
		}
		case 'NUT':
		{
			$result = getNutProps();
			break;
		}
		case 'BOLT':
		{
			$result = getBoltProps();
			break;
		}
		case 'WASHER':
		{
			$result = getWasherProps();
			break;
		}
		default:
		{
			break;
		}
	}
	echo $result;
	*/

	function getNutProps()
	{
		$custom = '';
		return $custom;
	}

	function getBoltProps()
	{
		$custom = '';
		return $custom;
	}

	function getWasherProps()
	{
		$custom = '';
		return $custom;
	}
	
	function buildHeadTypeSelect()
	{
		$custom = '';
		$types = getHeadTypes();
		if(count($types) > 0)
		{
			$custom = '<select name="headType" id="headType" class="black-text">';
			$custom .= '<option value=-1>Select a Head Type</option>';
			foreach($types as $row)
			{
				$custom .= '<option value=' . $row['HeadTypeId'] . '>';
				$custom .= $row['Name'];
				if($row['AlternateName'] != null)
				{
					$custom .= ' (' . $row['AlternateName'] . ')';
				}
				$custom .= '</option>';
			}
			$custom .= '</select>';
		}
		return $custom;
	}

	function buildTipTypeSelect()
	{
		$custom = '';
		$types = getTipTypes();
		if(count($types) > 0)
		{
			$custom = '<select name="tipType" id="tipType" class="black-text">';
			$custom .= '<option value=-1>Select a Tip Type</option>';
			foreach($types as $row)
			{
				$custom .= '<option value=' . $row['TipTypeId'] . '>' . $row['Name'];
				$custom .= '</option>';
			}
			$custom .= '</select>';
		}
		return $custom;
	}

	function buildDriveTypeSelect()
	{
		$custom = '';
		$types = getDriveTypes();
		if(count($types) > 0)
		{
			$custom = '<select name="driveType" id="driveType" class="black-text">';
			$custom .= '<option value=-1>Select a Drive Type</option>';
			foreach($types as $row)
			{
				$custom .= '<option value=' . $row['DriveTypeId'] . '>' . $row['Name'];
				if($row['Abbreviation'] != null)
				{
					$custom .= ' (' . $row['Abbreviation'] . ')';
				}
				if($row['AlternateName'] != null)
				{
					$custom .= ' (' . $row['AlternateName'] . ')';
				}
				$custom .= '</option>';
			}
			$custom .= '</select>';
		}
		return $custom;
	}

	function buildISOThreadSelect()
	{
		$custom = '';
		$types = getISOThreadTypes();
		if(count($types) > 0)
		{
			$custom = '<select name="isoThread" id="isoThread" class="black-text">';
			$custom .= '<option value=-1>Select an ISO Standard</option>';
			foreach($types as $row)
			{
				$custom .= '<option value=' . $row['ISOId'] . '>' . $row['Name'];
				if($row['Abbreviation'] != null)
				{
					$custom .= ' (' . $row['Abbreviation'] . ')';
				}
				$custom .= '</option>';
			}
			$custom .= '</select>';
		}
		return $custom;
	}

	function buildUTSThreadSelect()
	{
		$custom = '';
		$types = getUTSThreadTypes();
		if(count($types) > 0)
		{
			$custom = '<select name="utsThread" id="utsThread" class="black-text">';
			$custom .= '<option value=-1>Select a UTS Standard</option>';
			foreach($types as $row)
			{
				$custom .= '<option value=' . $row['UTSId'] . '>' . $row['Name'];
				if($row['Abbreviation'] != null)
				{
					$custom .= ' (' . $row['Abbreviation'] . ')';
				}
				$custom .= '</option>';
			}
			$custom .= '</select>';
		}
		return $custom;
	}

	function buildUnitsSelect($name)
	{
		$custom = '';
		$types = getUnits();
		if(count($types) > 0)
		{
			$custom = '<select name="' . $name . '"  id="' . $name . '"class="black-text">';
			$custom .= '<option value=-1>Select a Unit</option>';
			foreach($types as $row)
			{
				$custom .= '<option value=' . $row['UnitId'] . '>' . $row['Name'];
				$custom .= '</option>';
			}
			$custom .= '</select>';
		}
		return $custom;
	}
	
	/*
	if(count($partTypes) > 0)
	{
		// this part type has subtypes
		echo '<div class="row">';
		echo '<div class="col 16 s12">';
		echo '<div class="col 16 s2">Part Sub Type</div>';
		echo '<div class="col 16 s3">';
		echo '<select name="PartSubType" class="black-text" onchange="subPartTypeChanged(this)">';
		echo '<option value=-1>Select a Part SubType</option>';
		foreach($partTypes as $row)
		{
			echo '<option value=' . $row['PartTypeId'] . '>' . $row['Name'] . '</option>';
		}
		echo '</select>'; 
		echo '</div>';

	}
	else
	{
		// no subtypes - get a list of parts
		$parts = getParts($parent);
		if(count($parts) > 0)
		{
			// this part type has parts
			echo '<div class="row">';
			echo '<ul>';
			foreach($parts as $row)
			{
				echo '<li>' . $row['Name'] . '</li>';
			}
			echo '</ul>'; 
			echo '</div>';
		}
		else
		{
			echo '<div class="row">';
			echo 'No Parts found';
			echo '</div>';
		}
	}
	*/
?>

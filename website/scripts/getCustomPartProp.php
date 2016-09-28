<?php
	// Retrieve the custom part properties depending on type
	require_once 'dbAccess.php';

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
	
	function buildHeadTypeSelect($onchange = '', $multi = false)
	{
		$custom = '';
		$types = getHeadTypes();
		$custom .= '<select name="headType" id="headType" class="black-text icons"';
		if($onchange != '')
		{
			$custom .= ' onchange="' . $onchange . '"';
		}
		if($multi === true)
		{
			$custom .= ' multiple';
		}
		$custom .= '>';
		$custom .= '<option value=-1>Select a Head Type</option>';
		$custom .= '<option value=-1>Headless</option>';
		foreach($types as $row)
		{
			$custom .= '<option value=' . $row['HeadTypeId'];
			$imgFile = $row['Image'];
			if($imgFile == null || strlen($imgFile) == 0)
			{
				$imgFile = 'comingSoon.png';
			}
			// display image
			$custom .= ' data-icon="img/' . $imgFile . '" class="left"';
			$custom .= '>';
			$custom .= $row['Name'];
			if($row['AlternateName'] != null)
			{
				$custom .= ' (' . $row['AlternateName'] . ')';
			}
			$custom .= '</option>';
		}
		$custom .= '</select>';
		return $custom;
	}

	function buildTipTypeSelect($onchange = '', $multi = false)
	{
		$custom = '';
		$types = getTipTypes();
		$custom = '<select name="tipType" id="tipType" class="black-text icons"';
		if($onchange != '')
		{
			$custom .= ' onchange="' . $onchange . '"';
		}
		if($multi === true)
		{
			$custom .= ' multiple';
		}
		$custom .= '>';
		$custom .= '<option value=-1>Select a Tip Type</option>';
		foreach($types as $row)
		{
			$custom .= '<option value=' . $row['TipTypeId'];
			$imgFile = $row['Image'];
			if($imgFile == null || strlen($imgFile) == 0)
			{
				$imgFile = 'comingSoon.png';
			}
			// display image
			$custom .= ' data-icon="img/' . $imgFile . '" class="left"';
			$custom .= '>';
			$custom .= $row['Name'] . '</option>';
		}
		$custom .= '</select>';
		return $custom;
	}

	function buildDriveTypeSelect($onchange = '', $multi = false)
	{
		$custom = '';
		$types = getDriveTypes();
		$custom = '<select name="driveType" id="driveType" class="black-text icons"';
		if($onchange != '')
		{
			$custom .= ' onchange="' . $onchange . '"';
		}
		if($multi === true)
		{
			$custom .= ' multiple';
		}
		$custom .= '>';
		$custom .= '<option value=-1>Select a Drive Type</option>';
		foreach($types as $row)
		{
			$custom .= '<option value=' . $row['DriveTypeId'];
			$imgFile = $row['Image'];
			if($imgFile == null || strlen($imgFile) == 0)
			{
				$imgFile = 'comingSoon.png';
			}
			// display image
			$custom .= ' data-icon="img/' . $imgFile . '" class="left">' . $row['Name'];
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
		return $custom;
	}

	function buildISOThreadSelect($onchange = '', $multi = false)
	{
		$custom = '';
		$types = getISOThreadTypes();
		$custom = '<select name="isoThread" id="isoThread" class="black-text"';
		if($onchange != '')
		{
			$custom .= ' onchange="' . $onchange . '"';
		}
		if($multi === true)
		{
			$custom .= ' multiple';
		}
		$custom .= '>';
		$custom .= '<option value=-1>Select an ISO Standard</option>';
		foreach($types as $row)
		{
			$custom .= '<option value=' . $row['ISOId'] . '>' . $row['Name'];
			if($row['Abbreviation'] != null)
			{
				$custom .= ' (' . $row['Abbreviation'] . ')';
			}
			if($row['NominalDiameter'] != null)
			{
				$custom .= ' (' . $row['NominalDiameter'] . '")';
			}
			$custom .= '</option>';
		}
		$custom .= '</select>';
		return $custom;
	}

	function buildUTSThreadSelect($onchange = '', $multi = false)
	{
		$custom = '';
		$types = getUTSThreadTypes();
		$custom = '<select name="utsThread" id="utsThread" class="black-text"';
		if($onchange != '')
		{
			$custom .= ' onchange="' . $onchange . '"';
		}
		if($multi === true)
		{
			$custom .= ' multiple';
		}
		$custom .= '>';
		$custom .= '<option value=-1>Select a UTS Standard</option>';
		foreach($types as $row)
		{
			$custom .= '<option value=' . $row['UTSId'] . '>' . $row['Name'];
			if($row['Abbreviation'] != null)
			{
				$custom .= ' (' . $row['Abbreviation'] . ')';
			}
			$custom .= ' (' . $row['NominalDiameterMM'] . ' mm/' . $row['NominalDiameterInch'] . '")';
			$custom .= '</option>';
		}
		$custom .= '</select>';
		return $custom;
	}

	function buildLengthTypeSelect($onchange = '', $multi = false)
	{
		$custom = '';
		$types = getLengthTypes();
		$custom = '<select name="lengthType" id="lengthType" class="black-text"';
		if($onchange != '')
		{
			$custom .= ' onchange="' . $onchange . '"';
		}
		if($multi === true)
		{
			$custom .= ' multiple';
		}
		$custom .= '>';
		$custom .= '<option value=-1>Select a Length</option>';
		foreach($types as $row)
		{
			$custom .= '<option value=' . $row['LengthTypeId'] . '>' . $row['Length'];
			if($row['Name'] != null)
			{
				$custom .= ' ' . $row['Name'];
			}
			$custom .= '</option>';
		}
		$custom .= '</select>';
		return $custom;
	}

	function buildUnitsSelect($onchange = '', $multi = false)
	{
		$custom = '';
		$types = getUnits();
		if(count($types) > 0)
		{
			$custom = '<select name="unitType" id="unitType" class="black-text"';
			if($onchange != '')
			{
				$custom .= ' onchange="' . $onchange . '"';
			}
			if($multi === true)
			{
				$custom .= ' multiple';
			}

			$custom .= '>';
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

	function buildGradeTypeSelect($onchange = '', $multi = false)
	{
		$custom = '';
		$types = getGrades();
		$custom = '<select name="gradeType" id="gradeType" class="black-text"';
		if($onchange != '')
		{
			$custom .= ' onchange="' . $onchange . '"';
		}
		if($multi === true)
		{
			$custom .= ' multiple';
		}
		$custom .= '>';
		$custom .= '<option value=-1>Select a Grade</option>';
		foreach($types as $row)
		{
			$custom .= '<option value=' . $row['GradeId'];
			$imgFile = $row['Image'];
			if($imgFile == null || strlen($imgFile) == 0)
			{
				$imgFile = 'comingSoon.png';
			}
			// display image
			$custom .= ' data-icon="img/' . $imgFile . '" class="left">' . $row['Name'];
			if($row['AlternateName'] != null)
			{
				$custom .= ' (' . $row['AlternateName'] . ')';
			}
			$custom .= '</option>';
		}
		$custom .= '</select>';
		return $custom;
	}


	function buildMaterialTypeSelect($onchange = '', $multi = false)
	{
		$custom = '';
		$types = getMaterials();
		$custom = '<select name="material" id="material" class="black-text"';
		if($onchange != '')
		{
			$custom .= ' onchange="' . $onchange . '"';
		}
		if($multi === true)
		{
			$custom .= ' multiple';
		}
		$custom .= '>';
		$custom .= '<option value=-1>Select a Material: </option>';
		foreach($types as $row)
		{
			$custom .= '<option value=' . $row['MaterialTypeId'];
			$imgFile = $row['Image'];
			if($imgFile == null || strlen($imgFile) == 0)
			{
				$imgFile = 'comingSoon.png';
			}
			// display image
			$custom .= ' data-icon="img/' . $imgFile . '" class="left">' . $row['Name'];
			$custom .= '</option>';
		}
		$custom .= '</select>';
		return $custom;
	}


	function buildFinishTypeSelect($onchange = '', $multi = false)
	{
		$custom = '';
		$types = getFinishes();
		$custom = '<select name="finish" id="finish" class="black-text"';
		if($onchange != '')
		{
			$custom .= ' onchange="' . $onchange . '"';
		}
		if($multi === true)
		{
			$custom .= ' multiple';
		}
		$custom .= '>';
		$custom .= '<option value=-1>Select a Finish</option>';
		foreach($types as $row)
		{
			$custom .= '<option value=' . $row['MaterialTypeId'];
			$imgFile = $row['Image'];
			if($imgFile == null || strlen($imgFile) == 0)
			{
				$imgFile = 'comingSoon.png';
			}
			// display image
			$custom .= ' data-icon="img/' . $imgFile . '" class="left">' . $row['Name'];
			$custom .= '</option>';
		}
		$custom .= '</select>';
		return $custom;
	}
	
?>

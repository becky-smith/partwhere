<!DOCTYPE html>
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1.0, user-scalable=no"/>
    <meta name="theme-color" content="#CCCCCC">
    <title>Filter Parts </title>
    <!-- CSS  -->    
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <link href="css/materialize.min.css" type="text/css" rel="stylesheet">
    <link href="css/font-awesome.min.css" type="text/css" rel="stylesheet">
    <link href="min/custom-min.css" type="text/css" rel="stylesheet" >
<!--		
<link href="http://code.jquery.com/mobile/latest/jquery.mobile.css" rel="stylesheet" type="text/css" /> 
		<script src="http://code.jquery.com/mobile/latest/jquery.mobile.js"></script>-->
		<script src="https://code.jquery.com/jquery-2.1.4.min.js"></script>
</head>
<body id="top" class="scrollspy">
<script type="text/javascript" src="js/materialize.min.js"></script>
<script type="text/javascript" src="js/modernizr.js"></script>
<script src="min/custom-min.js"></script>

<!-- Pre Loader -->
<div id="loader-wrapper">
    <div id="loader"></div>
    <div class="loader-section section-left"></div>
    <div class="loader-section section-right"></div>
</div>

<!--Navigation-->
<?php include("navbar.html") ?>

<div class="row" style="margin-top:10px">
	<div class="col s12">
		<div class="pull-left">
			<h4>Filter Options</h4>
		</div>
		<div class="pull-right">
			<button onclick="location.reload()">Reset Filters</button>
		</div>
	</div>
</div>
	<?php
		require 'getCustomPartProp.php';
	
		$headTypes = buildHeadTypeSelect("chooseHeadType()");
		$tipTypes = buildTipTypeSelect("chooseTipType()");
		$driveTypes = buildDriveTypeSelect("chooseDriveType()");
		$isoTypes = buildISOThreadSelect("chooseISOType()");
		$utsTypes = buildUTSThreadSelect("chooseUTSType()");
		$len = buildLengthTypeSelect("chooseLength()");
		$grade = buildGradeTypeSelect("chooseGradeType()");
		$custom = '';
		$custom .= '<div class="row">';
		$custom .= '<div class="col s3 m4 l2">Length </div>';
		$custom .= '<div class="col s9 m4 l3">' . $len . '</div>';
		$custom .= '<div class="col s3 m4 l2">Tip Type </div>';
		$custom .= '<div class="col s9 m4 l3">' . $tipTypes . '</div>';
		$custom .= '</div>';
		$custom .= '<div class="row">';
		$custom .= '<div class="col s3 m4 l2">Head Type </div>';
		$custom .= '<div class="col s9 m4 l3">' . $headTypes . '</div>';
		$custom .= '<div class="col s3 m4 l2">Drive Type </div>';
		$custom .= '<div class="col s9 m4 l3">' . $driveTypes . '</div>';
		$custom .= '</div>';
		$custom .= '<div class="row">';
		$custom .= '<div class="col s3 m4 l2 tooltipped" data-position="bottom"';
		$custom .= ' data-delay="50" data-tooltip="Format: Thread Name (Diameter)">ISO Standard </div>';
		$custom .= '<div class="col s9 m4 l3">' . $isoTypes . '</div>';
		$custom .= '<div class="col s3 m4 l2 tooltipped" data-position="bottom"';
		$custom .= ' data-delay="50" data-tooltip="Format: Thread Name (Diameter)">UTS Standard </div>';
		$custom .= '<div class="col s9 m4 l3">' . $utsTypes . '</div>';
		$custom .= '</div>';
		echo $custom;
	?>
	<div class="row">
		<div class="col s12 m4 l3">Select Part Type</div>
		<div class="col s12 m4 l4">
			<select name="PartType" id="PartType" class="black-text icons"  onchange="choosePartType()">
			<option value=-1>Select a Part Type</option>
			<?php
				// select part type - may need to drill down levels
				$partTypes = getLeafPartTypes();
				if(count($partTypes) > 0)
				{
					foreach($partTypes as $row)
					{
						echo '<option value=' . $row['PartTypeId'];
						$imgFile = $row['ImageFile'];
						if($imgFile != null && strlen($imgFile) > 0)
						{
							// display image?
							echo ' data-icon="img/' . $imgFile . '" class="left"';
						}
						echo '>' . $row['Name'] . '</option>';
					}
				}
			?>
			</select> 
		</div>
	</div>

<div class="row" id="partSection">
</div>

<!--Footer-->
<?php include("footer.html") ?>

	</body>
</html>


    <!--  Scripts-->
<script type="text/javascript">
  $(document).ready(function(){
	  $('select').material_select();
    $('.tooltipped').tooltip({delay: 50});
	  
  });

	var partType = -1;
	var headType = -1;
	var driveType = -1;
	var lengthType = -1;
	var isoType = -1;
	var utsType = -1;
	var tipType = -1;
	var gradeType = -1;

	function resetFilters()
	{
		headType = -1;
		driveType = -1;
		lengthType = -1;
		isoType = -1;
		utsType = -1;
		tipType = -1;
	  gradeType = -1;
	  location.reload();	
	}
	
	function chooseHeadType()
	{
		var combo = document.getElementById("headType");
		if(combo != null)
		{
			headType = combo.value;
			getParts();
		}
	}
	
	function chooseTipType()
	{
		var combo = document.getElementById("tipType");
		if(combo != null)
		{
			tipType = combo.value;
			getParts();
		}
	}

	function chooseLength()
	{
		var combo = document.getElementById("lengthType");
		if(combo != null)
		{
			lengthType = combo.value;
			getParts();
		}
	}
	
		function chooseDriveType()
	{
		var combo = document.getElementById("driveType");
		if(combo != null)
		{
			driveType = combo.value;
			getParts();
		}
	}
	
	function chooseISOType()
	{
		var combo = document.getElementById("isoThread");
		if(combo != null)
		{
			isoType = combo.value;
			getParts();
		}
	}

	function chooseUTSType()
	{
		var combo = document.getElementById("utsThread");
		if(combo != null)
		{
			utsType = combo.value;
			getParts();
		}
	}

	function chooseGradeType()
	{
		var combo = document.getElementById("gradeType");
		if(combo != null)
		{
			gradeType = combo.value;
			getParts();
		}
	}
	
	function choosePartType()
	{
		var combo = document.getElementById("PartType");
		if(combo != null)
		{
			partType = combo.value;
			getParts();
		}
	}
	
	function getParts()
	{
	    var xmlhttp = new XMLHttpRequest();
	    xmlhttp.onreadystatechange = function() {
	        if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
	        	if(xmlhttp.responseText != "")
	        	{
	            document.getElementById("partSection").innerHTML = xmlhttp.responseText;
	          }
	        }
	    };
	    var page = "getParts.php?id=" + partType;
	    if(headType != -1)
	    {
	    	page += "&head=" + headType;
	    }
	    if(lengthType != -1)
	    {
	    	page += "&len=" + lengthType;
	    }
	    if(isoType != -1)
	    {
	    	page += "&iso=" + isoType;
	    }
	    if(utsType != -1)
	    {
	    	page += "&uts=" + utsType;
	    }
	    if(tipType != -1)
	    {
	    	page += "&tip=" + tipType;
	    }
	    if(driveType != -1)
	    {
	    	page += "&drive=" + driveType;
	    }
	    if(gradeType != -1)
	    {
	    	page += "&grade=" + gradeType;
	    }
	    xmlhttp.open("POST", page, true);
	    xmlhttp.send();
	}

</script>
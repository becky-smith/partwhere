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
    <link href="css/custom-min.css" type="text/css" rel="stylesheet" >
		<script src="https://code.jquery.com/jquery-2.1.4.min.js"></script>
		<link rel="stylesheet" type="text/css" href="DataTables/datatables.min.css"/>
</head>
<body id="top" class="scrollspy">
<script type="text/javascript" src="js/materialize.min.js"></script>
<script type="text/javascript" src="js/modernizr.js"></script>
<script type="text/javascript" src="js/custom-min.js"></script>

<!-- Pre Loader -->
<div id="loader-wrapper">
    <div id="loader"></div>
    <div class="loader-section section-left"></div>
    <div class="loader-section section-right"></div>
</div>

<!--Navigation-->
<?php include("navbar.html") ?>
<div class="container">
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
	<div class="row">
		<?php
			require_once 'getCustomPartProp.php';
			$custom = '	<div class="col s3 m2">Select Part Type</div>';
			$custom .= '<div class="col s9 m4">';
			$custom .= '<select name="PartType" id="PartType" class="black-text icons"  onchange="choosePartType()">';
			$custom .= '<option value=-1>Select a Part Type</option>';
			// select part type - may need to drill down levels
			$partTypes = getLeafPartTypes();
			if(count($partTypes) > 0)
			{
				foreach($partTypes as $row)
				{
					$custom .= '<option value=' . $row['PartTypeId'];
					$imgFile = $row['ImageFile'];
					if($imgFile != null && strlen($imgFile) > 0)
					{
						// display image?
						$custom .= ' data-icon="img/' . $imgFile . '" class="left"';
					}
					$custom .= '>' . $row['Name'] . '</option>';
				}
			}
			$custom .= '</select> ';
			$custom .= '</div>';
		
			$headTypes = buildHeadTypeSelect("chooseHeadType()");
			$tipTypes = buildTipTypeSelect("chooseTipType()");
			$driveTypes = buildDriveTypeSelect("chooseDriveType()");
			$isoTypes = buildISOThreadSelect("chooseISOType()");
			$utsTypes = buildUTSThreadSelect("chooseUTSType()");
			$len = buildLengthTypeSelect("chooseLength()");
			$grade = buildGradeTypeSelect("chooseGradeType()");
			$material = buildMaterialTypeSelect("chooseMaterial()");
			$finish = buildFinishTypeSelect("chooseFinish()");
			$custom .= '<div class="col s3 m2">Tip Type </div>';
			$custom .= '<div class="col s9 m4">' . $tipTypes . '</div>';
			$custom .= '<div class="col s3 m2">Head Type </div>';
			$custom .= '<div class="col s9 m4">' . $headTypes . '</div>';
			$custom .= '<div class="col s3 m2">Drive Type </div>';
			$custom .= '<div class="col s9 m4">' . $driveTypes . '</div>';
			$custom .= '<div class="col s3 m2">Material </div>';
			$custom .= '<div class="col s9 m4">' . $material . '</div>';
			$custom .= '<div class="col s3 m2">Finish </div>';
			$custom .= '<div class="col s9 m4">' . $finish . '</div>';
			$custom .= '<div class="col s3 m2">Grade </div>';
			$custom .= '<div class="col s9 m4">' . $grade . '</div>';
			$custom .= '<div class="col s3 m2">Length </div>';
			$custom .= '<div class="col s9 m4">' . $len . '</div>';
			$custom .= '<div class="col s3 m2 tooltipped" data-position="bottom"';
			$custom .= ' data-delay="50" data-tooltip="Format: Thread Name (Diameter)">ISO Standard </div>';
			$custom .= '<div class="col s9 m4">' . $isoTypes . '</div>';
			$custom .= '<div class="col s3 m2 tooltipped" data-position="bottom"';
			$custom .= ' data-delay="50" data-tooltip="Format: Thread Name (Diameter)">UTS Standard </div>';
			$custom .= '<div class="col s9 m4">' . $utsTypes . '</div>';
			echo $custom;
		?>
	</div>
	
	<div class="row" id="partSection">
	</div>
</div>

<!--Footer-->
<?php include("footer.html") ?>

	</body>
</html>
<script type="text/javascript" src="DataTables/datatables.min.js"></script>

    <!--  Scripts-->
<script type="text/javascript">
  $(document).ready(function(){
    $('.tooltipped').tooltip({delay: 50});
		$('#partsList').DataTable({
				"dom": '<flipt>',
				"pageLength": 25
		});
	  $('select').material_select();
  });

	var partType = -1;
	var headType = -1;
	var driveType = -1;
	var lengthType = -1;
	var isoType = -1;
	var utsType = -1;
	var tipType = -1;
	var gradeType = -1;
	var materialType = -1;
	var finishType = -1;

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
	
	function chooseMaterial()
	{
		var combo = document.getElementById("material");
		if(combo != null)
		{
			materialType = combo.value;
			getParts();
		}
	}
	
	function chooseFinish()
	{
		var combo = document.getElementById("finish");
		if(combo != null)
		{
			finishType = combo.value;
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
	          if (!$.fn.dataTable.isDataTable( '#partsList' ) ) {
						  $(document).ready(function(){
						    $('#partsList').DataTable({
						    	"dom": '<flipt>',
						    	"pageLength": 25
						    	});
							  $('select').material_select();
							});
						}
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
    if(materialType != -1)
    {
    	page += "&material=" + materialType;
    }
    if(finishType != -1)
    {
    	page += "&finish=" + finishType;
    }
    xmlhttp.open("POST", page, true);
    xmlhttp.send();
	}

</script>
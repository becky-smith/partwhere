<!DOCTYPE html>
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1.0, user-scalable=no"/>
    <meta name="theme-color" content="#9966FF">
    <title>Add Bolt </title>
    <!-- CSS  -->
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <link href="css/materialize.min.css" type="text/css" rel="stylesheet">
    <link href="css/font-awesome.min.css" type="text/css" rel="stylesheet">
    <link href="css/custom-min.css" type="text/css" rel="stylesheet" >
		<script src="https://code.jquery.com/jquery-2.1.4.min.js"></script>
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

<?php
require_once 'getCustomPartProp.php';
// define error variables and set to empty values
$nameErr = $partTypeErr = $headErr = $driveErr = $tipErr = $threadErr = "";
// define variables and set to empty values
$name = $desc = $imgFile = "";

?>
<div class="row" style="margin-top:10px">
	<div class="row">
		<div class="col 16 s12">
			<h3>Add a New Bolt</h3>
		</div>
	</div>

	<div class="row">
		<div class="col 16 s12">
			<div class="col 16 s1">Base Name *</div>
			<div class="col 16 s3">
				<input id="partName" name="partName" type="text"/>
			</div>
			<div class="col s2">
				<span class="error" id="nameErr">* </span>
			</div>
	  </div>
	</div>
	<div class="row">
		<div class="col 16 s12">
			<div class="col 16 s2">Image File </div>
			<div class="col 16 s5">					
				<input id="imgFile" type="file"/>
			</div>
	  </div>
	</div>
	
	<?php
		// select part type - may need to drill down levels
		$partTypes = getLeafPartTypes(true);
		$custom = "";
		if(count($partTypes) > 0)
		{
			$custom .= '<div class="row">';
			$custom .= '<div class="col s3 m2">Select Bolt Type: </div>';
			$custom .= '<div class="input-field col s6 m4">';
			$custom .= '<select name="PartType" id="PartType" class="black-text icons">';
			$custom .= '<option value=-1>Select a Part Type</option>';
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
			$custom .= '</select></div>';
			$custom .= '<div class="col s12 m6"><span class="error" id="partTypeErr">* </span></div>';
			$custom .= '</div>';
		}
		$headTypes = buildHeadTypeSelect();
		if($headTypes != '')
		{
			$custom .= '<div class="row">';
			$custom .= '<div class="col s3 m2">Head Type: </div>';
			$custom .= '<div class="input-field col s6 m4">' . $headTypes . '</div>';
			$custom .= '<div class="col s3 m4"><span class="error" id="headErr">* </span></div>';
			$custom .= '</div>';
		}
		echo $custom;
	?>
	<div class="row" >
		<div class="col 16 s12">
			<div class="col s12" id="results">
			</div>
		</div>
	</div>
	<div class="row" >
		<div class="col 16 s12">
			<div class="col s2">
				<span> </span>
			</div>			
			<div class="col s2">
				<span>* - required field</span>
			</div>
		</div>
	</div>
	<div class="row" >
		<div class="col 16 s12">
			<div class="center">
				<button type=button onclick="validateForm()" id="addPart">Add</button>
			</div>
		</div>
	</div>
</div>

<!--Footer-->
<footer class="page-footer default_color scrollspy">
    <div class="footer-copyright default_color">
        <div class="container">
            &copy; <?php echo date("Y") ?> PartWhere, LLC. All rights reserved.
        </div>
    </div>
</footer>

    </body>
</html>


    <!--  Scripts-->
<script type="text/javascript">
	
	$(document).ready(function() {
	  $('select').material_select();
	});

	function validateForm()
	{
		var name = cleanInput(document.getElementById("partName").value);
		var selImgFiles = document.getElementById("imgFile").files;
		var imgFile = "";
		if(selImgFiles.length > 0)
		{
			imgFile = selImgFiles[0].name;
		}
		var partType = document.getElementById("PartType");
		var partTypeVal = partType.options[partType.selectedIndex].value;
		var headType = document.getElementById("headType");
		var headTypeVal = headType.options[headType.selectedIndex].value;

		var errors = false;
		if(name.length == 0)
		{
			// need to set error msg.
			document.getElementById("nameErr").innerText = "* Part Name is required";
			errors = true;
		}
		if(partType.selectedIndex == 0)
		{
			// need to set error msg.
			document.getElementById("partTypeErr").innerText = "* Bolt Type is required";
			errors = true;
		}
		if(headType.selectedIndex == 0)
		{
			// need to set error msg.
			document.getElementById("headErr").innerText = "* Head Type is required";
			errors = true;
		}

		if(!errors)
		{
			document.getElementById("results").innerHTML = "Starting to add bolts. Please wait...";
			
			// valid data - save part
	    var xmlhttp = new XMLHttpRequest();
	    xmlhttp.onreadystatechange = function() {
	        if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
	            document.getElementById("results").innerHTML = xmlhttp.responseText;
	            // reset filters
	            location.reload();
	        }
	    };
	    var post = "saveBolt.php?name=" + name + "&img=" + imgFile + "&type=" + partTypeVal;
	    post +="&head=" + headTypeVal ;
	    
	    xmlhttp.open("POST", post, true);
	    xmlhttp.send();
		}
	}
	
	function cleanInput(inVal)
	{
		var clean = inVal.trim();
		return convert(clean);
		
	}
	function convert(str)
	{
	  str = str.replace(/&/g, "&amp;");
	  str = str.replace(/>/g, "&gt;");
	  str = str.replace(/</g, "&lt;");
	  str = str.replace(/"/g, "&quot;");
	  str = str.replace(/'/g, "&#039;");
	  return str;
	}	
	
</script>

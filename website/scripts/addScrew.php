<!DOCTYPE html>
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1.0, user-scalable=no"/>
    <meta name="theme-color" content="#9966FF">
    <title>Add Screw </title>
    <!-- CSS  -->
    <link href="../min/plugin-min.css" type="text/css" rel="stylesheet">
    <link href="../min/custom-min.css" type="text/css" rel="stylesheet" >
</head>
<body id="top" class="scrollspy">
<!-- Pre Loader -->
<div id="loader-wrapper">
    <div id="loader"></div>
    <div class="loader-section section-left"></div>
    <div class="loader-section section-right"></div>
</div>
<!--Navigation-->

 <div class="navbar-fixed">
    <nav id="nav_f" class="default_color" role="navigation">
        <div class="container">
            <a href="partSearch.php" id="logo-container" class="brand-logo"><img class="center" src="../img/minipartwherelogo.png"></a>
            <div class="nav-wrapper">
                <ul class="right hide-on-med-and-down">
                    <li><a href="partSearch.php">Find Part</a></li>
                    <li><a href="addPart.php">Add Part</a></li>
                    <li><a href="about.html">About Us</a></li>
                </ul>
                <ul id="nav-mobile" class="side-nav">
                    <li><a href="partSearch.php">Find Part</a></li>
                    <li><a href="addPart.php">Add Part</a></li>
                    <li><a href="about.html">About Us</a></li>
                </ul>
		            <a href="#" data-activates="nav-mobile" class="button-collapse"><i class="mdi-navigation-menu"></i></a>
            </div>
        	</div>
        </div>
    </nav>
</div>

<?php
require 'getCustomPartProp.php';
// define error variables and set to empty values
$nameErr = $partTypeErr = $headErr = $driveErr = $tipErr = $threadErr = "";
// define variables and set to empty values
$name = $desc = $imgFile = "";

?>
<div class="row" style="margin-top:10px">
	<div class="row">
		<div class="col 16 s12">
			<h3>Add a New Screw</h3>
		</div>
	</div>

	<div class="row">
		<div class="col 16 s12">
			<div class="col 16 s1">Name</div>
			<div class="col 16 s3">
				<input id="partName" name="partName" type="text"/>
			</div>
			<div class="col s2">
				<span class="error" id="nameErr">* </span>
			</div>
			<div class="col s2">Description </div>
			<div class="col s4">
				<textarea id="desc" name="desc" rows=4></textarea>
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
		$headTypes = buildHeadTypeSelect();
		$tipTypes = buildTipTypeSelect();
		$driveTypes = buildDriveTypeSelect();
		$isoTypes = buildISOThreadSelect();
		$utsTypes = buildUTSThreadSelect();
		$diameterUnits = buildUnitsSelect('diameterUnits');
		$lengthUnits = buildUnitsSelect('lengthUnits');
		
		$custom = '<div class="row">';
		$custom .= '<div class="col 16 s12">';
		$custom .= '<div class="col 16 s2">Diameter </div>';
		$custom .= '<div class="col 16 s3">';
		$custom .= '<input type="text" id="diameter"/>';
		$custom .= '</div>';
		if($diameterUnits != '')
		{
			$custom .= '<div class="col 16 s2">Diameter Units </div>';
			$custom .= '<div class="col 16 s3">';
			$custom .= $diameterUnits;
			$custom .= '</div>';
		}
		$custom .= '</div>';
		$custom .= '<div class="row">';
		$custom .= '<div class="col 16 s12">';
		$custom .= '<div class="col 16 s2">Length </div>';
		$custom .= '<div class="col 16 s3">';
		$custom .= '<input type="text" id="length"/>';
		$custom .= '</div>';
		if($lengthUnits != '')
		{
			$custom .= '<div class="col 16 s2">Length Units </div>';
			$custom .= '<div class="col 16 s3">';
			$custom .= $lengthUnits;
			$custom .= '</div>';
		}
		$custom .= '</div>';
		if($headTypes != '')
		{
			$custom .= '<div class="row">';
			$custom .= '<div class="col 16 s12">';
			$custom .= '<div class="col 16 s2">Head Type </div>';
			$custom .= '<div class="col 16 s3">';
			$custom .= $headTypes;
			$custom .= '</div>';
			$custom .= '<div class="col s2">';
			$custom .= '<span class="error" id="headErr">* </span>';
			$custom .= '</div>';
			$custom .= '</div>';
		}
		if($tipTypes != '')
		{
			$custom .= '<div class="row">';
			$custom .= '<div class="col 16 s12">';
			$custom .= '<div class="col 16 s2">Tip Type </div>';
			$custom .= '<div class="col 16 s3">';
			$custom .= $tipTypes;
			$custom .= '</div>';
			$custom .= '<div class="col s2">';
			$custom .= '<span class="error" id="tipErr">* </span>';
			$custom .= '</div>';
			$custom .= '</div>';
		}
		if($driveTypes != '')
		{
			$custom .= '<div class="row">';
			$custom .= '<div class="col 16 s12">';
			$custom .= '<div class="col 16 s2">Drive Type </div>';
			$custom .= '<div class="col 16 s3">';
			$custom .= $driveTypes;
			$custom .= '</div>';
			$custom .= '<div class="col s2">';
			$custom .= '<span class="error" id="driveErr">* </span>';
			$custom .= '</div>';
			$custom .= '</div>';
		}
		if($isoTypes != '')
		{
			$custom .= '<div class="row">';
			$custom .= '<div class="col 16 s12">';
			$custom .= '<div class="col 16 s2">ISO Standard </div>';
			$custom .= '<div class="col 16 s3">';
			$custom .= $isoTypes;
			$custom .= '</div>';
			$custom .= '<div class="col s2">';
			$custom .= '<span class="error">**</span>';
			$custom .= '</div>';
			$custom .= '</div>';
		}
		if($utsTypes != '')
		{
			$custom .= '<div class="row">';
			$custom .= '<div class="col 16 s12">';
			$custom .= '<div class="col 16 s2">UTS Standard </div>';
			$custom .= '<div class="col 16 s3">';
			$custom .= $utsTypes;
			$custom .= '</div>';
			$custom .= '<div class="col s2">';
			$custom .= '<span class="error">**</span>';
			$custom .= '</div>';
			$custom .= '</div>';
		}
		$custom .= '<div class="row">';
		$custom .= '<div class="col s4">';
		$custom .= '<span class="error" id="threadErr"></span>';
		$custom .= '</div>';
		$custom .= '</div>';
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
			<div class="col s3">
				<span>** - one of these must be specified</span>
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
<script type="text/javascript" src="https://code.jquery.com/jquery-2.1.1.min.js"></script>
<script type="text/javascript" src="../js/materialize.min.js"></script>
<script src="../min/plugin-min.js"></script>
<script src="../min/custom-min.js"></script>

<script type="text/javascript">
	$(document).ready(function() {
	  $('select').material_select();
	});

	function validateForm()
	{
		var name = cleanInput(document.getElementById("partName").value);
		var desc = cleanInput(document.getElementById("desc").value);
		var selImgFiles = document.getElementById("imgFile").files;
		var imgFile = "";
		if(selImgFiles.length > 0)
		{
			imgFile = selImgFiles[0].name;
		}
		var diameter = cleanInput(document.getElementById("diameter").value);
		var partLen = cleanInput(document.getElementById("length").value);
		
		var headType = document.getElementById("headType");
		var headTypeVal = headType.options[headType.selectedIndex].value;
		var tipType = document.getElementById("tipType");
		var tipTypeVal = tipType.options[tipType.selectedIndex].value;
		var driveType = document.getElementById("driveType");
		var driveTypeVal = driveType.options[driveType.selectedIndex].value;
		var isoThreadType = document.getElementById("isoThread");
		var isoThreadTypeVal = isoThreadType.options[isoThreadType.selectedIndex].value;
		var utsThreadType = document.getElementById("utsThread");
		var utsThreadTypeVal = utsThreadType.options[utsThreadType.selectedIndex].value;
		var diamUnit = document.getElementById("diameterUnits");
		var diamUnitVal = -1;
		if(diamUnit != null)
		{
			diamUnitVal = diamUnit.options[diamUnit.selectedIndex].value;
		}
		var lenUnit = document.getElementById("lengthUnits");
		var lenUnitVal = -1;
		if(lenUnit != null)
		{
			lenUnitVal = lenUnit.options[lenUnit.selectedIndex].value;
		}
		
		var errors = false;
		if(name.length == 0)
		{
			// need to set error msg.
			document.getElementById("nameErr").innerText = "* Part Name is required";
			errors = true;
		}
		if(headTypeVal == -1)
		{
			// need to set error msg.
			document.getElementById("headErr").innerText = "* Head Type is required";
			errors = true;
		}
		if(tipTypeVal == -1)
		{
			// need to set error msg.
			document.getElementById("tipErr").innerText = "* Tip Type is required";
			errors = true;
		}
		if(driveTypeVal == -1)
		{
			// need to set error msg.
			document.getElementById("driveErr").innerText = "* Drive Type is required";
			errors = true;
		}
		if(isoThreadTypeVal == -1 && utsThreadTypeVal == -1)
		{
			// need to set error msg.
			document.getElementById("threadErr").innerText = "** At least one thread type is required";
			errors = true;
		}
		
		if(!errors)
		{
			// valid data - save part
	    var xmlhttp = new XMLHttpRequest();
	    xmlhttp.onreadystatechange = function() {
	        if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
	            document.getElementById("results").innerHTML = xmlhttp.responseText;
	        }
	    };
	    var post = "saveScrew.php?name=" + name + "&img=" + imgFile + "&desc=" + desc;
	    post += "&diam=" + diameter + "&diamunit=" + diamUnitVal;
	    post += "&len=" + partLen + "&lenunit=" + lenUnitVal;
	    post += "&head=" + headTypeVal + "&tip=" + tipTypeVal;
	    post += "&drive=" + driveTypeVal;
	    post += "&iso=" + isoThreadTypeVal + "&uts=" + utsThreadTypeVal;
	    
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


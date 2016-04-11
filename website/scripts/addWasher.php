<!DOCTYPE html>
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1.0, user-scalable=no"/>
    <meta name="theme-color" content="#9966FF">
    <title>Add Part </title>
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
// define error variables and set to empty values
$nameErr = $partTypeErr = "";
// define variables and set to empty values
$name = $desc = $imgFile = $partType = "";

?>
<div class="row" style="margin-top:10px">
	<div class="row">
		<div class="col 16 s12">
			<div class="col 16 s2">Part Type</div>
			<div class="col 16 s3">
				<select name="PartType" id="PartType" class="black-text" onchange="partTypeChanged(this)">
				<option value=-1>Select a Part Type</option>
				<?php
					// select part type - may need to drill down levels
					require 'dbAccess.php';
					$partTypes = getLeafPartTypes();
					if(count($partTypes) > 0)
					{
						foreach($partTypes as $row)
						{
							echo '<option value=' . $row['PartTypeId'] . '>' . $row['Name'] . '</option>';
						}
					}
				?>
				</select> 
			</div>
			<div class="col 16 s2">
				<span class="error" id="partTypeErr">*</span>
			</div>
			<div class="col 16 s1">Part Name</div>
			<div class="col 16 s3">
				<input id="partName" name="partName" type="text"/>
			</div>
			<div class="col s1">
				<span class="error" id="nameErr">* </span>
			</div>
	  </div>
	</div>
	<div class="row">
		<div class="col 16 s12">
			<div class="col 16 s1">Image File </div>
			<div class="col 16 s5">					
				<input id="imgFile" type="file"/>
			</div>
			<div class="col s1">Description </div>
			<div class="col s5">
				<textarea id="desc" name="desc" rows=4></textarea>
			</div>
	  </div>
	</div>		
	<div class="row" id="customProperties">
	</div>
	<div class="row" >
		<div class="col 16 s12">
			<div class="col s12" id="results">
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

	function partTypeChanged(sel)
	{
		var value = sel.options[sel.selectedIndex].text;
		value = value.toUpperCase();
		// show screw properties
    var xmlhttp = new XMLHttpRequest();
    xmlhttp.onreadystatechange = function() {
        if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
            document.getElementById("customProperties").innerHTML = xmlhttp.responseText;
					  $('select').material_select();
        }
    };
    xmlhttp.open("POST", "getCustomPartProp.php?type=" + value, true);
    xmlhttp.send();
	}
	
	function validateForm()
	{
		var name = cleanInput(document.getElementById("partName").value);
		var desc = cleanInput(document.getElementById("desc").value);
		var partType = document.getElementById("PartType");
		var partTypeVal = partType.options[partType.selectedIndex].value;
		var selImgFiles = document.getElementById("imgFile").files;
		var imgFile = "";
		if(selImgFiles.length > 0)
		{
			imgFile = selImgFiles[0].name;
		}
		var errors = false;
		if(name.length == 0)
		{
			// need to set error msg.
			document.getElementById("nameErr").innerText = "* Part Name is required";
			errors = true;
		}
		if(partTypeVal == -1)
		{
			// need to set error msg.
			document.getElementById("partTypeErr").innerText = "* Part Type is required";
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
	    xmlhttp.open("POST", "savePart.php?name=" + name + "&type=" + partTypeVal + 
	    	"&img=" + imgFile + "&desc=" + desc, true);
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


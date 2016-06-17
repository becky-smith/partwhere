<!DOCTYPE html>
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1.0, user-scalable=no"/>
    <meta name="theme-color" content="#9966FF">
    <title>Part Wizard</title>
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

<div class="row" id="selections">
</div>

<div class="row" style="margin-top:10px">
		<div class="col s12 m4 l3">Select Part Type:</div>
</div>
<?php
	// select part type - may need to drill down levels
	require 'wizardwand.php';
	$partTypes = getPartCatImageCards();
	if($partTypes != '')
	{
		echo $partTypes;
	}
	else
	{
		echo '<div class="row">';
		echo '<div class="col s12 m4 l3">';
		echo 'No Part Types found';
		echo '</div>';
		echo '</div>';
	}
?>
<div class="row" id="filter">
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
    $('.tooltipped').tooltip({delay: 50});
  });

	var partCategory = -1;
	var partType = [];
	var headType = -1;
	var driveType = -1;
	var units = -1;
	var len = -1;
	var isoType = -1;
	var utsType = -1;
	var tipType = -1;
	var gradeType = -1;
	var materialType = -1;
	var finishType = -1;
	
	function partCategorySelected(selId, selName, selImg)
	{
		if(selId != partCategory)
		{
			clearPartSel();
		}
		if(selId != -1)
		{
			partCategory = selId;
			addChip(selName, selImg);
	    var xmlhttp = new XMLHttpRequest();
	    xmlhttp.onreadystatechange = function() {
	        if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
	        	if(xmlhttp.responseText != "")
	        	{
	            document.getElementById("filter").innerHTML = xmlhttp.responseText;
						  $(document).ready(function(){
						  	$('.tooltipped').tooltip("remove");
						    $('.tooltipped').tooltip({delay: 50});
						  });
	          }
	          else
          	{
          		// no subtypes...get parts?  Get other properties?
          		getParts(selId);
          	}
	        }
	    };
	    xmlhttp.open("POST", "wizardwand.php?id=" + selId + "&method=getPartTypes", true);
	    xmlhttp.send();
	  }
	}
	
	function clearPartSel()
	{
  		document.getElementById("filter").innerHTML = "";
  		document.getElementById("selections").innerHTML = "";
  		document.getElementById("partSection").innerHTML = "";
	}
	
	function addChip(chipName, chipImg)
	{
		var newChip = '<div class="chip">';
		if(chipImg != null && chipImg.length > 0)
		{
				newChip += ' <img src="img/' + chipImg + '">';
		}
		newChip += chipName + '</div>';
		document.getElementById("selections").innerHTML += newChip;
	}
	
	function partTypeSelected(selId, selName, selImg)
	{
		if(selId != -1)
		{
			// only add this part type if it isn't already there...
			if(partType.indexOf(selId) == -1)
			{
				partType.push(selId);
				addChip(selName, selImg);
			}
	    var xmlhttp = new XMLHttpRequest();
	    xmlhttp.onreadystatechange = function() {
	        if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
	        	if(xmlhttp.responseText != "")
	        	{
	            document.getElementById("filter").innerHTML = xmlhttp.responseText;
						  $(document).ready(function(){
						  	$('.tooltipped').tooltip("remove");
						    $('.tooltipped').tooltip({delay: 50});
						  });
	            
	          }
	          else
          	{
          		// no subtypes
          		getParts(selId);
          		// request length for filtering
          		displayLength();
          	}
	        }
	    };
	    xmlhttp.open("POST", "wizardwand.php?id=" + selId + "&method=getPartTypes", true);
	    xmlhttp.send();
	  }
	  else
  	{
			clearPartSel();
  	}
	}
	
	function displayLength()
	{
		var lenOpts = '<div class="row">';
		lenOpts += '<div class="col s6 m3 l2">Specify length:';
		lenOpts += '</div>';
		lenOpts += '</div>';
		lenOpts += '<div class="row">';
		lenOpts += '<div class="col s6 m3 l2">';
    lenOpts += '<input id="length" type="text" required/>';
    lenOpts += '<label for="length">Length</label>';
		lenOpts += '</div>';
		lenOpts += '<div class="col s3 m3 l2">';
    lenOpts += '<input name="unit1" type="radio" id="inch" checked/>';
    lenOpts += '<label for="inch">inches</label>';
		lenOpts += '</div>';
		lenOpts += '<div class="col s3 m3 l2">';
    lenOpts += '<input name="unit1" type="radio" id="metric" />';
    lenOpts += '<label for="metric">cm</label>';
		lenOpts += '</div>';
		lenOpts += '<div class="col s3 m3 l2">';
    lenOpts += '<a class="btn-floating waves-effect waves-teal" onclick="submitLength()"><i class="small material-icons">play_arrow</i></a>';
		lenOpts += '</div>';
		lenOpts += '</div>';
    document.getElementById("filter").innerHTML = lenOpts;
		
	}
	
	function submitLength()
	{
		// apply a length filter, reselect parts, and display next filter.
    var len = document.getElementById("length").value;
    var std = document.getElementById("inch").checked;
    if(std === true)
    {
    	// value in inches
    	units = 1;
    }
    else
  	{
  		// value in centimeters
  		units = 2;
  	}
  	getParts(partType[partType.length - 1];
    
	}
	
	function getParts(selPartType)
	{
	    var xmlhttp = new XMLHttpRequest();
	    xmlhttp.onreadystatechange = function() {
        if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
        	if(xmlhttp.responseText != "")
        	{
            document.getElementById("partSection").innerHTML = xmlhttp.responseText;
					  $(document).ready(function(){
					  	$('.tooltipped').tooltip("remove");
					    $('.tooltipped').tooltip({delay: 50});
					  });
          }
        }
	    };
	    var page = "getParts.php?id=" + selPartType;
	    if(headType != -1)
	    {
	    	page += "&head=" + headType;
	    }
	    if(len != -1)
	    {
	    	page += "&len=" + len;
	    	page += "&unit=" + units;
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
<!DOCTYPE html>
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1.0, user-scalable=no"/>
    <meta name="theme-color" content="#9966FF">
    <title>Find Part </title>
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

<div class="row" style="margin-top:10px">
	<div class="col 16 s12">
		<?php
			// select part type - may need to drill down levels
			require 'dbAccess.php';
			$partTypes = getPartTypes();
			if(count($partTypes) > 0)
			{
				echo '<div class="col 16 s2">Part Type</div>';
				echo '<div class="col 16 s3">';
				echo '<select name="PartType" class="black-text" onchange="partTypeChanged(this)">';
				echo '<option value=-1>Select a Part Type</option>';
				foreach($partTypes as $row)
				{
					echo '<option value=' . $row['PartTypeId'] . '>' . $row['Name'] . '</option>';
				}
				echo '</select>'; 
			}
			else
			{
				echo '<div class="col 16 s4">';
				echo 'No Part Types found';
				echo '</div>';
			}
		?>
	</div>
</div>
<div class="row" id="subPartTypeSection">
</div>
<div class="row" id="partSection">
</div>

<!--Footer-->
<?php include("footer.html") ?>

	</body>
</html>

<script type="text/javascript">
	$(document).ready(function() {
	  $('select').material_select();
	});

	function partTypeChanged(sel)
	{
		var value = sel.value;
		if(value != -1)
		{
	    var xmlhttp = new XMLHttpRequest();
	    xmlhttp.onreadystatechange = function() {
	        if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
	            document.getElementById("subPartTypeSection").innerHTML = xmlhttp.responseText;
							$(document).ready(function() {
							  $('select').material_select();
							});
	        }
	    };
	    xmlhttp.open("POST", "getPartSubTypes.php?id=" + value, true);
	    xmlhttp.send();
	  }
	  else
	  	{
	  		document.getElementById("subPartTypeSection").innerHTML = "";
	  	}
	}

	function subPartTypeChanged(sel)
	{
		var value = sel.value;
		if(value != -1)
		{
	    var xmlhttp = new XMLHttpRequest();
	    xmlhttp.onreadystatechange = function() {
	        if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
	            document.getElementById("partSection").innerHTML = xmlhttp.responseText;
						  $('select').material_select();
	        }
	    };
	    xmlhttp.open("POST", "getPartSubTypes.php?id=" + value, true);
	    xmlhttp.send();
	  }
	}
		
</script>
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
            <a href="partSearch.php" id="logo-container" class="brand-logo"><img class="center" src="img/minipartwherelogo.png"></a>
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
	<div class="row" >
		<div class="col 16 s12">
			<div class="col s12" id="results">
			</div>
		</div>
	</div>
	<div class="row">
		<div class="col 16 s12">
			<div class="col 16 s3">Select Part Type to add </div>
			<div class="col 16 s4">
				<select name="PartType" id="PartType" class="black-text">
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
	  </div>
	</div>
	<div class="row">
		<div class="col 16 s12">
			<button type=button onclick="partTypeChanged()">Add</button>
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

	function partTypeChanged()
	{
		var sel = document.getElementById("PartType");
		var value = sel.options[sel.selectedIndex].value;
		var page = "";
		switch(value)
		{
			case '2':
			{
				page = "addScrew.php";
				break;
			}
			case '3':
			{
				page = "addNut.php";
				break;
			}
			case '4':
			{
				page = "addBolt.php";
				break;
			}
			case '5':
			{
				page = "addWasher.php";
				break;
			}
			default:
			{
				break;
			}
		}
		if(page != "")
		{
			// show screw properties
			window.location = page;
	  }
	  else
  	{
  		document.getElementById("results").innerHTML = "<b>Failed to add part.  Please select a different type.<\b>";
  	}
	}
		
</script>


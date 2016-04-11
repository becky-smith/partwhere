<!DOCTYPE html>
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1.0, user-scalable=no"/>
    <meta name="theme-color" content="#9966FF">
    <title>Find Part </title>
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
                  <li><a href="visualSearch.php">Find Bolt</a></li>
                  <li><a href="addPart.php">Add Part</a></li>
                  <li><a href="about.html">About Us</a></li>
              </ul>
              <ul id="nav-mobile" class="side-nav">
                  <li><a href="partSearch.php">Find Part</a></li>
                  <li><a href="visualSearch.php">Find Bolt</a></li>
                  <li><a href="addPart.php">Add Part</a></li>
                  <li><a href="about.html">About Us</a></li>
              </ul>
	            <a href="#" data-activates="nav-mobile" class="button-collapse"><i class="mdi-navigation-menu"></i></a>
          </div>
      	</div>
      </div>
  </nav>
</div>

<div class="row" style="margin-top:10px">
	<div class="col s12">
		<div class="col s2">Select Part Type:
		</div>
	</div>
</div>
		<?php
			// select part type - may need to drill down levels
			require 'getImageButtons.php';
			$partTypes = getPartTypeImageButtons();
			if($partTypes != '')
			{
				echo $partTypes;
			}
			else
			{
				echo '<div class="col s4">';
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
  $(document).ready(function(){
    $('.tooltipped').tooltip({delay: 50});
  });

	var lastSel = -1;
	function partTypeSelected(sel)
	{
		lastSel = sel;
		if(sel != -1)
		{
	    var xmlhttp = new XMLHttpRequest();
	    xmlhttp.onreadystatechange = function() {
	        if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
	        	if(xmlhttp.responseText != "")
	        	{
	            document.getElementById("subPartTypeSection").innerHTML += xmlhttp.responseText;
						  $(document).ready(function(){
						  	$('.tooltipped').tooltip("remove");
						    $('.tooltipped').tooltip({delay: 50});
						  });
	            
	          }
	          else
	          	{
	          		// no subtypes...get parts?  Get other properties?
	          		getParts();
	          	}
	        }
	    };
	    xmlhttp.open("POST", "visualPartSubTypes.php?id=" + sel, true);
	    xmlhttp.send();
	  }
	  else
	  	{
	  		document.getElementById("subPartTypeSection").innerHTML = "";
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
						  $(document).ready(function(){
						  	$('.tooltipped').tooltip("remove");
						    $('.tooltipped').tooltip({delay: 50});
						  });
	          }
	        }
	    };
	    xmlhttp.open("POST", "getParts.php?id=" + lastSel, true);
	    xmlhttp.send();
	}
		
</script>
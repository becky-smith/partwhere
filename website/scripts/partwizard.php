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
    <link href="css/custom-min.css" type="text/css" rel="stylesheet" >
</head>
<body id="top" class="scrollspy">
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
	require 'getImageCard.php';
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
<script type="text/javascript" src="https://code.jquery.com/jquery-2.1.4.min.js"></script>
<script type="text/javascript" src="js/materialize.min.js"></script>
<script type="text/javascript" src="js/modernizr.js"></script>
<script type="text/javascript" src="js/custom-min.js"></script>
<script type="text/javascript" src="js/partwizard.js"></script>

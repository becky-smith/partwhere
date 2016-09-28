<?php
	// select part type - may need to drill down levels
	require_once 'getImageCard.php';
	require_once 'getImageList.php';
	// get the id parameter from URL
	$method = $_REQUEST["method"];
	$result = '';
	if($method === "getPartTypes")
	{
		$parent = $_REQUEST["id"];
		$result = getPartTypeImageCards($parent);
	}
	if($method === "getGrades")
	{
		$result = getGradeImageCards();
	}
	if($method === "getMaterials")
	{
		$result = getMaterialImageCards();
	}
	if($method === "getFinishes")
	{
		$result = getFinishImageCards();
	}
	if($method === "getPartTypesList")
	{
		$parent = $_REQUEST["id"];
		$result = getPartTypeImageList($parent);
	}
	if($method === "getGradesList")
	{
		$result = getGradeImageList();
	}
	if($method === "getMaterialsList")
	{
		$result = getMaterialImageList();
	}
	if($method === "getFinishesList")
	{
		$result = getFinishImageList();
	}
	echo $result;

?>

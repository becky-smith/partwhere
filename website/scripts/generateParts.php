<?php
$servername = "localhost";
$username = "leiowaco_part";
$password = "p@rtWh3r3";
$dbname = "leiowaco_partwhereDemo";

    function getHeadTypes()
    {
    	$result = array();
			try 
			{
				  global $servername, $username, $password, $dbname;
			    $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
			    // set the PDO error mode to exception
			    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		    	$query = 'SELECT * FROM headtype';
		    	//echo $query;
		    	$resultset = $conn->query($query);
					if($resultset->rowcount() > 0)
					{
						$resultset->setFetchMode(PDO::FETCH_ASSOC);
						$result = $resultset->fetchAll();				
					}
			}
			catch(PDOException $e)
			{
			    echo "Get Head Types failed: " . $e->getMessage();
			}
			$conn = null;
    	return $result;
    }

    function getLengths()
    {
    	$result = array();
			try 
			{
				  global $servername, $username, $password, $dbname;
			    $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
			    // set the PDO error mode to exception
			    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		    	$query = 'SELECT * FROM lengthtype';
		    	//echo $query;
		    	$resultset = $conn->query($query);
					if($resultset->rowcount() > 0)
					{
						$resultset->setFetchMode(PDO::FETCH_ASSOC);
						$result = $resultset->fetchAll();				
					}
			}
			catch(PDOException $e)
			{
			    echo "Get Length Types failed: " . $e->getMessage();
			}
			$conn = null;
    	return $result;
    }

    function getTipTypes()
    {
    	$result = array();
			try 
			{
				  global $servername, $username, $password, $dbname;
			    $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
			    // set the PDO error mode to exception
			    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		    	$query = 'SELECT * FROM tiptype';
		    	//echo $query;
		    	$resultset = $conn->query($query);
					if($resultset->rowcount() > 0)
					{
						$resultset->setFetchMode(PDO::FETCH_ASSOC);
						$result = $resultset->fetchAll();				
					}
			}
			catch(PDOException $e)
			{
			    echo "Get Tip Types failed: " . $e->getMessage();
			}
			$conn = null;
    	return $result;
    }

    function getDriveTypes()
    {
    	$result = array();
			try 
			{
				  global $servername, $username, $password, $dbname;
			    $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
			    // set the PDO error mode to exception
			    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		    	$query = 'SELECT * FROM drivetype';
		    	//echo $query;
		    	$resultset = $conn->query($query);
					if($resultset->rowcount() > 0)
					{
						$resultset->setFetchMode(PDO::FETCH_ASSOC);
						$result = $resultset->fetchAll();				
					}
			}
			catch(PDOException $e)
			{
			    echo "Get Drive Types failed: " . $e->getMessage();
			}
			$conn = null;
    	return $result;
    }

    function getISOThreadTypes()
    {
    	$result = array();
			try 
			{
				  global $servername, $username, $password, $dbname;
			    $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
			    // set the PDO error mode to exception
			    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		    	$query = 'SELECT * FROM isothreadstd';
		    	//echo $query;
		    	$resultset = $conn->query($query);
					if($resultset->rowcount() > 0)
					{
						$resultset->setFetchMode(PDO::FETCH_ASSOC);
						$result = $resultset->fetchAll();				
					}
			}
			catch(PDOException $e)
			{
			    echo "Get ISO Thread Types failed: " . $e->getMessage();
			}
			$conn = null;
    	return $result;
    }

    function getUTSThreadTypes()
    {
    	$result = array();
			try 
			{
				  global $servername, $username, $password, $dbname;
			    $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
			    // set the PDO error mode to exception
			    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		    	$query = 'SELECT * FROM utsthreadstd';
		    	//echo $query;
		    	$resultset = $conn->query($query);
					if($resultset->rowcount() > 0)
					{
						$resultset->setFetchMode(PDO::FETCH_ASSOC);
						$result = $resultset->fetchAll();				
					}
			}
			catch(PDOException $e)
			{
			    echo "Get UTS Thread Types failed: " . $e->getMessage();
			}
			$conn = null;
    	return $result;
    }

    function getGrades()
    {
    	$result = array();
			try 
			{
				  global $servername, $username, $password, $dbname;
			    $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
			    // set the PDO error mode to exception
			    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		    	$query = 'SELECT * FROM grade';
		    	//echo $query;
		    	$resultset = $conn->query($query);
					if($resultset->rowcount() > 0)
					{
						$resultset->setFetchMode(PDO::FETCH_ASSOC);
						$result = $resultset->fetchAll();				
					}
			}
			catch(PDOException $e)
			{
			    echo "Get Grades failed: " . $e->getMessage();
			}
			$conn = null;
    	return $result;
    }
    
    function getMaterials()
    {
    	$result = array();
			try 
			{
				  global $servername, $username, $password, $dbname;
			    $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
			    // set the PDO error mode to exception
			    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		    	$query = 'SELECT * FROM materialtype WHERE IsFinish=0';
		    	//echo $query;
		    	$resultset = $conn->query($query);
					if($resultset->rowcount() > 0)
					{
						$resultset->setFetchMode(PDO::FETCH_ASSOC);
						$result = $resultset->fetchAll();				
					}
			}
			catch(PDOException $e)
			{
			    echo "Get Materials failed: " . $e->getMessage();
			}
			$conn = null;
    	return $result;
    }

    function getFinishes()
    {
    	$result = array();
			try 
			{
				  global $servername, $username, $password, $dbname;
			    $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
			    // set the PDO error mode to exception
			    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		    	$query = 'SELECT * FROM materialtype WHERE IsFinish=1';
		    	//echo $query;
		    	$resultset = $conn->query($query);
					if($resultset->rowcount() > 0)
					{
						$resultset->setFetchMode(PDO::FETCH_ASSOC);
						$result = $resultset->fetchAll();				
					}
			}
			catch(PDOException $e)
			{
			    echo "Get Finishes failed: " . $e->getMessage();
			}
			$conn = null;
    	return $result;
    }

		function setPartType($partId, $partTypeId)
		{
			try 
			{
				  global $servername, $username, $password, $dbname;
			    $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
			    // set the PDO error mode to exception
			    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		    	$query = "INSERT INTO parttoparttype (PartId, PartTypeId) VALUES (" . $partId . ", " . $partTypeId . ")";
		    	$conn->exec($query);
			}
			catch(PDOException $e)
			{
			    echo "Set part type failed: " . $e->getMessage();
			}
			$conn = null;
    }

    function buildBolts($name, $head, $partType, $imgFile)
    {
    	$result = -1;
    	$lengths = getLengths();
    	$iso = getISOThreadTypes();
    	$uts = getUTSThreadTypes();
    	$materials = getMaterials();
    	$finishes = getFinishes();
    	$grades = getGrades();
    	if(count($lengths) > 0)
    	{
				try 
				{
				  global $servername, $username, $password, $dbname;
			    $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
			    // set the PDO error mode to exception
			    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
			    $gradeIndex = 0;
			    $gradeCount = count($grades);
			    $materialsIndex = 0;
			    $materialsCount = count($materials);
			    $finishesIndex = 0;
			    $finishesCount = count($finishes);
					foreach($lengths as $row)
					{
						$length = $row['Length'];
						$lenid = $row['LengthTypeId'];
						$full = true;
						$grade = $grades[$gradeIndex];
						$material = $materials[$materialsIndex];
						$finish = $finishes[$finishesIndex];
						$gradeId = $grade['GradeId'];
						$gradeName = $grade['Name'];
						$matId = $material['MaterialTypeId'];
						$matName = $material['Name'];
						$finId = $finish['MaterialTypeId'];
						$finName = $finish['Name'];
						if($row['Unit'] == 1)
						{
							foreach($iso as $isothread)
							{
								$threadName = $isothread['Name'];
								$threadId = $isothread['ISOId'];
								$partName = $length . " " . $threadName . " " . $gradeName . "  " . $finName . " " . $matName . " " . $name;
					    	$query = "INSERT INTO part (Name, ImageFile, Length, Grade, Material, Finish) VALUES ('" . $partName . "', '" . $imgFile . "', " . $lenid . ", " . $gradeId . ", " . $matId . ", " . $finId . ")";
					    	$conn->exec($query);
					    	$getId = "SELECT PartId FROM part WHERE Name='" . $partName . "'";
					    	$resultset = $conn->query($getId);
					    	// query should only return 1 record
								if($resultset->rowcount() > 0)
								{
									$resultset->setFetchMode(PDO::FETCH_ASSOC);
									$idRow = $resultset->fetch();				
									$result = $idRow['PartId'];
									setPartType($result, $partType);
									setHeadEnd($result, $head);
									setISOThread($result, $threadId, $full);
								}
								$full = !$full;
							}
						}
						else
						{
							foreach($uts as $utsthread)
							{
								$threadName = $utsthread['Name'];
								$threadId = $utsthread['UTSId'];
								$partName = $length . " " . $threadName . " " . $gradeName . "  " . $finName . " " . $matName . " " . $name;
					    	$query = "INSERT INTO part (Name, ImageFile, Length, Grade, Material, Finish) VALUES ('" . $partName . "', '" . $imgFile . "', " . $lenid . ", " . $gradeId . ", " . $matId . ", " . $finId . ")";
					    	$conn->exec($query);
					    	$getId = "SELECT PartId FROM part WHERE Name='" . $partName ."'";
					    	$resultset = $conn->query($getId);
					    	// query should only return 1 record
								if($resultset->rowcount() > 0)
								{
									$resultset->setFetchMode(PDO::FETCH_ASSOC);
									$idRow = $resultset->fetch();				
									$result = $idRow['PartId'];
									setPartType($result, $partType);
									setHeadEnd($result, $head);
									setUTSThread($result, $threadId, $full);
								}
								$full = !$full;
							}
						}
				    $gradeIndex = $gradeIndex + 1 < $gradeCount ? $gradeIndex + 1 : 0;
				    $materialsIndex = $materialsIndex + 1 < $materialsCount ? $materialsIndex + 1 : 0;
				    $finishesIndex = $finishesIndex + 1 < $finishesCount ? $finishesIndex + 1 : 0;
					}
				}
				catch(PDOException $e)
				{
				    echo "buildBolts failed: " . $e->getMessage();
				}
				$conn = null;
			}
    	return $result;
    }

		function setHeadEnd($partId, $headId)
		{
			if($headId != -1)
			{
				try 
				{
					  global $servername, $username, $password, $dbname;
				    $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
				    // set the PDO error mode to exception
				    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
			    	$query = "INSERT INTO partheadend (PartId, HeadTypeId) VALUES (" . $partId . ", " . $headId . ")";
			    	$conn->exec($query);
				}
				catch(PDOException $e)
				{
				    echo "Set part head failed: " . $e->getMessage();
				}
			}
			$conn = null;
    }
    
		function setISOThread($partId, $isoId, $full)
		{
			try 
			{
				  global $servername, $username, $password, $dbname;
			    $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
			    // set the PDO error mode to exception
			    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		    	$query = "INSERT INTO parttothread (PartId, ISOId, FullyThreaded) VALUES (" . $partId . ", " . $isoId . ", ";
		    	if($full)
		    	{
		    	 $query .= "1)";
		    	}
		    	else
		    	{
		    	 $query .= "0)";
		    	}
		    	$conn->exec($query);
			}
			catch(PDOException $e)
			{
			    echo "Set part ISO Thread failed: " . $e->getMessage();
			}
			$conn = null;
    }

		function setUTSThread($partId, $utsId, $full)
		{
			try 
			{
				  global $servername, $username, $password, $dbname;
			    $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
			    // set the PDO error mode to exception
			    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		    	$query = "INSERT INTO parttothread (PartId, UTSId, FullyThreaded) VALUES (" . $partId . ", " . $utsId . ", ";
		    	if($full)
		    	{
		    	 $query .= "1)";
		    	}
		    	else
		    	{
		    	 $query .= "0)";
		    	}
		    	$conn->exec($query);
			}
			catch(PDOException $e)
			{
			    echo "Set part UTS Thread failed: " . $e->getMessage();
			}
			$conn = null;
    }

?>
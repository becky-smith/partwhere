<?php
$servername = "localhost";
//$username = "partwhere";
//$dbname = "partwhere";
$username = "leiowaco_phpdemo";
$dbname = "leiowaco_phpDemo";
$password = "Ph[D3mo";

    function getPartTypes($parent = -1)
    {
    	$result = array();
			try 
			{
				  global $servername, $username, $password, $dbname;
			    $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
			    // set the PDO error mode to exception
			    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		    	$query = 'SELECT * FROM parttype WHERE ParentPartTypeId';
		    	if($parent == -1)
		    	{
		    		$query .= ' IS NULL';
		    	}
		    	else
		    	{
		    		$query .= '=' . $parent;
		    	}
		    	$query .= ' ORDER BY Name';
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
			    echo "Get Part Types failed: " . $e->getMessage();
			}
			$conn = null;
    	return $result;
    }

    function getParts($partType = -1, $headType = -1, $tipType = -1, $driveType = -1, 
    	$lengthType = -1, $isoType = -1, $utsType = -1, $gradeType = -1, $materialType = -1, $finishType = -1)
    {
    	$result = array();
			try 
			{
				  global $servername, $username, $password, $dbname;
			    $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
			    // set the PDO error mode to exception
			    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		    	$query = 'SELECT p.* FROM part p ';
		    	$where = 'WHERE ';
		    	if($partType != -1)
		    	{
		    		$query .= 'JOIN parttoparttype pt on pt.PartId = p.PartId ';
			     	$where .= 'pt.PartTypeId=' . $partType;
			    }
			    if($headType != -1 || $tipType != -1 || $driveType != -1)
			    {
			    	$query .= 'JOIN partheadend he on he.PartId = p.PartId ';
			    	if($headType != -1)
			    	{
			    		if(strlen($where) > 6)
			    		{
			    			$where .= ' AND ';
			    		}
				    	$where .= 'he.HeadTypeId=' . $headType;
				    }
			    	if($tipType != -1)
			    	{
			    		if(strlen($where) > 6)
			    		{
			    			$where .= ' AND ';
			    		}
				    	$where .= 'he.TipTypeId=' . $tipType;
				    }
			    	if($driveType != -1)
			    	{
			    		if(strlen($where) > 6)
			    		{
			    			$where .= ' AND ';
			    		}
				    	$where .= 'he.DriveTypeId=' . $driveType;
				    }
			    }
			    if($lengthType != -1)
			    {
		    		if(strlen($where) > 6)
		    		{
		    			$where .= ' AND ';
		    		}
			    	$where .= 'p.Length=' . $lengthType;
			    }
			    if($gradeType != -1)
			    {
		    		if(strlen($where) > 6)
		    		{
		    			$where .= ' AND ';
		    		}
			    	$where .= 'p.Grade=' . $gradeType;
			    }
			    if($materialType != -1)
			    {
		    		if(strlen($where) > 6)
		    		{
		    			$where .= ' AND ';
		    		}
			    	$where .= 'p.Material=' . $materialType;
			    }
			    if($finishType != -1)
			    {
		    		if(strlen($where) > 6)
		    		{
		    			$where .= ' AND ';
		    		}
			    	$where .= 'p.Finish=' . $finishType;
			    }
			    if($isoType != -1)
			    {
			    	$query .= 'JOIN parttothread trd on trd.PartId = p.PartId ';
		    		if(strlen($where) > 6)
		    		{
		    			$where .= ' AND ';
		    		}
			    	$where .= 'trd.ISOId=' . $isoType;
			    }
			    if($utsType != -1)
			    {
			    	$query .= 'JOIN parttothread trd on trd.PartId = p.PartId ';
		    		if(strlen($where) > 6)
		    		{
		    			$where .= ' AND ';
		    		}
			    	$where .= 'trd.UTSId=' . $utsType;
			    }
		    	$query .= $where;
		    	//echo $query . '<br>';
		    	$resultset = $conn->query($query);
					if($resultset->rowcount() > 0)
					{
						$resultset->setFetchMode(PDO::FETCH_ASSOC);
						$result = $resultset->fetchAll();				
					}
			}
			catch(PDOException $e)
			{
			    echo "Get Parts for Part Type " . $partType . "failed: " . $e->getMessage();
			}
			$conn = null;
    	return $result;
    }
    
    function getLeafPartTypes($unused=false)
    {
    	$result = array();
			try 
			{
				  global $servername, $username, $password, $dbname;
			    $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
			    // set the PDO error mode to exception
			    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		    	$query = 'SELECT * FROM parttype WHERE PartTypeId not in (SELECT distinct ParentPartTypeId FROM parttype WHERE ParentPartTypeId IS NOT NULL)';
		    	if($unused)
		    	{
		    		$query .= ' AND PartTypeId not in (SELECT distinct PartTypeId FROM parttoparttype)';
		    	}
		    	$query .= ' ORDER BY Name';
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
			    echo "Get Leaf Part Types failed: " . $e->getMessage();
			}
			$conn = null;
    	return $result;
    }
    
    function getHeadTypes()
    {
    	$result = array();
			try 
			{
				  global $servername, $username, $password, $dbname;
			    $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
			    // set the PDO error mode to exception
			    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		    	$query = 'SELECT * FROM headtype ORDER BY Name';
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

    function getLengthTypes()
    {
    	$result = array();
			try 
			{
				  global $servername, $username, $password, $dbname;
			    $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
			    // set the PDO error mode to exception
			    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		    	$query = 'SELECT lt.LengthTypeId, lt.Length, u.Name FROM lengthtype lt JOIN unit u on u.UnitId=lt.Unit ORDER BY lt.DecimalVal';
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
		    	$query = 'SELECT * FROM tiptype ORDER BY Name';
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
		    	$query = 'SELECT * FROM drivetype ORDER BY Name';
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
		    	$query = 'SELECT * FROM isothreadstd order by NominalDiameter';
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
		    	$query = 'SELECT * FROM utsthreadstd order by NominalDiameterMM';
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

    function getUnits()
    {
    	$result = array();
			try 
			{
				  global $servername, $username, $password, $dbname;
			    $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
			    // set the PDO error mode to exception
			    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		    	$query = 'SELECT * FROM unit ORDER BY Name';
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
			    echo "Get Units failed: " . $e->getMessage();
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
		    	$query = 'SELECT * FROM grade ORDER BY Name';
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
		    	$query = 'SELECT * FROM materialtype WHERE IsFinish=0 ORDER BY Name';
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
		    	$query = 'SELECT * FROM materialtype WHERE IsFinish=1 ORDER BY Name';
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
    
    function addPart($name, $desc, $imgFile, $partType)
    {
    	$result = -1;
			try 
			{
				  global $servername, $username, $password, $dbname;
			    $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
			    // set the PDO error mode to exception
			    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		    	$query = "INSERT INTO part (Name, Description, ImageFile) VALUES ('" . $name . "', '" . $desc . "', '" . $imgFile . "')";
		    	$conn->exec($query);
		    	$getId = "SELECT PartId FROM part WHERE Name='" . $name . "'";
		    	$resultset = $conn->query($getId);
		    	// query should only return 1 record
					if($resultset->rowcount() > 0)
					{
						$resultset->setFetchMode(PDO::FETCH_ASSOC);
						$idRow = $resultset->fetch();				
						$result = $idRow['PartId'];
						setPartType($result, $partType);
					}
			}
			catch(PDOException $e)
			{
			    echo "Add Part failed: " . $e->getMessage();
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
			    echo "Add Part failed: " . $e->getMessage();
			}
			$conn = null;
    }

    function getTypeForLength($len, $unit)
    {
    	$result = -1;
			try 
			{
				  global $servername, $username, $password, $dbname;
			    $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
			    // set the PDO error mode to exception
			    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		    	$query = 'SELECT lt.LengthTypeId FROM lengthtype lt WHERE lt.Unit=' . $unit . ' AND lt.DecimalVal=' . $len;
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
			    echo "Get Type for Length failed: " . $e->getMessage();
			}
			$conn = null;
    	return $result;
    }

    function getTypeForDiameter($len, $unit)
    {
    	$result = -1;
			try 
			{
				  global $servername, $username, $password, $dbname;
			    $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
			    // set the PDO error mode to exception
			    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		    	$query = 'SELECT ';
		    	if($unit == 1)
		    	{
		    		// standard thread - ISO
			    	$query .= 't.ISOId as Thread FROM isothreadstd t WHERE t.NominalDiameter=' . $len;
		    	}
		    	else
		    	{
		    		// metric thread - UTS
			    	$query .= 't.UTSId as Thread FROM utsthreadstd t WHERE t.NominalDiameterMM=' . $len;
		    	}
		    	//echo $query . "<br>";
		    	$resultset = $conn->query($query);
					if($resultset->rowcount() > 0)
					{
						$resultset->setFetchMode(PDO::FETCH_ASSOC);
						$result = $resultset->fetchAll();				
					}
			}
			catch(PDOException $e)
			{
			    echo "Get Type for Diameter failed: " . $e->getMessage();
			}
			$conn = null;
    	return $result;
    }
?>
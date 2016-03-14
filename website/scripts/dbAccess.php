<?php
$servername = "localhost";
$username = "partwhere";
$password = "p@rtWh3r3";

    function getPartTypes($parent = -1)
    {
    	$result = array();
			try 
			{
				  global $servername, $username, $password;
			    $conn = new PDO("mysql:host=$servername;dbname=partwhere", $username, $password);
			    // set the PDO error mode to exception
			    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		    	$query = 'SELECT * FROM PartType WHERE ParentPartTypeId';
		    	if($parent == -1)
		    	{
		    		$query .= ' IS NULL';
		    	}
		    	else
		    	{
		    		$query .= '=' . $parent;
		    	}
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

    function getParts($partType)
    {
    	$result = array();
			try 
			{
				  global $servername, $username, $password;
			    $conn = new PDO("mysql:host=$servername;dbname=partwhere", $username, $password);
			    // set the PDO error mode to exception
			    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		    	$query = 'SELECT p.* FROM Part p WHERE PartId in (SELECT PartId from PartToPartType WHERE PartTypeId=' . $partType . ')';
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
			    echo "Get Parts for Part Type " . $partType . "failed: " . $e->getMessage();
			}
			$conn = null;
    	return $result;
    }
    
    function getLeafPartTypes()
    {
    	$result = array();
			try 
			{
				  global $servername, $username, $password;
			    $conn = new PDO("mysql:host=$servername;dbname=partwhere", $username, $password);
			    // set the PDO error mode to exception
			    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		    	$query = 'SELECT * FROM PartType WHERE PartTypeId not in (SELECT distinct ParentPartTypeId FROM PartType WHERE ParentPartTypeId IS NOT NULL)';
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
				  global $servername, $username, $password;
			    $conn = new PDO("mysql:host=$servername;dbname=partwhere", $username, $password);
			    // set the PDO error mode to exception
			    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		    	$query = 'SELECT * FROM HeadType';
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

    function getTipTypes()
    {
    	$result = array();
			try 
			{
				  global $servername, $username, $password;
			    $conn = new PDO("mysql:host=$servername;dbname=partwhere", $username, $password);
			    // set the PDO error mode to exception
			    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		    	$query = 'SELECT * FROM TipType';
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
				  global $servername, $username, $password;
			    $conn = new PDO("mysql:host=$servername;dbname=partwhere", $username, $password);
			    // set the PDO error mode to exception
			    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		    	$query = 'SELECT * FROM DriveType';
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
				  global $servername, $username, $password;
			    $conn = new PDO("mysql:host=$servername;dbname=partwhere", $username, $password);
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
				  global $servername, $username, $password;
			    $conn = new PDO("mysql:host=$servername;dbname=partwhere", $username, $password);
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

    function getUnits()
    {
    	$result = array();
			try 
			{
				  global $servername, $username, $password;
			    $conn = new PDO("mysql:host=$servername;dbname=partwhere", $username, $password);
			    // set the PDO error mode to exception
			    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		    	$query = 'SELECT * FROM unit';
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
    
    function addPart($name, $desc, $imgFile, $partType)
    {
    	$result = -1;
			try 
			{
				  global $servername, $username, $password;
			    $conn = new PDO("mysql:host=$servername;dbname=partwhere", $username, $password);
			    // set the PDO error mode to exception
			    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		    	$query = "INSERT INTO Part (Name, Description, ImageFile) VALUES ('" . $name . "', '" . $desc . "', '" . $imgFile . "')";
		    	$conn->exec($query);
		    	$getId = "SELECT PartId FROM Part WHERE Name='" . $name . "'";
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
				  global $servername, $username, $password;
			    $conn = new PDO("mysql:host=$servername;dbname=partwhere", $username, $password);
			    // set the PDO error mode to exception
			    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		    	$query = "INSERT INTO PartToPartType (PartId, PartTypeId) VALUES (" . $partId . ", " . $partTypeId . ")";
		    	$conn->exec($query);
			}
			catch(PDOException $e)
			{
			    echo "Add Part failed: " . $e->getMessage();
			}
			$conn = null;
    }

?>
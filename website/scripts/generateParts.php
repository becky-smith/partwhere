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

    function buildBolts($name, $head, $partType, $imgFile)
    {
    	$result = -1;
    	$lengths = getLengths();
    	$iso = getISOThreadTypes();
    	$uts = getUTSThreadTypes();
    	if(count($lengths) > 0)
    	{
				try 
				{
				  global $servername, $username, $password, $dbname;
			    $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
			    // set the PDO error mode to exception
			    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
					foreach($lengths as $row)
					{
						$length = $row['Length'];
						$lenid = $row['LengthTypeId'];
						$full = true;
						foreach($iso as $isothread)
						{
							$threadName = $isothread['Name'];
							$threadId = $isothread['ISOId'];
							$partName = $length . " " . $threadName . " " . $name;
				    	$query = "INSERT INTO part (Name, Length, ImageFile) VALUES ('" . $partName . "', " . $lenid . ",'" . $imgFile . "')";
				    	$conn->exec($query);
				    	$getId = "SELECT PartId FROM part WHERE Name='" . $partName . "' and Length=" . $lenid;
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
						foreach($uts as $utsthread)
						{
							$threadName = $utsthread['Name'];
							$threadId = $utsthread['UTSId'];
							$partName = $length . " " . $threadName . " " . $name;
				    	$query = "INSERT INTO part (Name, Length, ImageFile) VALUES ('" . $partName . "', " . $lenid . ",'" . $imgFile . "')";
				    	$conn->exec($query);
				    	$getId = "SELECT PartId FROM part WHERE Name='" . $partName . "' and Length=" . $lenid;
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
				}
				catch(PDOException $e)
				{
				    echo "buildBolts failed: " . $e->getMessage();
				}
				$conn = null;
			}
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

		function setHeadEnd($partId, $headId)
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
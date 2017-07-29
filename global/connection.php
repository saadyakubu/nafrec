<?php

//$dsn = 'mysql:host=127.0.0.1;dbname=rec';
//$username= 'root';
//$password='mysql';
	$servername = getenv('IP');
    $username = getenv('C9_USER');
    $password = "";
    $database = "rec";
    //$dbport = 3306;
    $dsn = "mysql:host=$servername;dbname=rec"; 
    
	try
	{
		//instantiate new PDO connection_aborted
		$db = new PDO($dsn, $username, $password);
		return $db;
	}
	catch(PDOException $e)
	{
		//display error in custom error page
		$error = $e->getMessage();
		include('../global/error.php');
		exit();
	}

?>
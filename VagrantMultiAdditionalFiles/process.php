<?php

$username = 'root';
$password = 'rootpass';
$dsn = 'mysql:host=10.0.3.4;dbname=formresponses';

try{
	$db = new PDO($dsn, $username, $password);
	$result=FALSE;

	if($_POST['hostname']!=null)
	{
		$hostname=filter_var(trim($_POST['hostname']),FILTER_SANITIZE_SPECIAL_CHARS);
	}

} catch(PDOException $ex) {
	echo $ex->getMessage();
}

header('Location: index.html?success='.$result);


//Insert entered form info into the database
function insertInfo($db,$hostname)
{
	$stmt = $db->prepare("INSERT INTO response1(hostname) VALUES (:hostname)");
	$stmt->bindParam(':hostname', $hostname);
	
	return $stmt->execute();
}

?>

<?php


$username = 'root';
$password = 'rootpass';
$dsn = 'mysql:host=10.0.3.4;dbname=formresponses';

try{
	$db = new PDO($dsn, $username, $password);
	$result=FALSE;

    $query = "SELECT * FROM response";

    $stmt = $db->query($query);
    
    $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);

    
    echo "<table border='1'>
    <tr>
    <th>Name</th>
    </tr>";

    foreach($rows as $row) {
        echo "<tr>";
        echo "<td>".$row['hostname']."</td>";
        echo "</tr>";

        //printf("{$row['firstname']} {$row['secondname']} {$row['email']}\n");
    }

} catch(PDOException $ex) {
	echo $ex->getMessage();
}

echo "</table>";
?>

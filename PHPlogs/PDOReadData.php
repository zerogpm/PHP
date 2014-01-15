<?php

$user = 'xxxxx';
$pass = 'xxxx';
$dsn = 'xxxxxx';
 
$data = array('name' => 'jian');

// use try { // code } catch (PDOException $e) { // code } to trap errors
try {
	// PDO class represents the connection
	$pdo = new PDO($dsn, $user, $pass);

	//set error reporting
	$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

	// SQL
	$lookupsql = "SELECT * FROM members WHERE `name` = :name";

	// prepare
	$stmt = $pdo->prepare($lookupsql);
	
	// execute
	$stmt->execute($data);
	
	while($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
		echo $row['name'];
	}


	$pdo = NULL;
// traps any exceptions which might be thrown
} catch (PDOException $e) {
	echo $e->getMessage();
	echo $e->getTraceAsString();
}


?>
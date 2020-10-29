<?php
$db = getenv('DB_NAME');
$user = getenv('DB_USERNAME');
$pw = getenv('DB_PASSWORD');

try {
	$conn = new PDO('mysql:host=localhost;dbname='.$db, $user, $pw);
	$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch(PDOException $e) {
	echo 'error establishing database connection: ' . $e->getMessage();
}


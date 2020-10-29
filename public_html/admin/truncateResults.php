<?php
require_once('../db.php');

function truncateResults() {

	global $conn;

	$stmt = $conn->prepare('TRUNCATE TABLE answers');
	$stmt->execute();

}

truncateResults();
echo "\n".'Done';

?>
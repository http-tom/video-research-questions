<?php
require_once('../db.php');

function readVids() {
	$ret = array();
	if ($handle = opendir('../video/')) {

		while (false !== ($entry = readdir($handle))) {

			if ($entry != "." && $entry != ".." && $entry != ".gitkeep") {

				$ret[] = "$entry";
			}
		}

		closedir($handle);
	}

	return $ret;
}

function populateVids() {
	$vids = readVids();

	global $conn;

	$stmt = $conn->prepare('TRUNCATE TABLE videos');
	$stmt->execute();

	$stmt = $conn->prepare('INSERT INTO videos SET filename = :fn');

	foreach($vids as $v) {
		$stmt->bindParam(':fn', $v);
		$stmt->execute();
		echo "inserted {$v}\n";
	}
}

populateVids();
echo "\n".'Done';

?>
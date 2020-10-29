<?php
require_once('../db.php');

$stmt = $conn->prepare('SELECT * FROM videos order by filename asc');
$stmt->execute();
$vids = array();
while($row = $stmt->fetch(PDO::FETCH_OBJ)) {
    $vids[$row->id] = trim($row->filename);
}


$stmt = $conn->prepare('SELECT * FROM answers order by videoid asc');
$stmt->execute();
$answers = array();
while($row = $stmt->fetch(PDO::FETCH_OBJ)) {
	$row->filename = $vids[$row->videoid];
    $answers[] = $row;
}



header('Content-type: application/json');


$data = array();
$data['vids'] = $vids;
$data['answers'] = $answers;

echo json_encode($data);

?>
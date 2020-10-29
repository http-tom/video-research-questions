<?php
require_once('../db.php');

$stmt = $conn->prepare('SELECT * FROM videos');
$stmt->execute();
$vids = array();
while($row = $stmt->fetch(PDO::FETCH_OBJ)) {
    $vids[] = $row;
}


$stmt = $conn->prepare('SELECT * FROM answers');
$stmt->execute();
$answers = array();
while($row = $stmt->fetch(PDO::FETCH_OBJ)) {
    $answers[] = $row;
}



header('Content-type: application/json');


$data = array();
$data['vids'] = $vids;
$data['answers'] = $answers;

echo json_encode($data);

?>
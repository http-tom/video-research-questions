<?php
require_once('db.php');

$qs = isset($_POST['v']) ? $_POST['v'] : '[]';
$watched = json_decode($qs,true);

$stmt = $conn->prepare('SELECT * FROM videos order by id asc');
$stmt->execute();
$vids = array();
while($row = $stmt->fetch(PDO::FETCH_OBJ)) {
    $vids[] = $row;
}

header('Content-type: application/json');

$seen = true;
$idx = -1;
if(count($vids) == count($watched)) {
	$data = array('s'=>'done');
	echo json_encode($data);
	exit();
}
while($seen == true) {
	$idx = rand(0,count($vids)-1);
	//echo "\n[{$idx}]";
	if(!in_array($vids[$idx]->filename, $watched)) {
		// not seen this video
		$seen = false;
	}
}


$success = false;
$data = array();
if($idx > -1) {
	$data['v'] = $vids[$idx];
	$success = true;
} else {
	$data['v'] = -1;
	$success = false;
}
$data['s'] = $success;
echo json_encode($data);
?>
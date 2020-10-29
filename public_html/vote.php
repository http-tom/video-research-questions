<?php
header('Content-type: application/json');

$success = false;
if(!isset($_REQUEST['a']) || !isset($_REQUEST['c']) || !isset($_REQUEST['f'])) {
	//
} else {

	require_once('db.php');

	$ans = $_REQUEST['a'];
	$id = $_REQUEST['c'];
	$fn = $_REQUEST['f'];
	
	$ip = $_SERVER['REMOTE_ADDR'];
	$time = date('Y-m-d H:i:s');
	
	$stmt = $conn->prepare('SELECT * FROM videos where id = :1 and filename = :2');
	$stmt->bindParam(':1',$id);
	$stmt->bindParam(':2',$fn);
	$stmt->execute();
	$vids = array();
	$row = $stmt->fetch(PDO::FETCH_OBJ);
	if($row->id == $id) {
		$stmt = $conn->prepare('INSERT INTO answers set videoid = :1, ipaddr = :2, timeselected = :3, choicemade = :4');
		$stmt->bindParam(':1',$id);
		$stmt->bindParam(':2',$ip);
		$stmt->bindParam(':3',$time);
		$stmt->bindParam(':4',$ans);
		$stmt->execute();
	}
	
	$success = true;
}

$data = array();
$data['s'] = $success;
echo json_encode($data);
?>
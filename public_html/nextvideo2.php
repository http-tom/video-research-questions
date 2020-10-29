<?php
require_once('db.php');

class QACollection {

	// populate your question/answer array:
	// this is indexed by your question id part of the filename
	protected $questions = [
		1 => [
			'q' => 'Do you think this is real lip motion or animated?',
			'a1' => 'Real',
			'a2' => 'Animated'
		],
		2 => [
			'q' => 'Do you think this is real lip motion or animated?',
			'a1' => 'Real',
			'a2' => 'Animated'
		],
		3 => [
			'q' => 'Do you think this is real lip motion or animated?',
			'a1' => 'Real',
			'a2' => 'Animated'
		],
		4 => [
			'q' => 'Do you think this is real lip motion or animated?',
			'a1' => 'Real',
			'a2' => 'Animated'
		],
		5 => [
			'q' => 'Do you think this is real lip motion or animated?',
			'a1' => 'Real',
			'a2' => 'Animated'
		],
		6 => [
			'q' => 'Do you think this is real lip motion or animated?',
			'a1' => 'Real',
			'a2' => 'Animated'
		],
		7 => [
			'q' => 'Do you think this is real lip motion or animated?',
			'a1' => 'Real',
			'a2' => 'Animated'
		],
		8 => [
			'q' => 'Do you think this is real lip motion or animated?',
			'a1' => 'Real',
			'a2' => 'Animated'
		],
		9 => [
			'q' => 'Do you think this is real lip motion or animated?',
			'a1' => 'Real',
			'a2' => 'Animated'
		],
		10 => [
			'q' => 'Do you think this is real lip motion or animated?',
			'a1' => 'Real',
			'a2' => 'Animated'
		],
	];

	
	/**
	 * Gets question / answer ids from video filename
	 * Remove .mp4 and split by question/answer and return array [0] = question, [1] = answer
	 * @param string $video
	 * @return array
	 */
	public static function getQAfromVideo($video) {
		return $videoParts = explode('_',str_replace('.mp4','',$video));
	}



	
	/**
	 * Gets question and answer from video string.
	 * @param string $video
	 * @return array
	 */
	public function getQuestion($video) {
		$videoParts = self::getQAfromVideo($video);

		// question id / video id:
		$qid = $videoParts[0];
		$vid = $videoParts[1];

		return $this->questions[$qid];
	}


	/**
	 * Returns entire question/answer array
	 * @return array
	 */
	public function getQuestions() {
		return $this->quesions;
	}
}


// create question/answer object
$qobj = new QACollection();





// client passes videos that have been watched:
$qs = isset($_POST['v']) ? $_POST['v'] : '[]';
$watched = json_decode($qs,true);

// load all videos from database into $vids:
$stmt = $conn->prepare('SELECT * FROM videos order by id asc');
$stmt->execute();
$vids = array();
while($row = $stmt->fetch(PDO::FETCH_OBJ)) {
    $vids[] = $row;
}

// set header to json (so browser knows it is expecting json):
header('Content-type: application/json');




/////////////////////////////////////////////////////////////////////////////////////////////
// EDIT BELOW:


// you could limit the number of questions / videos here
// to get question/answer id's from video:
//$videoParts = $qobj::getQAfromVideo($row['filename']);


$seen = true;
$idx = -1;
// @TODO: determines if they've seen all videos - this needs to be changed:
if(count($vids) == count($watched)) {
	$data = array('s'=>'done');
	echo json_encode($data);
	exit();
}

while($seen == true) {
	$idx = rand(0,count($vids)-1);
	// determine if they've watched this video:
	// @TODO: process question / answer combinations to see if they've watched all videos that you need them to
	if(!in_array($vids[$idx]->filename, $watched)) {
		// not seen this video
		$seen = false;
	}
}


// END SECTION TO EDIT ///////////////////////////////////////////////////////////////////////






// process data for return (do not think you need to change this):
$success = false;
$data = array();
if($idx > -1) {
	$data['v'] = $vids[$idx];
	$question = $qobj->getQuestion($vids[$idx]->filename);
	$data['question'] = $question['q'];					// the question
	$data['question_ans1'] = $question['a1'];			// answer1 to question - could pose different answers to each question
	$data['question_ans2'] = $question['a2'];			// answer2 to question
	$success = true;
} else {
	$data['v'] = -1;
	$data['question'] = '';
	$data['question_ans1'] = '';
	$data['question_ans2'] = '';
	$success = false;
}
$data['s'] = $success;
echo json_encode($data);
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<title>Which animation do you prefer?</title>
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta name="description" content="">
	<meta name="author" content="">

	<link href="./css/bootstrap.css" rel="stylesheet">
	<style>
		body {
			padding-top: 60px;
		}
		label {
			font-size:18px;
		}
		.btn-start {
			margin: 2em auto;
			padding: 2em 4em;
			font-size: x-large;
			font-weight: bold;
		}
		.center {
			text-align: center;
		}
	</style>
	<link href="./css/bootstrap-responsive.css" rel="stylesheet">
</head>

<body>
	<div id="top"></div>
	<div class="modal hide" id="aboutmodal">
		<div class="modal-header"><h3>About</h3><button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button></div>
		<div class="modal-body"><p>@TODO: give a brief description of what you are doing</p></div>
		<div class="modal-footer"><a class="btn btn-primary" data-dismiss="modal">Close</a></div>
	</div>
    <div class="navbar navbar-inverse navbar-fixed-top">
      <div class="navbar-inner">
        <div class="container">
          <button type="button" class="btn btn-navbar" data-toggle="collapse" data-target=".nav-collapse">
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
          <a class="brand" href="./"></a>
          <div class="nav-collapse collapse">
            <ul class="nav">
              <li class="active"><a href="/">Home</a></li>
              <li><a href="#about" data-toggle="modal" data-target="#aboutmodal">About</a></li>
              <li><a href="mailto:@TODO:EMAIL_ADDRESS_HERE">Contact</a></li>
            </ul>
          </div>
        </div>
      </div>
    </div>

    <div class="container center">
		<div class="row-fluid">
		<div class="span12">
			<button type="button" class="btn btn-primary btn-large btn-start">Start</button>
			<div id="votingpanel" class="hide">
				<h1>Which animation do you prefer?</h1>
				<p>We are experimenting with different facial animation techniques.</p>
				<p class="lead">Please watch this video <strong>with your sound on</strong> and answer the question below.</p>
				<p>Videos can be viewed multiple times by clicking play before submitting your answer.</p>
			
				<div class="well">
					<video width="900" height="440" controls id="mainPlayer">
						<source src="" type="video/mp4" id="movie1">
						Your browser does not support the video tag.
					</video>
				
					<div class="answerscontainer">
						<p class="lead question">Do you prefer the left or right animation?</p>
						<div class="row-fluid">
							
							<div class="offset4 span2" style="text-align:center;">
								<input type="radio" name="answer" value="1" id="answer1" /> <label for="answer1" id="question_ans1">Left</label>
							</div>
							<div class="span2" style="text-align:center;">
								<input type="radio" name="answer" value="0" id="answer0" /> <label for="answer0" id="question_ans2">Right</label>
							</div>
						</div>
					</div>
					<div class="row-fluid">
						<div class="span12" style="text-align:center;">
							<a class="btn btn-primary btn-vote">Continue</a>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
 
<script src="./js/jquery-1.12.2.min.js"></script>
<script src="./js/bootstrap.min.js"></script>
<script>
var v = [];
var cid = -1;
var cfn = '';
$(document).ready(function() {
	$('.btn-vote').on('click',function() {
		var postdata = {
			'a':$('input[name="answer"]:checked').val(),
			'c':cid,
			'f':cfn
		};
		if(postdata.a != "1" && postdata.a != "0") {
			alert("Please select an answer!");
			return false;
		}
		$.ajax({
			url		:	'./vote.php',
			data	:	postdata,
			type	:	'POST',
			dataType :  'json'
		}).done(function(response){
			if(response.s){
				getNext();
				$("#answer1").prop("checked", false);
				$("#answer0").prop("checked", false);
			}else{
				alert("Sorry, there was an error");
			}
		}).error(function(x,y,z) { alert('Sorry, there was an error'); });
	});

	$('.btn-start').on('click',function() {
		$(this).slideUp();
		$('#votingpanel').slideDown();
		setTimeout(function() {
			getNext();
		}, 750);
	});
});

function getNext() {
	var postdata = {
		'v':JSON.stringify(v)
	};
	$.ajax({
		url	:	'./nextvideo.php',
		data	:	postdata,
		type	:	'POST',
		dataType :  'json'
	}).done(function(response){
		if(response.s){
			if(response.s == 'done') {
				$("html, body").animate({ scrollTop: 0 }, "slow");
				$("#votingpanel").fadeOut();
				setTimeout(function() { $("#votingpanel").html('<h1>All Done! Thank you!</h1>').fadeIn(); },1000);
				return;
			}
			v.push(response.v.filename);
			$("#movie1").attr('src','./video/'+response.v.filename);
			if(typeof response.question !== 'undefined' && response.question.length > 0) {
				$('.question').text(response.question);
				if(response.question_ans1.length > 0) {
					$('#question_ans1').text(response.question_ans1);
				}
				if(response.question_ans2.length > 0) {
					$('#question_ans2').text(response.question_ans2);
				}
			}
			cid = response.v.id;
			cfn = response.v.filename;
			var myVideo = document.getElementById("mainPlayer"); 
			myVideo.load();
			myVideo.play();
		}else{
			alert("Sorry, there was an error");
		}
	}).error(function(x,y,z) { alert('Sorry, there was an error'); });
}
</script>

</body>
</html>

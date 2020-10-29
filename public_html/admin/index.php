<!DOCTYPE html>
<html lang="en">
	<head>
	<meta charset="utf-8">
	<title>Research Admin</title>
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta name="description" content="">
	<meta name="author" content="">

	<link href="../css/bootstrap.css" rel="stylesheet" />
	<link href="../css/bootstrap-responsive.css" rel="stylesheet" />
	<style>
		body {
			padding-top: 60px;
		}
		label {
			font-size:18px;
		}

		li { list-style-type: none; }
	</style>
</head>
<body>
	<div class="container">
		<div class="row-fluid">
			<div class="span12">
				<h1>Admin</h1>
				<div class="well">

					<p>Upload videos to /video directory first of all. Delete any that are in there/rename folder if running new experiment.</p>
					<p>To get results:
					one may be easier to work with than the other, they
					output slightly different things, second one includes
					ordering by video filename and includes the filename in
					with the answers, whereas the first is more of a data dump</p>
					<ul>
						<li><h3>Get results</h3></li>
						<li><a href="./getResults.php">Get Results 1</a></li>
						<li><a href="./getResults2.php">Get Results 2</a></li>
						<li><h3>Populate / Truncate</h3></li>
						<li><a href="./populatevids.php">Populate Videos</a> - Once videos have been uploaded, run this to store in database</li>
						<li><a href="./truncateResults.php">Truncate Results</a> - WARNING! This will delete all results stored in the database!</li>
					</ul>
				</div>
			</div>
		</div>
	</div>
</body>
</html>
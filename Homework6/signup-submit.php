<!DOCTYPE html>

<!-- Include boilerplate -->
<?php include 'common.php' ?>

<!-- Handle form data -->
<?php
	// Get values
	$name = $_POST["name"];
	$gid = $_POST["gid"];
	$age = $_POST["age"];
	$mbti = $_POST["mbti"];
	$os = $_POST["os"];
	$apMin = $_POST["ap-min"];
	$apMax = $_POST["ap-max"];
	$gpList = $_POST["gp"];

	// Open data file
	$singles = fopen("data/singles.txt", "a");

	// Generate profile
	$profile = $name . ",";

	// Append GID
	foreach ($gid as $id) {
		$profile .= $id;
	}

	// Append other user data
	$profile .= "," . $age . "," . $mbti . "," . $os . "," . $apMin . "," . $apMax . ",";

	// Append gender preferences
	foreach($gpList as $item) {
		$profile .= $item;
	}
	// Append new line
	$profile .= "\n";

	// Write to file
	fwrite($singles, $profile);
	fclose($singles);
?>

<html>
	<head>
		<title>GeekLuv</title>
		<meta charset="utf-8" />
		<link href="img/heart.gif" type="image/gif" rel="shortcut icon" />
		<link href="css/geekluv.css" type="text/css" rel="stylesheet" />
	</head>

	<body>

		<!-- Echo header -->
    <?php EchoHeader(); ?>

		<div>
			<h1>ACCOUNT CREATED</h1>

			Welcome to NerdLuv, <?php echo $_POST["name"]; ?>!
			<br />

 			<a href="matches.php">See your potential matches here.</a>
		</div>

		<!-- Echo footer -->
	  <?php EchoFooter(); ?>
	</body>
</html>

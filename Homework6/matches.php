<!DOCTYPE html>

<!-- Include boilerplate -->
<?php include 'common.php' ?>

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
			<h1>MATCHES</h1>
			<form action="matches-submit.php" method="get">
				<fieldset>
					<legend>View your matches:</legend>
					<!-- Name -->
					<div>
						Name:
						<input type="text" name="name" size="16"/>
						<br />
						<span class="error">
						</span>
					</div>
				</fieldset>
				<br />
				<input type="submit" value="Check"/>
			</form>
		</div>

    <!-- Echo footer -->
    <?php EchoFooter(); ?>
  </body>
</html>

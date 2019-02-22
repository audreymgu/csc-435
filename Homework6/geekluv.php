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
			<h1>Welcome!</h1>

			<ul>
				<li>
					<a href="signup.php">
						<img src="img/heartbig.gif" alt="icon" />
						Sign up for a new account
					</a>
				</li>

				<li>
					<a href="matches.php">
						<img src="img/heartbig.gif" alt="icon" />
						Check your matches
					</a>
				</li>
			</ul>
		</div>

		<!-- Echo footer -->
	  <?php EchoFooter(); ?>
	</body>
</html>

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
			<h1>SIGN-UP</h1>
			
			<form action="signup-submit.php" method="post" enctype="multipart/form-data">

				<fieldset>
					<legend>Create an account:</legend>

					<!-- Name -->
					<div>
						<strong>Name:</strong>
						<input type="text" name="name" size="16"/>
						<span class="error">
						</span>
					</div>

					<!-- GID -->
					<div>
						<strong>Gender Identity:</strong>
						<label><input type="checkbox" name="gid[]" value="mp" />Masculine</label>
						<label><input type="checkbox" name="gid[]" value="fp" />Feminine</label>
						<label><input type="checkbox" name="gid[]" value="nb" />Non-binary</label>
						<span class="error">
						</span>
					</div>

					<!-- Age -->
					<div>
						<strong>Age:</strong>
						<input type="text" name="age" size="6" maxlength="3" />
						<span class="error">
						</span>
					</div>

					<!-- MBTI -->
					<div>
						<strong><a href="http://www.humanmetrics.com/cgi-win/JTypes2.asp">
							MBTI Personality Type:
						</a></strong>
						<br />
						<input type="text" name="mbti" size="6" maxlength="4" />
						<span class="error">
						</span>
					</div>

					<!-- OS -->
					<div>
						<strong>Preferred OS:</strong>
						<select name="os">
					    <option value="win">Windows</option>
					    <option value="mac">macOS</option>
					    <option value="lin">Linux</option>
					  </select>
						<span class="error">
						</span>
					</div>

					<!-- Seeking -->
					<div>
						Seeking...
						<br />
						<strong>Age:</strong>
						<input type="text" name="ap-min" value="min"  size="6" maxlength="3" />
						to
						<input type="text" name="ap-max" value="max"  size="6" maxlength="3" />
						<br />
						<strong>Gender:</strong>
						<input type="checkbox" name="gp[]" value="mp">
						Masculine
						<input type="checkbox" name="gp[]" value="fp">
						Feminine
						<input type="checkbox" name="gp[]" value="nb">
						Non-binary
						<span class="error">
						</span>
					</div>
				</fieldset>

				<br />
				<input type="submit" value="Sign Up"/>
			</form>
		</div>

		<!-- Echo footer -->
	  <?php EchoFooter(); ?>
	</body>
</html>

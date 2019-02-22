<!DOCTYPE html>
<html>

	<head>
		<title>PHP Quiz</title>
	</head>

	<body>
	<?php
		if ($_SERVER["REQUEST_METHOD"] == "POST") {

			// define required fields
			$require = array("studentname", "id", "email", "assignment", "cheat");

			// declare form state variables
			$incomplete = $invalid = $submitted = false;

			// declare error state variables
			$studentErr = $idErr = $emailErr = $assignmentErr = $fileErr = false;

			// check for empty fields
			foreach($require as $field) {
				if(empty($_POST[$field])) {
					$incomplete = true;
					echo "One or more required fields was left empty. Please fill out all fields before attempting to submit.";
					break;
				}
			}

			if (!isset($_FILES["code"])) {
				$incomplete = true;
				echo "You did not upload a file. Please try again.";
			}

			// validate user input
			if (!$incomplete) {
				// validate name
				$studentStr = (string)$_POST["studentname"];
				if (!preg_match("/[A-Z][a-zA-Z]+ [A-Z][a-zA-Z]+/", $studentStr)) {
					$invalid = true;
					$studentErr = true;
				}

				// validate id
				$idStr = (string)$_POST["id"];
				if (!preg_match("/[0-9]{7}/", $idStr)) {
					$invalid = true;
					$idErr = true;
				}

				// validate email
				$emailStr = (string)$_POST["email"];
				if (!preg_match("/[a-zA-Z]{2}\d{4}a@student.american.edu/", $emailStr)) {
					$invalid = true;
					$emailErr = true;
				}

				// check for valid file upload
				if ($_FILES["code"]["error"] !== 0) {
					$invalid = true;
					echo "There was an error with your file submission. Please try again.";
				}

				// validate filename
				$fileStr = (string)$_FILES["code"]["name"];
				if (!preg_match("/[a-z]+_[a-z]+_hw[1-3]{1}\.zip/", $fileStr)) {
					$invalid = true;
					$fileErr = true;
				}
			}

			// Get form values
			if (!$incomplete && !$invalid) {
				// get name
				$student = $_POST["studentname"];

				//get id
				$id = $_POST["id"];

				// get email
				$email = $_POST["email"];

				// get assignnment
				$assignmentNum = $_POST["assignment"];

				// get cheating status
				$didCheat = $_POST["cheat"];

				// get temporary filename
				$tempName = $_FILES["code"]["tmp_name"];

				// get actual filename
				$fileName = $_FILES["code"]["name"];

				// set upload directory
				// $uploadDir = "/opt/lampp/htdocs/quiz1/submissions/";

				// move file to dedicated storage directory
				// move_uploaded_file($tempName, $uploadDir . $fileName);

				$submitted = true;
			}
		}
	?>

	<h1>CSC 435: PHP Quiz</h1>
	<p>All fields are required.</p>
			<form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="post" enctype="multipart/form-data">

				<fieldset>
					<legend>Personal Information</legend>
					<div>
						Name: <input type="text" name="studentname" />
						<span class="error">
							<?php
								if ($studentErr) {
									echo "Please enter a valid name.";
								}
							?>
						</span>
					</div>
					<div>
						Student ID: <input type="text" name="id" maxlength="7" />
						<span class="error">
							<?php
								if ($idErr) {
									echo "Please enter a valid student ID.";
								}
							?>
						</span>
					</div>

					<div>
						Student Email: <input type="text" name="email"/>
						<span class="error">
							<?php
								if ($idErr) {
									echo "Please enter a valid student email.";
								}
							?>
						</span>
					</div>
				</fieldset>

				<fieldset>
					<legend>Assignment Information</legend>
					<div>
						Assignment:
						<label><input type="radio" name="assignment" value="1" /> 1</label>
						<label><input type="radio" name="assignment" value="2" /> 2</label>
						<label><input type="radio" name="assignment" value="3" /> 3</label>
						<span class="error">
							<?php
								if ($assignmentErr) {
									echo "Please choose a valid assignment designation";
								}
							?>
						</span>
					</div>

					<div>
						Code:
						<input type="file" name="code" />
						<span class="error">
							<?php
								if ($fileErr) {
									echo "Please use a valid filename.";
								}
							?>
						</span>
					</div>
				</fieldset>

				<div>
					<input type="checkbox" name="cheat"/> I promise I didn't cheat!
				</div>
				<input type="submit" />
			</form>

	<?php
		if ($submitted) {
			echo "<h2>Your Input:</h2>";
			echo "Name: " . $student;
			echo "<br>";
			echo "ID: " . $id;
			echo "<br>";
			echo "Email: " . $email;
			echo "<br>";
			echo "Assignment Submitted: " . $assignmentNum;
			echo "<br>";
			echo "Filename: " . $fileName;
			echo "<br>";
		}
	?>
	</body>
</html>

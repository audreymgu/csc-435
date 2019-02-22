<!DOCTYPE html>

<!-- Include boilerplate -->
<?php include 'common.php' ?>

<!-- Page functions -->
<?php
	function Setup($name) {
		// Retrive list of singles
		$pool = file("data/singles.txt", FILE_IGNORE_NEW_LINES);
		// Create array to hold profiles to be searched
		$indexList = [];
		// Find user and generate search list
		foreach ($pool as $line=>$person) {
			// Get cudata from set-uprrent profile
			$profile = explode(",", $person);
			if ($profile[0] == $name) {
				// Get values for user
				$userProfile = $profile;
				$userIndex = $line;
				// Get gender identification(s) of user
				$userGID = str_split($userProfile[1], 2);
				// Get gender preference(s) of user
				$userGP = str_split($userProfile[7], 2);
			} else {
				array_push($indexList, $line);
			}
		}
		return [$userProfile, $userGID, $userGP, $indexList];
	}

	function FindMatches($setupData) {
		// Retrive list of singles
		$pool = file("data/singles.txt", FILE_IGNORE_NEW_LINES);
		// Unpack setup data
		$userProfile = $setupData[0];
		$userGID = $setupData[1];
		$userGP = $setupData[2];
		$indexList = $setupData[3];
		// Create container to hold matches
		$matches = [];
		// Check for matches
		foreach ($indexList as $index) {
			// Create match booleans
			$gidMatch	= $ageMatch = $mbtiMatch = $osMatch = false;

			// Get values for current profile
			$currentProfile = [];
			$currentProfile = explode(",", $pool[$index]);

			// Get gender identification(s) of current profile
			$currentGID = str_split($currentProfile[1], 2);

			// Get gender preference(s) of current profile
			$currentGP = str_split($currentProfile[7], 2);

			// GID match
			if (count(array_intersect($userGID, $currentGP)) && count(array_intersect($currentGID, $userGP))) {
				$gidMatch = true;
			} else {
				continue;
			}

			// Age match
			if ($currentProfile[2] > $userProfile[5] && $currentProfile[2] < $userProfile[6]) {
				$ageMatch = true;
			} else {
				continue;
			}

			// MBTI match
			$currentMBTI = str_split($currentProfile[3]);
			foreach ($currentMBTI as $typeIndicator) {
				if (strpos($userProfile[3], $typeIndicator) !== false) {
					$mbtiMatch = true;
				}
			}

			// OS match
			if ($userProfile[4] == $currentProfile[4] || ($userProfile[4] == "mac" && $currentProfile[4] == "lin") || ($currentProfile[4] == "mac" && $userProfile[4] == "lin")) {
				$osMatch = true;
			} else {
				continue;
			}

			// Complete match
			if($gidMatch && $ageMatch && $mbtiMatch && $osMatch) {
				array_push($matches, $pool[$index]);
			}
		}
		return $matches;
	}

	function DisplayMatches($matches) {
		foreach ($matches as $person) {
			$properties = explode(",", $person);
			$matchGID = str_split($properties[1], 2);

			// Display text for single identity
			if ($matchGID[0] == "fp") {
				$gender = "Feminine";
			} else if ($matchGID[0] == "mp") {
				$gender = "Masculine";
			} else if ($matchGID[0] == "nb"){
				$gender = "Non-binary";
			}

			// Display text for multiple identities
			if (count($matchGID) > 1) {
				for ($i = 1; $i < count($matchGID); $i++) {
					$gender .= " and ";
					if ($matchGID[$i] == "fp") {
						$gender .= "Feminine";
					} else if ($matchGID[$i] == "mp") {
						$gender .= "Masculine";
					} else if ($matchGID[$i] == "nb"){
						$gender .= "Non-binary";
					}
				}
			}

			// Display text for preferred OS
			if ($properties[4] == "lin") {
				$os = "Linux";
			} else if ($properties[4] == "mac") {
				$os = "macOS";
			} else {
				$os = "Windows";
			}

			// Render HTML
			echo "<div class=\"match\">
							<p>
								<img class=\"match\" src=\"img/user_"
								. $matchGID[0] . ".png\"; />"
								. $properties[0] .
							"</p>";

			echo		"<ul>
								<strong><li>Gender:</li></strong>
								<li>" . $gender . "</li>
								<strong><li>Age:</li></strong>
								<li>" . $properties[2] . "</li>
								<strong><li>Type:</li></strong>
								<li>" . $properties[3] . "</li>
								<strong><li>Preferred OS:</li></strong>
								<li>" . $os . "</li>
							</ul>
						</div>";
		}
	}
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
			<h1>MATCHES</h1>
			<h2>Matches for <?= $_GET['name']; ?></h2>
			<!-- Matches -->
			<?php
				$userData = Setup($_GET['name']);
				$matches = FindMatches($userData);
				DisplayMatches($matches);
			?>
		</div>

    <!-- Echo footer -->
    <?php EchoFooter(); ?>
  </body>
</html>

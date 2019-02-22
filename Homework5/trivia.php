<?php
  // Parameters
  $q = $_GET["q"];
  $splitParams = explode("_", $q);

  // Location of trivia
  $triviafiles = "trivia/";

  // Load categories
  if ($splitParams[0] == "load") {
    $categories = glob($triviafiles . "/*");
    foreach ($categories as $section) {
      echo basename($section) . " ";
    }
  }

  // Load questions
  if ($splitParams[0] == "sel") {
    $categoryName = $splitParams[1];
    $triviaQuestions = glob($triviafiles . $categoryName . "/*.txt");

    // Keep track of processed questions
    $counter = 0;

    // Create question stack
    $stack = array();

    // Respond with all questions from a given category
    foreach ($triviaQuestions as $questionPair) {
      $rawText = file_get_contents($questionPair);
      $splitText = explode("\n", $rawText);
      $questionObj = array(
        "question" => (string)$splitText[0],
        "answer" => (string)$splitText[1],
      );
      array_push($stack, $questionObj);
      $counter++;
    }

    // Convert array to JSON string
    $jsonStack = json_encode($stack);

    // Return JSON string
    echo $jsonStack;
  }

?>

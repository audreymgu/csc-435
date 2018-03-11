'use strict';

window.onload = function() {

  // Get key HTML elements
  var computeButton = document.getElementById("compute");
  var clearButton = document.getElementById("clear");
  var haveMercy = document.getElementById("curve");
  var resultsArea = document.getElementById("resultsarea");

  computeButton.onclick = function() {
    // Compute the final average
    let result = ComputeClick();

    // Add five to the final average if curving is selected
    if (haveMercy.checked) {
      result += 5;
    };

    // Create a div, resultElement, to store the final average
    let resultElement = document.createElement("div");

    // Add the average as a paragraph element to resultElement
    resultElement.innerHTML = "<p>"+result+"</p>";

    // Class resultElement based on whether the score is above an arbitrary threshold
    if (result >= 60) {
      resultElement.className += 'pass';
    } else {
      resultElement.className += 'fail';
    }

    // Add resultElement to resultsArea
    resultsArea.appendChild(resultElement);
  };

  clearButton.onclick = function() {
    ClearClick();
  };
}

function ComputeClick() {
  let earnedList = document.querySelectorAll("input.earned");
  let maxList = document.querySelectorAll("input.max");
  let sum = 0;
  let finalAverage = 0;

  // Calculate individual scores
  for (let i = 0; i < earnedList.length; i++) {
    let currentScore = earnedList[i].value / maxList[i].value;
    scoreList.push(currentScore);
  };

  // Find the final average
  for (let i = 0; i < scoreList.length; i++) {
    sum += scoreList[i];
  };

  // Convert score to non-decimal form and round off
  finalAverage = (sum / scoreList.length) * 100;
  finalAverage = Math.round(finalAverage);

  return finalAverage;
}

function ClearClick() {
  let earnedList = document.querySelectorAll("input.earned");
  let maxList = document.querySelectorAll("input.max");

  // Clear all entered values
  for (let i = 0; i < earnedList.length; i++) {
    earnedList[i].value = "";
    maxList[i].value = "";
  };
}

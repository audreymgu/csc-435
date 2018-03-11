'use strict';

window.onload = function() {

	// Get key HTML elements
	var input = document.getElementById("input");
	var result = document.getElementById("result");
	var button = document.getElementById("submit");

	input.onchange = function() {
		let inputList = input.value;
		let countDict = {};
		let topKey = "";
		let topValue = 0;

		// Split user input by whitespace
		inputList = inputList.split(" ");

		// Find unique array items, count occurences, and store results
		for (var i = 0; i < inputList.length; i++) {
			let currentValue = inputList[i];
			if (!(currentValue in countDict)) {
				countDict[currentValue.toString()] = 1;
			} else {
				countDict[currentValue.toString()] += 1;
			};
		};

		// Determine the most frequent array item
		for (let [key, value] of Object.entries(countDict)) {
			let currentKey = key;
			let currentValue = value;
			if (currentValue > topValue) {
				topKey = key;
				topValue = value;
			};
		};

		// Display the final result
		result.innerHTML = topKey;
	};
};

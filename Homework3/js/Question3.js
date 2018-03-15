'use strict';

window.onload = function() {
	
	// Get key HTML elements
	var computeButton = document.getElementById("compute");
	var clearButton = document.getElementById("clear");
	var subtotal = document.getElementById("subtotal");
	var percentage = document.getElementById("percentage");
	var percentageSlider = document.getElementById("percentageSlider");
	var resultsArea = document.getElementById("results");

	computeButton.onclick = function() {
		// Compute the final total
		let result = ComputeClick();

		// Display the final total
		resultsArea.innerHTML = result;
	};

	clearButton.onclick = function() {
		ClearClick();
	};
	
	percentage.onchange = function() {
		if (parseFloat(percentage.value) < 15) {
			if (! percentage.classList.contains('fail')) {
				percentage.classList.toggle('fail');
			}
		} else if (parseFloat(percentage.value) > 15) {
			if (percentage.classList.contains('fail')) {
				percentage.classList.toggle('fail');
			}
		}
	}
	
	percentageSlider.onchange = function() {
		let percentValue = percentageSlider.value;
		percentage.value = percentValue;
		if (parseFloat(percentage.value) < 15) {
			if (! percentage.classList.contains('fail')) {
				percentage.classList.toggle('fail');
			}
		} else if (parseFloat(percentage.value) > 15) {
			if (percentage.classList.contains('fail')) {
				percentage.classList.toggle('fail');
			}
		}
	}
}

function ComputeClick() {
	let tip = subtotal.value * (parseFloat(percentage.value) / 100);
	let finalTotal = Math.round((parseFloat(subtotal.value) + parseFloat(tip)) * 100) / 100;
	return finalTotal;
}

function ClearClick() {
  let inputList = document.querySelectorAll("input");

  // Clear all entered values
  for (let i = 0; i < inputList.length; i++) {
    inputList[i].value = "";
  };
}

'use strict';

// Set up values for our sine function
var counter = 0;
var amp = 100;
var freq = 0.05;
var scaleFactor = 1;

window.onload = function() {
  // Call mover function
  moveWrapper();
}

document.onkeydown = function() {
  checkKey();
}

function checkKey(e) {
  // Get desired element
  let theSelf = document.getElementById('the-self');
  var hSize = 50;
  var wSize = 50;
  var radius = 25;
  theSelf.style.height = hSize + "px";
  theSelf.style.width = wSize + "px";
  theSelf.style.borderRadius = radius + "px";
  
  e = e || window.event;
  
  if (e.which == '88') {
    freq += 0.005;
  } else if (e.which == '90') {
    freq -= 0.005;
  } else if (e.which == '86') {
    hSize = hSize * scaleFactor;
    wSize = wSize * scaleFactor;
    radius = radius * scaleFactor;
    theSelf.style.height = hSize + "px";
    theSelf.style.width = wSize + "px";
    theSelf.style.borderRadius = radius + "px";
    scaleFactor++;
  } else if (e.which == '67') {
    scaleFactor--;
    hSize = hSize * scaleFactor;
    wSize = wSize * scaleFactor;
    radius = radius * scaleFactor;
    theSelf.style.height = hSize + "px";
    theSelf.style.width = wSize + "px";
    theSelf.style.borderRadius = radius + "px"; 
  }
}

function moveWrapper (moveStyle) {
  // Get desired element
  let theSelf = document.getElementById('the-self');
  
  // Cofigure animation speed
  let id = setInterval(move, 1);
  
  // Initialize styling properties
  let left = 175;
  theSelf.style.left = left + 'px';
  
  function move() {
    // Configure our glorious sine wave
    let sineValue = (Math.sin(freq * counter) + 1) / 2;
    let position = sineValue * amp;
    
    // Modify element position
    theSelf.style.bottom = position + 'px';
    
    // Increment counter
    counter++;
    
    //Decrease amplitude to zero
    if (moveStyle == 'decay' && amp > 0) {
      amp--;
    }
    
    // Move element off-stage
    if (moveStyle == 'offstage') {
      if (left < 350) {
        left += 10;
        theSelf.style.left = left + 'px';
      } else {
        theSelf.style.visibility = 'hidden';
      }  
    } 
  }
}
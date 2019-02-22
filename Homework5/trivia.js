'use strict';

(function() {
  // Keep track of remaining questions
  let questionPool = [];
  // Keep track of answer to current question
  let answer;
  let answerDisplay = false;
  // Temporary holding space for JSON data
  let temp;

  window.onload = function() {
    // Get page elements
    let catView = document.getElementById("category-view");
    let catBtn = document.getElementById("view-all");
    let questionBtn = document.getElementById("next");
    let revealBtn = document.getElementById("reveal");

    // Load categories on request
    catBtn.onclick = function () {
      LoadCategories();
      // Show categories
      ToggleVisibility(catView);
      // Hide category button
      ToggleVisibility(catBtn);
    }

    // Load new question on request
    questionBtn.onclick = function () {
      RenderQuestion(temp, false);
    }

    revealBtn.onclick = function () {
      RenderAnswer();
    }

  }

  function LoadCategories() {
    // Get DOM element for node insertion
    let catHTML = document.getElementById("categories");
    // Use XMLHttpRequest to get an updated category list
    let loadReq = new XMLHttpRequest;
    loadReq.open("GET","trivia.php?q=load", true);
    loadReq.send();
    loadReq.onload = function () {
      let response = loadReq.responseText;
      let categories = response.split(" ");
      categories.forEach(function(item) {
        // Render item HTML
        let renderItem = document.createElement("li");
        renderItem.appendChild(document.createTextNode(item));
        catHTML.appendChild(renderItem);
        // Make categories selectable
        renderItem.onclick = function() {
          // Load category questions
          SelectCategory(renderItem.innerHTML);
        }
      });
    }
  }

  function SelectCategory(selection) {
    let questionView = document.getElementById("question-view");
    let selReq = new XMLHttpRequest;
    selReq.open("GET","trivia.php?q=sel_" + selection);
    selReq.send();
    selReq.onload = function () {
      // Convert response to JSON object
      let response = selReq.responseText;

      // Temporarily hold question data
      temp = JSON.parse(response);

      // Make question area visible
      if (questionView.classList.contains("hidden")) {
        ToggleVisibility(questionView);
      }

      // Render question
      RenderQuestion(temp, true);
    }
  }

  function RenderQuestion(data, reset) {
    let cardHTML = document.getElementById("card");

    // Reset question pool if new category is loaded
    if (reset) {
      questionPool.length = 0;
      for (let i = 0; i < data.length; i++) {
        questionPool.push(i);
      }
    }

    // Render a new question if still available
    if (questionPool.length !== 0) {
      // Choose question and answer pair
      let random = Math.floor(Math.random() * Math.floor(questionPool.length));
      let selQuestion = data[questionPool[random]].question;
      let selAnswer = data[questionPool[random]].answer;

      // Store answer to current question;
      answer = selAnswer;

      // Render question
      let renderQuestion = document.createElement("p");
      renderQuestion.appendChild(document.createTextNode(selQuestion));
      cardHTML.innerHTML = "";
      cardHTML.appendChild(renderQuestion);
      answerDisplay = false;

      // Ensure question does not spawn again
      questionPool.splice(random, 1);
    } else {
      let completionErr = document.createElement("p");
      completionErr.appendChild(document.createTextNode("No more questions in this category!"));
      cardHTML.innerHTML = "";
      cardHTML.appendChild(completionErr);
    }
  }

  function RenderAnswer() {
    if (!answerDisplay) {
      let cardHTML = document.getElementById("card");
      let renderAnswer = document.createElement("p");
      renderAnswer.appendChild(document.createTextNode(answer));
      cardHTML.appendChild(renderAnswer);
      answerDisplay = true;
    }
  }

  function ToggleVisibility(elem) {
    elem.classList.toggle("hidden");
  }
})();

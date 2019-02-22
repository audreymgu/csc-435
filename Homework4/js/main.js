window.onload = function() {
  document.getElementById("shufflebutton").onclick = function () {
    Shuffle();
  }

  Initialize();

}

function Initialize() {
  let gameArea = document.getElementById("puzzle-area");
  gameArea.addEventListener('click', Feeder, false);
  gameArea.addEventListener('click', Checker, false);

  for (let i = 0; i < 15; i++) {
    let piece = document.createElement("div");
    let paragraph = document.createElement("p");
    let number = document.createTextNode(i+1);
    paragraph.appendChild(number);
    piece.appendChild(paragraph);
    piece.classList.add("puzzle-piece");
    piece.setAttribute("id", "number" + i);
    gameArea.appendChild(piece);
  }

  let emptySpace = document.createElement("div");
  emptySpace.setAttribute("id", "empty-piece");
  gameArea.appendChild(emptySpace);

  let pieceArray = document.querySelectorAll(".puzzle-piece");

  for (let counter = 0; counter < 15;) {
    for (let i = 0; i < 4; i++) {
      for (let j = 0; j < 4; j++) {
        pieceArray[counter].style.backgroundPosition = j * -100 + "px " + i * -100 + "px";
        counter += 1;
      }
    }
  }
}

function Shuffle() {
  let emptyPiece = document.getElementById("empty-piece");
  let pieces = document.getElementById("puzzle-area").childNodes;
  let emptyIndex = null;

  for (let i = 0; i < 1000; i++) {

    for (let i = 1; i < 17; i++) {
      if (pieces.item(i).id == "empty-piece") {
        emptyIndex = i;
      }
    }

    neighbors = [pieces.item(emptyIndex - 1), pieces.item(emptyIndex+1), pieces.item(emptyIndex - 4), pieces.item(emptyIndex + 4)];

    if ((emptyIndex - 1) % 4 == 0) {
      neighbors.splice(0, 1);
    } else if ((emptyIndex) % 4 == 0) {
      neighbors.splice(1, 1);
    }

    if (emptyIndex == 1 || emptyIndex == 4) {
      neighbors.splice(1, 1);
    }

    validNeighbors = neighbors.filter(Boolean);

    let randomNeighbor = Math.floor(Math.random() * (validNeighbors.length));

    let selectedPiece = validNeighbors[randomNeighbor];

    Swap(selectedPiece.childNodes[0]);
  }
}

function Feeder(e) {
  Swap(e.target);
}

function Checker() {
  let pieces = document.getElementById("puzzle-area").childNodes;
  let winInject = document.getElementById("output");
  let validationArr = [];
  let winState = ["0", "1", "2", "3", "4", "5", "6", "7", "8", "9", "10", "11", "12", "13", "14", "piece"];
  pieces.forEach(function(item) {
    let identity = item.id;
    validationArr.push(identity);
  });

  validationArr.splice(0,1);

  for (let i = 0; i < validationArr.length; i++) {
    newIdentifier = validationArr[i].substring(6);
    validationArr.splice(i, 1, newIdentifier);
  }

  if (JSON.stringify(validationArr) === JSON.stringify(winState)) {
    console.log("WIN");
    console.log(validationArr, winState);
    winInject.innerHTML = "";
    let text = document.createTextNode("You Win!");
    let paragraph = document.createElement("p");
    paragraph.appendChild(text);
    paragraph.classList.add("win-text");
    winInject.appendChild(paragraph);

    return true;
  } else {
    // console.log("NO WIN");
    // console.log(validationArr, winState);
    return false;
  }

}

function Swap(clicked) {
  let clickedPiece = clicked;
  let emptyPiece = document.getElementById("empty-piece");
  let pieces = document.getElementById("puzzle-area").childNodes;
  let clickedIndex = null;
  let emptyIndex = null;

  for (let i = 1; i < 17; i++) {
    if (pieces.item(i).id == "empty-piece") {
      emptyIndex = i;
    } else if (pieces.item(i).id == clickedPiece.parentElement.id) {
      clickedIndex = i;
    }
  }

  if (clickedIndex == (emptyIndex - 1)) {
    pieces.item(emptyIndex).parentNode.insertBefore(pieces.item(emptyIndex), pieces.item(clickedIndex));
  } else if (clickedIndex == (emptyIndex + 1)) {
    pieces.item(clickedIndex).parentNode.insertBefore(pieces.item(clickedIndex), pieces.item(emptyIndex));
  } else if (clickedIndex == (emptyIndex - 4)) {
    let storedClkIndex = clickedIndex;
    let storedEmpIndex = emptyIndex;
    pieces.item(emptyIndex).parentNode.insertBefore(pieces.item(emptyIndex), pieces.item(clickedIndex));
    pieces.item(clickedIndex).parentNode.insertBefore(pieces.item(clickedIndex+1), pieces.item(storedEmpIndex+1));
  } else if (clickedIndex == (emptyIndex + 4)) {
    let storedClkIndex = clickedIndex;
    let storedEmpIndex = emptyIndex;
    pieces.item(clickedIndex).parentNode.insertBefore(pieces.item(clickedIndex), pieces.item(emptyIndex));
    pieces.item(emptyIndex).parentNode.insertBefore(pieces.item(emptyIndex+1), pieces.item(storedClkIndex+1));
  }
}

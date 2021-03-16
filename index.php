<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">

    <title>Jeux des nombres</title>
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Lato&display=swap" rel="stylesheet">

    <style>
      html {
        font-family: 'Lato' , sans-serif;
      }

      body {
        width: 50%;
        max-width: 800px;
        min-width: 480px;
        margin: 0 auto;
      }

      .lastResult {
        color: white;
        padding: 3px;
      }
    </style>
  </head>

  <body>
    <h1>Le jeux des nombres</h1>

    <p>Nous avons sélectionné un nombre entre 1 et 100. Essayez de le trouver en moins de 10 essais ! Nous vous dirons si le nombre saisi est trop petit ou trop grand.</p>

    <div class="form">
      <label for="guessField">Entrez un nombre : </label>
      <input type="text" id="guessField" class="guessField">
      <input type="submit" value="Valider" class="guessSubmit">
    </div>

    <div class="resultParas">
      <p class="guesses"></p>
      <p class="lastResult"></p>
      <p class="lowOrHi"></p>
    </div>

    <script>

let randomNumber = Math.floor(Math.random() * 100) + 1;

let guesses = document.querySelector('.guesses');
let lastResult = document.querySelector('.lastResult');
let lowOrHi = document.querySelector('.lowOrHi');

let guessSubmit = document.querySelector('.guessSubmit');
let guessField = document.querySelector('.guessField');

let guessCount = 1;
let resetButton;


function checkGuess(){
  let userGuess = Number(guessField.value);
  if (guessCount === 1) {
    guesses.textContent = 'Propositions précédentes : ';
  }
  guesses.textContent += userGuess + ' ';

  if (userGuess === randomNumber) {
    lastResult.textContent = 'Bravo, vous avez trouvé le nombre !';
    lastResult.style.backgroundColor = 'green';
    lowOrHi.textContent = '';
    setGameOver();
  } else if (guessCount === 10) {
     lastResult.textContent = '!!! PERDU !!!';
     setGameOver();
  } else {
     lastResult.textContent = 'Faux !';
     lastResult.style.backgroundColor = 'red';
     if (userGuess < randomNumber) {
      lowOrHi.textContent = 'Le nombre saisi est trop petit !';
     } else if (userGuess > randomNumber) {
      lowOrHi.textContent = 'Le nombre saisi est trop grand !';
     }
  }

  guessCount++;
  guessField.value = '';
  guessField.focus();
}

guessSubmit.addEventListener('click', checkGuess);

function setGameOver() {
  guessField.disabled = true;
  guessSubmit.disabled = true;
  resetButton = document.createElement('button');
  resetButton.textContent = 'Start new game';
  document.body.appendChild(resetButton);
  resetButton.addEventListener('click', resetGame);
}

function resetGame() {
  guessCount = 1;

  let resetParas = document.querySelectorAll('.resultParas p');
  for (let i = 0 ; i < resetParas.length ; i++) {
    resetParas[i].textContent = '';
  }

  resetButton.parentNode.removeChild(resetButton);

  guessField.disabled = false;
  guessSubmit.disabled = false;
  guessField.value = '';
  guessField.focus();

  lastResult.style.backgroundColor = 'white';

  randomNumber = Math.floor(Math.random() * 100) + 1;
}

    </script>
  </body>
</html>

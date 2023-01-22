<!DOCTYPE html>
<html lang="fr">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link href="../assets/style.css" rel="stylesheet">
  <title>Cricket</title>

  <?php
  // Found no better way to access file content with JS
  $players_file = '../data/players.json';
  $players = json_decode(file_get_contents($players_file));
  function writePlayersArrayForJS() {
      echo '[';
    foreach ($GLOBALS['players'] as $i => $player) {
      echo '"' . $player . '"';
      if ($i != sizeof($GLOBALS['players']) - 1) { echo ','; }
    }
    echo ']';
  }
  ?>
</head>

<body>
  <div id="cricket-container">
  </div>

  <script>

    class Player {
      constructor(name) {
        this.name = name;
        this.scores = { 15: 0, 16: 0, 17: 0, 18: 0, 19: 0, 20: 0, 25: 0 };
        // set the HTML elt that displays player's score, settled with Plateau instance
        this.scoreCell;
      }

      get totalScore() {
        const subtotals = Object.entries(this.scores)
                                .map(score => score[0] * (score[1] < 4 ? 0 : score[1] - 3));
        return subtotals.reduce((total, current) => total + current, 0);
      }

      checkIfScore(cell, score, players) {
        if (this.checkRow(score, players)) {
          this.updateScore(cell, score)
        }
        // TODO: check if player has won
        this.checkWin(players);
      }

      // Returns true if one cell or more of the row is 'open' (score < 3)
      checkRow(score, players) {
        let rowScores = players.map(player => player.scores[score]);
        return rowScores.filter(nbr => nbr < 3).length ? true : false
      }

      updateScore(cell, score) {
        this.scores[score] += 1;
        plateau.container.removeEventListener('click', plateau.clickScore);
        cell.classList.add('blink');
        setTimeout(() => {
          cell.classList.remove('blink');
          plateau.container.addEventListener('click', plateau.clickScore);
        }, 150);
        if (this.scores[score] > 3) {
          this.scoreCell.innerHTML = this.totalScore;
          this.scoreCell.classList.add('blink');
          setTimeout(() => {
            this.scoreCell.classList.remove('blink');
          }, 150);
        }
      }

      checkWin(players) {
        // check if all cells are closed for player
        // And if no one has an equal or better totalScore
        if ((!Object.values(this.scores).filter(nbr => nbr < 3).length) &&
            (players.map(player => player.totalScore)
                    .filter(tot => tot >= this.totalScore)
                    .length == 1)) {
          alert(`${this.name.toUpperCase()} A GAGNEEEEEE !!!`);
          plateau.container.removeEventListener('click', plateau.clickScore)
        }
      }
    }

    let players = <?php writePlayersArrayForJS() ?>.map(name => new Player(name));

    class Plateau {
      container = document.getElementById('cricket-container');
        
      constructor() {
        this.set_legend(); // sets legend column
        this.set_players(); // sets each player's column
        this.container.addEventListener('click', this.clickScore);
      }
      
      set_legend() {
        // cells in displaying order
        let cells = ['', '20', '19', '18', '17', '16', '15', 'B', '']
        let legendContainer = document.createElement('div');
        legendContainer.setAttribute('class', 'legend-container');
        cells.forEach(cell => {
          let elt = document.createElement('div');
          elt.setAttribute('class', 'legend-cell');
          elt.innerHTML = `<p>${cell}</p>`;
          legendContainer.appendChild(elt);
        });
        this.container.appendChild(legendContainer);
      }

      set_players() {
        players.forEach((player, id) => {
          let playerContainer = document.createElement('div');
          playerContainer.setAttribute('class', 'player-container');

          let playerName = document.createElement('div');
          playerName.setAttribute('class', 'player-cell');
          playerName.innerHTML = player.name;
          playerContainer.appendChild(playerName);
          
          ['20', '19', '18', '17', '16', '15', '25'].forEach(score => {
            let elt = document.createElement('div');
            elt.setAttribute('data-playerid', id);
            elt.setAttribute('data-score', score);
            elt.setAttribute('class', 'player-cell');
            playerContainer.appendChild(elt);
          });

          let playerScore = document.createElement('div');
          playerScore.setAttribute('class', 'player-cell');
          playerScore.setAttribute('data-playerid', id);
          playerScore.innerHTML = player.totalScore;
          player.scoreCell = playerScore;
          playerContainer.appendChild(playerScore);
          
          this.container.appendChild(playerContainer);
        });
      }

      clickScore(e) {
        if (!e.target.dataset.score) { return }
        
        // TODO: replace conditions with score from player ?
        // would eventually be clearer and remove need of data-img attribute
        let player = players[e.target.dataset.playerid];
        let score = e.target.dataset.score
        if (player.scores[score] == 0) {
          let imgOne = document.createElement('img');
          player.updateScore(e.target, score);
          imgOne.setAttribute('src', '../assets/images/one.png');
          e.target.appendChild(imgOne);
        } else if (player.scores[score] == 1) {
          let imgTwo = document.createElement('img');
          player.updateScore(e.target, score);
          imgTwo.setAttribute('src', '../assets/images/two.png');
          e.target.replaceChildren(imgTwo);
        } else if (player.scores[score] == 2) {
          let imgThree = document.createElement('img');
          player.updateScore(e.target, score);
          imgThree.setAttribute('src', '../assets/images/three.png');
          e.target.replaceChildren(imgThree);
          player.checkWin(players);
        } else {
          player.checkIfScore(e.target, score, players);
        }
      }
    }
    plateau = new Plateau();
    </script>
</body>
</html>
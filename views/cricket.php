<!DOCTYPE html>
<html lang="fr">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link href="../assets/cricket.css" rel="stylesheet">
  <title>Cricket</title>

  <?php
  // Found no better way to access file content with JS
  function writePlayersArrayForJS() {
    $players_file = '../data/players.json';
    $players = json_decode(file_get_contents($players_file));
      echo '[';
    foreach ($players as $i => $player) {
      echo '"' . $player . '"';
      if ($i != sizeof($players) - 1) { echo ','; }
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

      checkIfScore(score, players) {
        if (this.checkRow(score, players)) {
          this.updateScore(score)
        }
        // TODO: check if player has won
        this.checkWin(players);
      }

      // Returns true if one cell or more of the row is 'open' (score < 3)
      checkRow(score, players) {
        let rowScores = players.map(player => player.scores[score]);
        return rowScores.filter(nbr => nbr < 3).length ? true : false
      }

      updateScore(score) {
        this.scores[score] += 1;
        if (this.scores[score] > 3) { this.scoreCell.innerHTML = this.totalScore; }
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
        let cells = ['', '15', '16', '17', '18', '19', '20', 'B', '']
        let legendContainer = document.createElement('div');
        legendContainer.setAttribute('class', 'legend-container');
        cells.forEach(cell => {
          let elt = document.createElement('div');
          elt.setAttribute('class', 'legend-cell');
          elt.innerHTML = cell;
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
          
          Object.keys(player.scores).forEach(score => {
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
        if (!e.target.firstChild) {
          let slash = document.createElement('img');
          player.updateScore(score);
          slash.setAttribute('src', '../assets/images/slash.png');
          slash.setAttribute('class', 'temp');
          slash.setAttribute('data-img', 'slash');
          e.target.appendChild(slash);
        } else if (e.target.firstChild.dataset.img == 'slash') {
          let cross = document.createElement('img');
          player.updateScore(score);
          cross.setAttribute('src', '../assets/images/cross.png');
          cross.setAttribute('class', 'temp');
          cross.setAttribute('data-img', 'cross');
          e.target.replaceChildren(cross);
        } else if (e.target.firstChild.dataset.img == 'cross') {
          let target = document.createElement('img');
          player.updateScore(score);
          target.setAttribute('src', '../assets/images/target.png');
          target.setAttribute('class', 'temp');
          target.setAttribute('data-img', 'target');
          e.target.replaceChildren(target);
          player.checkWin(players);
        } else {
          player.checkIfScore(score, players);
        }
      }
    }
    plateau = new Plateau();
    </script>
</body>
</html>
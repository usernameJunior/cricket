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
        // the HTML elt that displays player's score, settled with Plateau
        this.scoreCell;
      }
      get score() {
        const subtotals = Object.entries(this.scores)
                                .map(score => score[0] * score[1])
        return subtotals.reduce((total, current) => total + current, 0);
      }
      updateScore(score) {
        this.scores[score] += 1;
        this.scoreCell.innerHTML = this.score;
      }
    }

    players = <?php writePlayersArrayForJS() ?>.map(name => new Player(name));

    class Plateau {
      container = document.getElementById('cricket-container');
        
      constructor() {
        this.set_legend(); // sets legend column
        this.set_players(); // sets each player's column
        this.container.addEventListener('click', this.checkScore);
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
          playerScore.innerHTML = player.score;
          player.scoreCell = playerScore;
          playerContainer.appendChild(playerScore);
          
          this.container.appendChild(playerContainer);
        });
      }

      checkScore(e) {
        if (!e.target.dataset.score) { return }
        
        let player = players[e.target.dataset.playerid];
        player.updateScore(parseInt(e.target.dataset.score));
        e.target.innerHTML = '<img src="../assets/images/slash.png" class="temp">';
      }
    }
    coucou = new Plateau();
    </script>
</body>
</html>
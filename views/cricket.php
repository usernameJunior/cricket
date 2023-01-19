<!DOCTYPE html>
<html lang="fr">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
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
  <title>Cricket</title>
</head>
<body>
  <div class="cricket-container">
    
  </div>

  <script>
    class Player {
      constructor(name) {
        this.name = name;
        this.scores = { 15: 0, 16: 0, 17: 0, 18: 0, 19: 0, 20: 0, 25: 0 };
      }
      get score() {
        const subtotals = Object.entries(this.scores)
                                .map(score => score[0] * score[1])
        return subtotals.reduce((total, current) => total + current, 0);
      }
      static all() {
        // return players;
      }
    }

    const playerNames = <?php writePlayersArrayForJS() ?>;
    const players = playerNames.map((name) => player = new Player(name));

  </script>
</body>
</html>
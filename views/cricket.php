<!DOCTYPE html>
<html lang="fr">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">

  <link href="../assets/style.css" rel="stylesheet">

  <?php require '../php/players_array_for_js.php' ?>
  <!-- JS classes -->
  <script src="../js/cricket/player.js"></script>
  <script src="../js/cricket/plateau.js"></script>

  <title>Cricket</title>
</head>

<body>
  <div id="winner">
    <p></p>
  </div>
  <div id="cricket-container">
    <!-- Generated by JS -->
  </div>

  <script>
    let players = <?php writePlayersArrayForJS('../data/players.json') ?>
                  .map(name => new Player(name));
    plateau = new Plateau();
  </script>
</body>
</html>
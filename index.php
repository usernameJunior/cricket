<!DOCTYPE html>
<html lang="fr">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewporindext" content="width=device-width, initial-scale=1.0">
  <!-- favicons -->
  <link rel="apple-touch-icon" sizes="180x180" href="assets/icons/apple-touch-icon.png">
  <link rel="icon" type="image/png" sizes="32x32" href="assets/icons/favicon-32x32.png">
  <link rel="icon" type="image/png" sizes="16x16" href="assets/icons/favicon-16x16.png">
  <link rel="manifest" href="/site.webmanifest">

  <link href="../assets/style.css" rel="stylesheet">

  <?php require 'php/players_array_for_js.php' ?>

  <script>
    let players = <?php writePlayersArrayForJS('data/players.json') ?>;
    let playerNbr = 0;
  </script>
  <script src="js/home/home.js"></script>
  
  <title>Fléchettes</title>
</head>

<body>
  <h1>Jeu de Cricket</h1>

  <h2>Joueurs :</h2>

  <form action="php/set_players.php" method="post">
    <div id="players-container">
      <script>
        // TODO: player number displaying right
        // - Use AJAX to update players file in real time
        //   and display in page without refresh ?
        generatePlayerForm();
      </script>
    </div>
    <button class="add-player-btn" type="button">
      Ajouter un joueur
    </button>
    <input type="submit" value="Jouer">
  </form>
  

  <script>
    const newPlayerBtn = document.getElementById('add-player-btn');
    newPlayerBtn.addEventListener('click', (e) => {
      addPlayer();
    });
  </script>
</body>
</html>
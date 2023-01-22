<!DOCTYPE html>
<html lang="fr">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewporindext" content="width=device-width, initial-scale=1.0">
  <link href="../assets/homepage.css" rel="stylesheet">

  <?php require 'php/players_array_for_js.php' ?>

  <script>
    let players = <?php writePlayersArrayForJS('data/players.json') ?>;
    let playerNbr = 0;
  </script>
  <script src="js/home/home.js"></script>
  
  <title>Fléchettes</title>
</head>

<body>
  <h1>Joueurs</h1>

  <form action="php/home/set_players.php"
        method="post">
    <div id="players-container">
      <script>
        // TODO: player number displaying right
        // - Use AJAX to update players file in real time
        //   and display in page without refresh ??
        generatePlayerForm();
      </script>
    </div>
    <input type="submit" value="Jouer">
    <button id="add-player-btn" type="button">
      Ajouter un joueur
    </button>
  </form>
  

  <script>
    const newPlayerBtn = document.getElementById('add-player-btn');
    newPlayerBtn.addEventListener('click', (e) => {
      addPlayer();
    });
  </script>
</body>
</html>
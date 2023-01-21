<!DOCTYPE html>
<html lang="fr">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewporindext" content="width=device-width, initial-scale=1.0">
  <link href="../assets/homepage.css" rel="stylesheet">

  <?php
  // Found no better way to access file content with JS
  function writePlayersArrayForJS() {
    $players_file = 'data/players.json';
    $players = json_decode(file_get_contents($players_file));
      echo '[';
    foreach ($players as $i => $player) {
      echo '"' . $player . '"';
      if ($i != sizeof($players) - 1) { echo ','; }
    }
    echo ']';
  }
  ?>

  <script>
    let players = <?php writePlayersArrayForJS() ?>;
    let playerNbr = 0;

    function generatePlayerForm() {
      // const container = document.getElementById('players-container');
      // container.
      if (players.length) {
        players.forEach (player => {
          addPlayer(player);
        });
      } else {
        addPlayer();
      }
    }

    function addPlayer(name = '') {
      playerNbr += 1;

      const playerContainer = document.createElement("div");
      
      const label = document.createElement("label");
      label.setAttribute("for", `player${playerNbr}`);
      label.innerText = `Joueur ${playerNbr} : `;

      const input = document.createElement("input");
      input.setAttribute("type", "text");
      input.setAttribute("name", `player${playerNbr}`);
      input.value = name;
      

      const deletePlayerBtn = document.createElement("p");
      deletePlayerBtn.setAttribute("class", "delete-player-btn");
      deletePlayerBtn.innerHTML = "X";
      deletePlayerBtn.addEventListener('click', function(event) {
        deletePlayer(event, deletePlayerBtn);
      });
      
      const br = document.createElement("br");
      
      playerContainer.appendChild(label);
      playerContainer.appendChild(input);
      playerContainer.appendChild(deletePlayerBtn);
      playerContainer.appendChild(br);

      const container = document.getElementById('players-container');
      container.appendChild(playerContainer);
    }

    function deletePlayer(event, btn) {
      btn.removeEventListener('click', deletePlayer)
      event.currentTarget.parentElement.remove();
      playerNbr -= 1;
    }
  </script>
  
  <title>Fléchettes</title>
</head>

<body>
  <h1>Joueurs</h1>

  <form action="controllers/set_players.php"
        method="post">
    <div id="players-container">
      <script> generatePlayerForm(); </script>
    </div>
    <input type="submit" value="Jouer">
    <button id="add-player-btn" type="button">Ajouter un joueur</button>
  </form>
  

  <script>
    const newPlayerBtn = document.getElementById('add-player-btn');
    newPlayerBtn.addEventListener('click', (e) => {
      addPlayer();
    });
  </script>
</body>
</html>
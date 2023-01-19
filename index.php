<!DOCTYPE html>
<html lang="fr">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewporindext" content="width=device-width, initial-scale=1.0">

  <?php
  $players_file = 'data/players.json';
  // decode JSON into array (pass 'true' as 2nd arg. to associative array)
  $players = json_decode(file_get_contents($players_file));
  ?>
  
  <!-- JS -->
  <script>
    let player_nbr = <?php echo $players ? sizeof($players) : 1 ?>;

    function addPlayer() {
      player_nbr += 1;
      // const new_player = `<span>Joueur ${player_nbr} :</span> <input type='text'><br>`;
      // document.querySelector('.players-container')
      //         .insertAdjacentHTML('beforeend', new_player);
    
      let label = document.createElement("label");
      label.setAttribute("for", `player${player_nbr}`);
      label.innerText = `Joueur ${player_nbr} : `;

      let input = document.createElement("input");
      input.setAttribute("type", "text");
      input.setAttribute("name", `player${player_nbr}`);

      let br = document.createElement("br");

      const container = document.querySelector('.players-container')
      container.appendChild(label)
      container.appendChild(input)
      container.appendChild(br);
    }
  </script>
  <title>Fléchettes</title>
</head>

<body>
  <h1>Joueurs</h1>

  <form action="controllers/set_players.php"
        method="post">
    <div class="players-container">
      <?php
      if ($players) {
        foreach ($players as $index => $name) {
          echo "
          <label for=\"player" . $index + 1 . "\">
            Joueur " . $index + 1 . " :
          </label>
          <input type=\"text\"
                name=\"player" . $index + 1 . "\"
                value=\"$name\">
          <br>";
        };
      } else {
        echo "
        <label for=\"player1\">
          Joueur 1 :
        </label>
        <input type=\"text\"
              name=\"player1\">
        <br>";
      };
      ?>
    </div>
    <input type="submit" value="Jouer">
  </form>
  <button id="add-player">Ajouter un joueur</button>

  

  <script>
    add_player = document.getElementById('add-player');
    add_player.addEventListener('click', addPlayer);
  </script>
</body>
</html>
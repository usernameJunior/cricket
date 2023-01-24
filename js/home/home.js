function generatePlayerForm() {
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
  playerContainer.classList.add('player-container');

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
  
  playerContainer.appendChild(input);
  playerContainer.appendChild(deletePlayerBtn);
  playerContainer.appendChild(br);

  const container = document.getElementById('players-container');
  container.appendChild(playerContainer);

  // focus on new player input if created by user
  if (playerNbr > players.length) { input.focus(); }
}

function deletePlayer(event, btn) {
  btn.removeEventListener('click', deletePlayer)
  event.currentTarget.parentElement.remove();
  playerNbr -= 1;
}
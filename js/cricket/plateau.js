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
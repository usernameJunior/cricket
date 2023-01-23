class Plateau {
    
  constructor() {
    this.container = document.getElementById('cricket-container');
    this.container.onclick = this.clickScore;
    this.set_legend(); // sets legend column
    this.set_players(); // sets each player's column
  }
  
  set_legend() {
    // cells are in displaying order here, up to bottom
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
    
    let player = players[e.target.dataset.playerid];
    let score = e.target.dataset.score
    // if score is 0, update & set image one
    if (player.scores[score] == 0) {
      let imgOne = document.createElement('img');
      imgOne.setAttribute('src', '../assets/images/one.png');
      e.target.appendChild(imgOne);
      player.updateScore(e.target, score);
      // if score is 1, update & set image two
    } else if (player.scores[score] == 1) {
      let imgTwo = document.createElement('img');
      imgTwo.setAttribute('src', '../assets/images/two.png');
      e.target.replaceChildren(imgTwo);
      player.updateScore(e.target, score);
      // if score is 2, update & set image three
    } else if (player.scores[score] == 2) {
      let imgThree = document.createElement('img');
      imgThree.setAttribute('src', '../assets/images/three.png');
      e.target.replaceChildren(imgThree);
      player.updateScore(e.target, score);
      // else, update score if row is not closed
    } else if (player.checkRow(score, players)) {
        player.updateScore(e.target, score);
    }
    if (player.scores[score] >= 3 && player.checkWin(players)) {
      alert(`${player.name.toUpperCase()} A GAGNEEEEEE !!!`);
    }
  }
}
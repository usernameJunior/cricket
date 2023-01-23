class Player {
  constructor(name) {
    this.name = name;
    this.scores = { 15: 0, 16: 0, 17: 0, 18: 0, 19: 0, 20: 0, 25: 0 };
    // set the HTML elt that displays player's score, settled with Plateau instance
    this.scoreCell;
  }

  get totalScore() {
    const subtotals = Object.entries(this.scores)
                            .map(score => score[0] * (score[1] < 4 ? 0 : score[1] - 3));
    return subtotals.reduce((total, current) => total + current, 0);
  }

  // Returns true if one cell or more of the row is 'open' (score < 3)
  checkRow(score, players) {
    let rowScores = players.map(player => player.scores[score]);
    return rowScores.filter(nbr => nbr < 3).length ? true : false
  }

  updateScore(cell, score) {
    this.scores[score] += 1;

    plateau.container.onclick = null;
    cell.classList.add('blink');
    // settimeout is to prevent unwanted double clicks
    setTimeout(() => {
      cell.classList.remove('blink');
      plateau.container.onclick = this.checkWin(players) ? null : plateau.clickScore;
    }, 150);
    if (this.scores[score] > 3) {
      this.scoreCell.innerHTML = this.totalScore;
      
      this.scoreCell.classList.add('blink');
      setTimeout(() => {
        this.scoreCell.classList.remove('blink');
      }, 150);
    }
  }

  checkWin(players) {
    // check if all cells are closed for player
    if ((!Object.values(this.scores).filter(nbr => nbr < 3).length) &&
    // And if no one has an equal or better totalScore
        (players.map(player => player.totalScore)
                .filter(tot => tot >= this.totalScore)
                .length == 1)) {
      return true;
    }
    return false;
  }
}
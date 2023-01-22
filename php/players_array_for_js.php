<?php
// Found no better way to access file content with JS
function writePlayersArrayForJS($players_file) {
  $players = json_decode(file_get_contents($players_file));
    echo '[';
  foreach ($players as $i => $player) {
    echo '"' . $player . '"';
    if ($i != sizeof($players) - 1) { echo ','; }
  }
  echo ']';
}
?>
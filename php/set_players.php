<?php
header('Location: ../../views/games_index.php');
$players_file = '../data/players.json';
file_put_contents($players_file, json_encode(array_values($_POST)));
?>
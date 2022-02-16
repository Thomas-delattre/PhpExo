<?php
declare(strict_types = 1);

require('Models/Room.php');
require('helper.php');

if ($_SERVER['REQUEST_METHOD'] != 'POST') {
	error_response('Method is not allowed', 405);
}

$niveaux = ['Facile', 'Normal', 'Difficile'];

$niveau = ucfirst(strtolower($_POST['niveau'] ?? 'Normal'));

//if ($niveau != 'Facile' || $niveau != 'Normal' || $niveau != 'Difficile') {
if (! in_array($niveau, $niveaux)) {
	error_response('Le niveau ne peut être que "Facile", "Normal" ou "Difficile"');
}

if(!isset($_POST['name']) || 
	$_POST['name'] == '') {
	error_response('Le nom doit être renseigné');
}
if(strlen($_POST['name']) <= 5) {
	error_response('Le nom doit contenir plus de 5 lettres');
}

if(!isset($_POST['description']) || 
	$_POST['description'] == '') {
	error_response('La description doit être renseignée');
}
if(strlen($_POST['description']) <= 10) {
	error_response('La description doit contenir plus de 10 lettres');
}

$duration = (int)($_POST['duration'] ?? 70);

if (! is_int($duration) || $duration == 0) {
	error_response('La durée doit être un entier');
}

$forbidden = (bool)($_POST['forbidden'] ?? false);

if (! is_bool($forbidden)) {
	error_response('Forbidden doit être un booléen');
}

$min_player = (int)($_POST['min_player'] ?? 2);
$max_player = (int)($_POST['max_player'] ?? 12);

if($min_player <= 1 || $min_player > 12 || $max_player <= 1 || $max_player > 12){
	error_response('Veuillez saisir un nombre de joueur entre 2 et 12 svp');
}
if($max_player < $min_player) {
	error_response('Incohérence dans les min et max player');
}
$room = new Room($_POST['name'], 
	$_POST['description'], 
	(int)$duration,
	$forbidden,
	$niveau,
	$min_player, 
	$max_player
);

http_response_code(201);
$room->insert();
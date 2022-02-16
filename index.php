<?php
declare(strict_types = 1);

require('Models/Room.php');


//var_dump($_GET);

//façon numero 1 de faire un if
//if (isset($_GET['duration'])) {
//	$duration = (int)$_GET['duration'];
//} else {
//	$duration = 70;
//}
//facon numéro de faire un if (avec une ternaire)
//$duration = isset($_GET['duration']) ? (int)$_GET['duration'] : 70;
//façon numéro 3 de faire notre if (assignation de variable)
$duration = (int)($_GET['duration'] ?? 70);

if(!isset($_GET['name']) || 
	$_GET['name'] == '') {
	http_response_code(422);
	echo json_encode(['error' => 'Le nom doit être renseigné']);
	die;
}
if(strlen($_GET['name']) <= 5) {
	http_response_code(422);
	echo json_encode(['error' => 'Le nom doit contenir plus de 5 lettres']);
	die;
}

if(!isset($_GET['description']) || 
	$_GET['description'] == '') {
	http_response_code(422);
	echo json_encode(['error' => 'La description doit être renseignée']);
	die;
}
if(strlen($_GET['description']) <= 10) {
	http_response_code(422);
	echo json_encode(['error' => 'La description doit contenir plus de 10 lettres']);
	die;
}

if (! is_int($duration) || $duration == 0) {
	http_response_code(422);
	echo json_encode(['error' => 'La durée n\'est pas un entier']);
	die;
}

$forbidden = (bool)($_GET['forbidden'] ?? false);

if (! is_bool($forbidden)) {
	http_response_code(422);
	echo json_encode(['error' => 'Le forbidden n\'est pas un booléen']);
	die;
}

$room = new Room($_GET['name'], 
	$_GET['description'], 
	(int)$duration,
	$forbidden
);



echo $room;
die;
try {
	$room4->setNiveau("trop difficile");
} catch(Exception $e) {
	header("HTTP/1.1 422 Niveau Inconnu");
	die;
}

echo $room4;
die;


$roomHorror = [
	'name' => 'Horreur',
	'description' => 'ma super salle d\'horreur',
	'duration' => 60,
	'forbidden18yearOld' => true,
	'toto' => 'sdqdsdsq'
];
$roomComique = [
	'name' => 'Comique',
	'duration' => 60,
	'description' => 'Description extraordinaire de ma salle',
	'forbidden18yearOld' => false,
];

$roomSherlock = [
	'name' => 'Sherlock Holmes',
	'duration' => 60,
	'description' => 'No Shit Sherlock ! this is the best room',
	'forbidden18yearOld' => false,
];

//assigner les rooms à un tableau
$array_rooms = [
	'horror' => $roomHorror, 
	'comique' => $roomComique, 
	'sherlock' => $roomSherlock,
];
for($i=0; $i <= 3; $i++) {
	echo ($i + 1) .' - ' . $array_rooms[$i] ."\n\r"; 
}


foreach($array_rooms as $name => $room) {
	echo "Nom de la salle : " . $room['name'] . "\n\r";
	echo "Description : \n\r" . $room['description']."\n\r";
	
	//interdit au moins de 18 ans ? 
	if ($room['forbidden18yearOld'] == true) {
		echo "cette salle est interdite au moins de 18 ans\n\r";
	}
	echo "\n\r";
	//echo "1 - ". $room . "\n\r";
	//printf("1 - %s \n\r", $room);
}


?>


<?php
declare(strict_types = 1);

require('../Models/Room.php');
require('../helper.php');

$room_id = (int)($_GET['room_id'] ?? 0);
$room = findRoomById($room_id);

$players = [];
for($i = $room->getMinPlayer(); $i <= $room->getMaxPlayer(); $i++) {
	if($i >= 5) {
		$price = 20;
	} else {
		$price = 26;
	}
	$players[] = [
				  'nb_player' =>  $i,
				  'price' 	  => $price
				  ];
}

echo json_encode($players);
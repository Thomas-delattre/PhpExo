<?php
declare(strict_types = 1);

require('Models/Room.php');
require('helper.php');

if ($_SERVER['REQUEST_METHOD'] != 'GET') {
	error_response('Method is not allowed', 405);
}

$rooms = [
	'data' => getRoomsFromDB(),
	'meta' => [
		'page_number' 	=> 1, 
		'max_page' 		=> 12,
	],
];
echo json_encode($rooms);
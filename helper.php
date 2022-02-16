<?php

declare(strict_types=1);

function connect_to_mysql(): PDO
{
	$dsn = 'mysql:dbname=escape_game;host=localhost;port=3307';
	$user = 'escape_game';
	$password = 'lol123';
	$connection = new PDO($dsn, $user, $password);
	$connection->exec("set names utf8mb4");

	return $connection;
}

function error_response(string $message, int $code = 422): void
{
	http_response_code($code);
	echo json_encode(['error' => $message]);
	die;
}

function getRoomsFromDB(): array
{
	$conn = connect_to_mysql();

	$array_rooms = [];
	$sql = "SELECT * 
	        FROM `rooms`";

	foreach ($conn->query($sql) as $row) {

		$room = new Room(
			$row['name'],
			$row['description'],
			(int)$row['duration'],
			(bool)$row['forbidden18yearOld'],
			$row['niveau'],
			(int)$row['min_player'],
			(int)$row['max_player'],
			(int)$row['age'],
			$row['img_css'],
			(bool)$row['new'],
		);

		$array_rooms[$row['id']] = $room->toArray();
		//array_push($array_rooms, $room->toArray());
	}
	return $array_rooms;
}

function findRoomById(int $id): ?Room
{

	$conn = connect_to_mysql();

	$query = $conn->prepare("SELECT * 
	        FROM `rooms`
			WHERE id= :id");

	$query->execute([':id' => $id]);
	if ($row = $query->fetch()) {

		$room = new Room(
			$row['name'],
			$row['description'],
			(int)$row['duration'],
			(bool)$row['forbidden18yearOld'],
			$row['niveau'],
			(int)$row['min_player'],
			(int)$row['max_player'],
			(int)$row['age'],
			$row['img_css'],
			(bool)$row['new'],
		);
		return $room;
	} else {
		return null;
	}
}

function findScheduleById(int $id): ?Schedule
{

	$conn = connect_to_mysql();

	$query = $conn->prepare("SELECT * 
	        FROM `schedule`
			WHERE id= :id");

	$query->execute([':id' => $id]);
	if ($row = $query->fetch()) {

		$schedule = new Schedule(
			(int)$row['id'],
			$row['heure'],
		);
		return $schedule;
	} else {
		return null;
	}
}

function findCustomerByEmail(string $email): ?Customer
{
	$conn = connect_to_mysql();

	$query = $conn->prepare("SELECT * 
	        FROM `customers`
			WHERE email = :email");

	$query->execute([':email' => $email]);
	if ($row = $query->fetch()) {

		$customer = new Customer(
			$row['firstname'],
			$row['lastname'],
			$row['email']
		);
		$customer->setId((int)$row['id']);
		return $customer;
	} else {
		return null;
	}
}

function getSchedulesFromDB(): array
{
	$conn = connect_to_mysql();
	$schedules = [];

	$sql = "SELECT * 
	        FROM schedule
			ORDER BY heure ASC";

	foreach ($conn->query($sql) as $row) {

		$schedule = new Schedule((int)$row['id'], $row['heure']);

		$schedules[] = $schedule;
	}

	return $schedules;
}

function getBookingsByDateAndRoom(int $room_id, string $date)
{
	$conn = connect_to_mysql();
	$bookings = [];

	$query = $conn->prepare(
		"
		SELECT schedule_id 
	    FROM booking
		WHERE room_id = :room_id
		AND date = :date"
	);

	$query->execute([':room_id' => $room_id, ':date' => $date]);
	foreach ($query->fetchAll() as $row) {
		$bookings[] = $row['schedule_id'];
	}
	return $bookings;
}

function getPriceFromNbPlayer($nb_player): int
{
	$price = 0;
	switch (true) {
		case in_array($nb_player, range(2, 4)):
			$price = 26;
			break;
		case in_array($nb_player, range(5, 9)):
			$price = 22;
			break;
		case in_array($nb_player, range(10, 12)):
			$price = 20;
			break;
	}

	return $price * $nb_player;
}
function redirectIfNotAdmin()
{
	if (!isset($_SESSION['isAdmin'])) {
		header("Location: /escape-game/admin/index.php?error_code=1");
		exit;
	}
}
function getCustomersFromDB()
{
	$conn = connect_to_mysql();
	$array_customers = [];

	$sql = ("SELECT * 
	FROM `customers`
	");

	foreach ($conn->query($sql) as $row) {

		$customer = new Customer(
			$row['firstname'],
			$row['lastname'],
			$row['email'],
		);
		$customer->setId((int)$row['id']);
		$array_customers[$row['id']] = $customer;
	}
	return $array_customers;
}

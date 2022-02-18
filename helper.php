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
		"SELECT schedule_id 
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
function getCustomerById(int $id)
{
	$conn = connect_to_mysql();

	$query = $conn->prepare("SELECT * 
	        FROM `customers`
			WHERE id = :id");

	$query->execute([':id' => $id]);
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
function getScheduleById()
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
function getBookingsByCustomerId(int $customer_id): array
{
	$conn = connect_to_mysql();
	$array_bookings = [];

	$query = $conn->prepare("SELECT *
	FROM `booking`
	WHERE `customers_id`= :customers_id
	");

	$query->execute([':customers_id' => $customer_id]);
	foreach ($query->fetchAll() as $row) {

		$array_bookings[] = new Booking(
			(int)$row['room_id'],
			(int) $row['customers_id'],
			(int) $row['schedule_id'],
			(string) $row['date'],
			(int) $row['nb_player'],
			(int) $row['total_price']
		);
	}
	return $array_bookings;
}
function getDateById(string $date)
{ {
		$conn = connect_to_mysql();
		$date = [];

		$query = $conn->prepare(
			"SELECT date 
			FROM `booking`"
		);

		$query->execute(['date' => (int)$date]);
		if ($row = $query->fetch()) {
			$date[] = $row['date'];
		}
		return $date;
	}
}
function getNbPlayersId(int $nb_player)
{
	$conn = connect_to_mysql();
	$nb_player = [];

	$query = $conn->prepare(
		"SELECT nb_player 
		FROM `booking`"
	);

	$query->execute(['nb_player' => (int)$nb_player]);
	if ($row = $query->fetch()) {
		$nb_player[] = $row['nb_player'];
	}
	return $nb_player;
}
function getTotalPrice(int $total_price)
{
	$conn = connect_to_mysql();
	$total_price = [];

	$query = $conn->prepare(
		"SELECT  total_price
		FROM `booking`"
	);

	$query->execute(['total_price' => (int)$total_price]);
	if ($row = $query->fetch()) {
		$total_price[] = $row['total_price'];
	}
	return $total_price;
}
function update(string $update)
{
	$conn = connect_to_mysql();
	$update = [];

	$query = $conn->prepare(
		"UPDATE `customers`
        SET email ='',
		firstname ='', 
		lastname=''
		WHERE id = :id"
	);

	$query->execute(['update' => (int) $update]);
	if ($row = $query->fetch()) {

		$update[] = $row['update'];
	}
	return $update;
}
function deleteCustomer(int $id)
{
	$conn = connect_to_mysql();

	$query = $conn->prepare(
		"DELETE 
		FROM `customers`
		WHERE id = :id"
	);

	$result = $query->execute([':id' => (int) $id]);

	return $result;
}

function deleteBookingByCustomerId(int $id)
{

	$conn = connect_to_mysql();

	$query = $conn->prepare(
		"DELETE 
		FROM `booking`
		WHERE customers_id = :id"
	);

	$result = $query->execute([':id' => (int) $id]);
	return $result;
}
function updateBooking(string $booking)
{
	$conn = connect_to_mysql();
	$booking = [];

	$query = $conn->prepare(
		"UPDATE `booking`
        SET room ='',
		customer ='', 
		schedule='',
		date = '',
		nb_player = '',
		total_price = ''
		WHERE id = :id"
	);

	$query->execute(['booking' => (int) $booking]);
	if ($row = $query->fetch()) {

		$booking[] = $row['booking'];
	}
	return $booking;
}
function getBookings(): array
{
	$conn = connect_to_mysql();
	$array_bookings = [];

	$query = $conn->prepare("SELECT *
	FROM `booking` 
	");

	$query->execute();
	foreach ($query->fetchAll() as $row) {

		$array_bookings[] = new Booking(
			(int)$row['room_id'],
			(int) $row['customers_id'],
			(int) $row['schedule_id'],
			(string) $row['date'],
			(int) $row['nb_player'],
			(int) $row['total_price']
		);
	}
	return $array_bookings;
}

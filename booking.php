<?php

declare(strict_types = 1);

require_once('Models/Customer.php');
require_once('Models/Booking.php');
require_once('Models/Schedule.php');
require_once('Models/Room.php');
require_once('helper.php');


$firstname = $_POST['customerFirstname'];
$lastname = $_POST['customerLastname'];
$email = $_POST['customerEmail'];
$customer = findCustomerByEmail($email);

if($customer == null) {
	$customer = new Customer($firstname, $lastname, $email);
	$customer_id = $customer->insert();
} else {
	$customer_id = $customer->getId();
}



$room_id = (int)$_POST['roomSelect'];
$schedule_id = (int)$_POST['bookingTime'];
$date = $_POST['bookingDate'];
$nb_player = (int)$_POST['playersNumber'];

$price = getPriceFromNbPlayer($nb_player);

$booking = new Booking(
  $room_id,
  $customer_id,
  $schedule_id,
  $date,
  $nb_player,
  $price,
);


try {
	$res = $booking->insert();
	
	if($res) {
		$schedule = findScheduleById($schedule_id);
		$room = findRoomById($room_id);
		echo $customer_id . '-Vous avez bien réservé la salle '.$room->getName().' à '.$schedule->getHeure().' le '.$date.' pour '.$nb_player .' personnes.';
	}
} 
catch(Exception $e){
	if($e->getCode() == 23000) {
		echo 'Ce créneau est déjà réservé !';
	} else {
		echo $e->getMessage();
	}
}

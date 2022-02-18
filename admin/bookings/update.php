<?php
session_start();


require_once("../../helper.php");
require_once("../../Models/Booking.php");
require_once("../../Models/Room.php");
require_once("../../Models/Customer.php");
require_once("../../Models/Schedule.php");

redirectIfNotAdmin();


// $customer_id = (int) $_GET['customer_id'];
$array_bookings = getBookings($booking);

if (isset($_POST['room_id']) && isset($_POST['customers_id']) && isset($_POST['schedule_id']) && isset($_POST['date']) && isset($_POST['nb_player']) && isset($_POST['total_price'])) {
    $booking->setRoomId($_POST['room_id']);
    $booking->setCustomerId($_POST['customers_id']);
    $booking->setScheduleId($_POST['schedule_id']);
    $booking->setDateById($_POST['date']);
    $booking->setNbPlayersId($_POST['nb_player']);
    $booking->setTotalPrice($_POST['total_price']);
    $booking->update();
};


?>


<html>

<head>

</head>

<body>
    <h1>Modification </h1>

    <form action="" method="POST">
        <input type="text" name="room_id" value="<?= $booking->getRoomId() ?>" />
        <input type="text" name="customers_id" value="<?= $booking->getCustomerId() ?>" />
        <input type="text" name="schedule_id" value="<?= $booking->getScheduleId() ?>" />
        <input type="date" name="date" value="<?= $booking->getDateById() ?>" />
        <input type="text" name="nb_player" value="<?= $booking->getNbPlayersId() ?>" />
        <input type="text" name="total_price" value="<?= $booking->getTotalPrice() ?>" />
        <input type="submit" value="Modifier" />
    </form>
</body>

</html>
<?php
session_start();

require_once("../../helper.php");
require_once("../../Models/Booking.php");
require_once("../../Models/Room.php");
require_once("../../Models/Customer.php");
require_once("../../Models/Schedule.php");

redirectIfNotAdmin();

$customer_id = (int) $_GET['customer_id'];

$bookings = getBookingsByCustomerId($customer_id);
?>
<html>

<head>
</head>

<body>
    <h1>Ma réservation !</h1>



    <?php
    foreach ($bookings as $Mybooking) {


        $room = findRoomById($Mybooking->getRoomId());
        $customer = getCustomerById($Mybooking->getCustomerId());
        $schedule = findScheduleById($Mybooking->getScheduleId());
        $date = getDateById($Mybooking->getDateById());
        $nb_player = getNbPlayersId($Mybooking->getNbPlayersId());
        $total_price = getTotalPrice($Mybooking->getTotalPrice());


        // var_dump($date);
        // die;
    ?>

        <table border="1">
            <tr>
                <th>Room Name</th>
                <th>Firstname</th>
                <th>Lastname</th>
                <th>Email</th>
                <th>Heure</th>
                <th>Date</th>
                <th>Number Player</th>
                <th>Total Price</th>

            </tr>
            <tr>
                <td><?= $room->getName() ?></td>
                <td><?= $customer->getFirstname() ?></td>
                <td><?= $customer->getLastname() ?></td>
                <td><?= $customer->getEmail() ?></td>
                <td><?= $schedule->getHeure() ?></td>
                <td><?= $Mybooking->getDateById() ?></td>
                <td><?= $Mybooking->getNbPlayersId() ?></td>
                <td><?= $Mybooking->getTotalPrice() ?></td>
            <?php
        }
            ?>

            </tr>

</body>

</html>
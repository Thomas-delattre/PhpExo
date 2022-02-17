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
        var_dump($room);
        die;
        $customer = getCustomerById($Mybooking->getCustomerId());
        $schedule = findScheduleById($Mybooking->getScheduleId());







        // $schedule = findScheduleById($Mybooking->getHeure());
    ?>

        <tr>
            <td><?= $room->getName() ?></td>
            <td><?= $customer->getFirstname() ?></td>
            <td><?= $customer->getLastname() ?></td>
            <td><?= $customer->getEmail() ?></td>
            <td><?= $schedule->getHeure() ?></td>
            <!-- <td><?= $Mybooking->getFirstname() ?></td> -->
        <?php
    }
        ?>

        </tr>

</body>

</html>
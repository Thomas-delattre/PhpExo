<?php
session_start();

require_once("../../helper.php");
require_once("../../Models/Booking.php");
require_once("../../Models/Room.php");
require_once("../../Models/Customer.php");
require_once("../../Models/Schedule.php");

redirectIfNotAdmin();


$bookings = getBookings();
?>
<html>

<head>
</head>

<body>
    <h1>Nous sommes sur la liste des Réservations</h1>

    <?php
    include('../includes/menu.php');
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
            <th>Action</th>
        </tr>

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

            <tr>

                <td><?= $room->getName() ?></td>
                <td><?= $customer->getFirstname() ?></td>
                <td><?= $customer->getLastname() ?></td>
                <td><?= $customer->getEmail() ?></td>
                <td><?= $schedule->getHeure() ?></td>
                <td><?= $Mybooking->getDateById() ?></td>
                <td><?= $Mybooking->getNbPlayersId() ?></td>
                <td><?= $Mybooking->getTotalPrice() ?></td>

                <a href="update.php?room_id=<?= $Mybooking->getRoomId() ?>">Modifier</a>




            </tr>
        <?php
        }
        ?>
</body>

</html>
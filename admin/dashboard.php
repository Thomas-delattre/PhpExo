<?php
session_start();

require_once("../helper.php");

redirectIfNotAdmin();

?>
<html>

<head>
</head>

<body>
    <h1>Nous sommes dans le dashboard</h1>

    <a href="customers/list.php">Clients</a>
    <a href="rooms/list.php">Salles</a>
    <a href="bookings/list.php">Réservations</a>
    <a href="index.php?logout">Déconnexion</a>
</body>

</html>
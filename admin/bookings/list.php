<?php
session_start();

require_once("../../helper.php");

redirectIfNotAdmin();

?>
<html>

<head>
</head>

<body>
    <h1>Nous sommes sur la liste des Réservations</h1>

    <?php
    include('../includes/menu.php');
    ?>
</body>

</html>
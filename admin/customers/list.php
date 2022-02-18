<?php
session_start();

require_once("../../helper.php");
require_once("../../Models/Customer.php");

redirectIfNotAdmin();

$customers = getCustomersFromDB();

?>
<html>

<head>
</head>

<body>
    <h1>Nous sommes sur la liste des Clients</h1>

    <?php
    include('../includes/menu.php');
    if (isset($_GET['deleted'])) {
        echo '<script> alert ("L\'utilisateur est bien supprimé")</script>';
    }
    ?>

    <br />
    <table border="1">
        <tr>
            <th>Firstname</th>
            <th>Lastname</th>
            <th>Email</th>
            <th>Action</th>
        </tr>

        <?php
        foreach ($customers as $customers_key => $info_customer) {



        ?>
            <tr>
                <td><?= $info_customer->getFirstname() ?></td>
                <td><?= $info_customer->getLastname() ?></td>
                <td><?= $info_customer->getEmail() ?></td>
                <td>
                    <a href="../bookings/mybooking.php?customer_id=<?= $info_customer->getId() ?>">Voir votre réservation</a>
                    <a href="update.php?customer_id=<?= $info_customer->getId() ?>">Modifier</a>
                    <a href="delete.php?customer_id=<?= $info_customer->getId() ?>" onclick="return confirm('Are you sure?')">Supprimer</a>
                </td>
            </tr>
        <?php
        }
        ?>

    </table>
</body>

</html>
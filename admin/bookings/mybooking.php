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
    <h1>Ma réservation !</h1>
    <?php
    foreach ($customers as $customer['id'] => $info_customer) {
    ?>
        <tr>
            <td><?= $info_customer->getFirstname() ?></td>
            <td><?= $info_customer->getLastname() ?></td>
            <td><?= $info_customer->getEmail() ?></td>
        <?php
    }
        ?>

        </tr>

</body>

</html>
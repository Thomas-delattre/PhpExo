<?php
session_start();


require_once("../../helper.php");
require_once("../../Models/Customer.php");

redirectIfNotAdmin();
$customer_id = (int) $_GET['customer_id'];
$customer = getCustomerById($customer_id);

if (isset($_POST['firstname']) && isset($_POST['lastname']) && isset($_POST['email'])) {
    $customer->setFirstName($_POST['firstname']);
    $customer->setLastName($_POST['lastname']);
    $customer->setEmail($_POST['email']);
    $customer->update();
};


?>


<html>

<head>

</head>

<body>
    <h1>Modification </h1>

    <form action="" method="POST">
        <input type="firstname" name="firstname" value="<?= $customer->getFirstname() ?>" />
        <input type="lastname" name="lastname" value="<?= $customer->getLastname() ?>" />
        <input type="email" name="email" value="<?= $customer->getEmail() ?>" />
        <input type="submit" value="Modifier" />
    </form>
</body>

</html>
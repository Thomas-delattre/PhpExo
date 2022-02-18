<?php
session_start();


require_once("../../helper.php");
require_once("../../Models/Customer.php");

redirectIfNotAdmin();



if (isset($_GET['customer_id'])) {
    $result = deleteBookingByCustomerId((int)$_GET['customer_id']);
    $result = deleteCustomer((int)$_GET['customer_id']);
    if ($result) {
        header("Location: list.php?deleted");
        exit;
    } else {
        error_response('Toujours La  !', 404);
    }
}

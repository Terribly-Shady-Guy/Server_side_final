<?php

require_once "../config.php";
require_once "../utils.php";

if (isset($_POST['PaymentKey']))
{
    $connection = new mysqli($hn, $un, $pw, $db);
    if ($connection->connect_error) die ("Failed to connect to database.");

    $paymentKey = sanitizeInput($_POST['PaymentKey'], $connection);

    $stmt = $connection->prepare("DELETE FROM payment WHERE PaymentKey = ?");
    $stmt->bind_param("i", $paymentKey);
    $stmt->execute();
    $stmt->close();

    $connection->close();
    header("Location: ../../admin.php");
}

?>
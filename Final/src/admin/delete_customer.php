<?php

require_once "../config.php";
require_once "../utils.php";

if (isset($_POST['CustomerKey']))
{
    $connection = new mysqli($hn, $un, $pw, $db);
    if ($connection->connect_error) die ("Failed to connect to database.");

    $customerKey = sanitizeInput($_POST['CustomerKey'], $connection);

    $stmt = $connection->prepare("DELETE FROM customer WHERE CustomerKey = ?");
    $stmt->bind_param("i", $customerKey);
    $stmt->execute();
    $stmt->close();

    $connection->close();
    header("Location: ../../admin.php");
}

?>
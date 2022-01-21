<?php

require_once "../config.php";
require_once "../utils.php";

if (isset($_POST['orderKey']))
{
    $connection = new mysqli($hn, $un, $pw, $db);
    if ($connection->connect_error) die ("Failed to connect to database.");

    $orderKey = sanitizeInput($_POST['orderKey'], $connection);

    $stmt = $connection->prepare("DELETE FROM orders WHERE orderKey = ?");
    $stmt->bind_param("i", $orderKey);
    $stmt->execute();
    $stmt->close();

    $connection->close();
    header("Location: ../../admin.php");
}
?>
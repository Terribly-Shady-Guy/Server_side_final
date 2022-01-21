<?php

require_once "../config.php";
require_once "../utils.php";

if (isset($_POST['OrderKey']) && isset($_POST['ProductKey']))
{
    $connection = new mysqli($hn, $un, $pw, $db);
    if ($connection->connect_error) die ("Failed to connect to database.");

    $orderKey = sanitizeInput($_POST['OrderKey'], $connection);
    $productKey = sanitizeInput($_POST['ProductKey'], $connection);

    $stmt = $connection->prepare("DELETE FROM orderdetails WHERE OrderKey = ? AND ProductKey = ?");
    $stmt->bind_param("ii", $orderKey, $productKey);
    $stmt->execute();
    $stmt->close();

    $connection->close();
    
    header("Location: ../../admin.php");
}

?>
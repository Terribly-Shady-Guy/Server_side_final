<?php

require_once "src/config.php";
require_once "src/utils.php";

if (isset($_POST['Product']))
{
    $connection = new mysqli($hn, $un, $pw, $db);
    if ($connection->connect_error) die("Failed to connect to database");

    $productKey = sanitizeInput($_POST['Product'], $connection);

    $stmt = $connection->prepare("SELECT * FROM products WHERE ProductKey = ?");
    $stmt->bind_param("i", $productKey);
    $stmt->execute();
    $result = $stmt->get_result();
    $row = $result->fetch_array(MYSQLI_ASSOC);
    
    $result->close();
    $stmt->close();
    $connection->close();

    $fileName = htmlspecialchars($row['ProductImage']);
    $name = htmlspecialchars($row['ProductName']);
    $description = htmlspecialchars($row['ProductDescription']);
    $price = htmlspecialchars($row['ProductPrice']);
    $invQty = htmlspecialchars($row['InventoryQty']);
}

?>
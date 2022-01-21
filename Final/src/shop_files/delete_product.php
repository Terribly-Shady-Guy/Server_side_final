<?php

require_once "../config.php";
require_once "../utils.php";

session_start();
if (isset($_POST['Product']) && isset($_SESSION['username']))
{
    $connection = new mysqli($hn, $un, $pw, $db);
    if ($connection->connect_error) die("Failed to connect to database");

    $productKey = sanitizeInput($_POST['Product'], $connection);

    $stmt = $connection->prepare("DELETE FROM products WHERE ProductKey = ?");
    $stmt->bind_param("i", $productKey);
    $stmt->execute();
    $stmt->close();

    $connection->close();
    
    header("Location: ../../product_list.php");
}
else
{
    echo "You do not have permission to delete this product.";
}

?>
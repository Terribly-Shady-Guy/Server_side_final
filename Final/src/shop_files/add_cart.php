<?php

require_once "../config.php";
require_once "../utils.php";
require_once "../product.php";

if (isset($_POST['Qty']) && isset($_POST['Product']))
{
    $connection = new mysqli($hn, $un, $pw, $db);
    if ($connection->connect_error) die("Failed to connect to database.");

    $orderQty = sanitizeInput($_POST['Qty'], $connection);
    $productKey = sanitizeInput($_POST['Product'], $connection);

    if (validateInt($orderQty))
    {
        session_start();

        if (!isset($_SESSION['cart']))
        {
            $_SESSION['cart'] = array(); 
        }

        $foundItemIndex = findItem($productKey);

        if ($foundItemIndex != -1)
        {
            $_SESSION['cart'][$foundItemIndex]->addOrderQty($orderQty);
        }
        else
        {
            $query = "SELECT * FROM Products WHERE ProductKey = $productKey";
            $result = $connection->query($query);
            $row = $result->fetch_array(MYSQLI_ASSOC);
            $result->close();

            $_SESSION['cart'][] = new Product($row, $orderQty);
        }
    }
    
    $connection->close();
}

function findItem($productKey)
{
    $length = count($_SESSION['cart']);
    for ($index = 0; $index < $length; $index++)
    {
        $cartItemProductKey = $_SESSION['cart'][$index]->getProductKey();
        if ($cartItemProductKey == $productKey)
        {
            return $index;
        }
    }
    
    return -1;
}

?>
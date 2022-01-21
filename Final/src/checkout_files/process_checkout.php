<?php

require_once "../config.php";
require_once "../product.php";
require_once "add_customer.php";
require_once "add_payment.php";

session_start();

if (validatePost() && isset($_SESSION['cart']) && isset($_SESSION['total']))
{
    $connection = new mysqli($hn, $un, $pw, $db);
    if ($connection->connect_error) die("Failed to connect to database");

    $orderKey = null;
    $total = round($_SESSION['total'], 2);
    $orderDate = date('Y-m-d', time());
    $customerKey = addCustomer($connection);
    $paymentKey = addPayment($connection, $customerKey);

    $stmt = $connection->prepare("INSERT INTO orders VALUES(?,?,?,?,?)");
    $stmt->bind_param("idsii", $orderKey, $total, $orderDate, $customerKey, $paymentKey);
    $stmt->execute();
    $stmt->close();
    
    $orderKey = $connection->insert_id;

    $stmt = $connection->prepare("INSERT INTO orderdetails VALUES(?,?,?)");

    foreach ($_SESSION['cart'] as $cartItem)
    {
        $productkey = $cartItem->getProductKey();
        $orderQty = $cartItem->getOrderQty();
        $stmt->bind_param("iii", $orderKey, $productkey, $orderQty);
        $stmt->execute();
    }

    $stmt->close();
    $connection->close();

    $_SESSION['order'] = $orderKey;
    unset($_SESSION['cart']);
    unset($_SESSION['total']);
    
    header("Location: ../../confirmation.php");
}
else
{
    header("Location: ../../index.php");
}

function validatePost()
{
    $postNames = array('FirstName', 'LastName', 'StreetAddress', 'City', 'State', 'Zip', 'CardNumber', 'CVV', 'ExpiryDate');
    foreach ($postNames as $postName)
    {
        if (!isset($_POST[$postName]))
        {
            return false;
        }
    }
    
    return true;
}

?>
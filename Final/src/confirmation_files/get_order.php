<?php

require_once "src/config.php";

session_start();

$orderKey = $_SESSION['order'];

if (isset($_SESSION['username']))
{
    unset($_SESSION['order']);
}
else
{
    session_destroy();
}

$connection = new mysqli($hn, $un, $pw, $db);
if ($connection->connect_error) die("Failed to connect to database");

$query = "SELECT OrderDate, Total, CONCAT(CustFirstName,' ', CustLastName) AS CustName, CONCAT(CustStreetAddress,' ', CustCity, ', ', CustState, ', ', CustZip) AS CustAddress, PaymentKey FROM Orders INNER JOIN Customer ON Customer.CustomerKey = Orders.CustomerKey WHERE OrderKey = $orderKey";
$result = $connection->query($query);
$row = $result->fetch_array(MYSQLI_ASSOC);
$result->close();

$orderDate = htmlspecialchars($row['OrderDate']);
$total = htmlspecialchars($row['Total']);
$total = "$" . number_format($total, 2);
$fullName = htmlspecialchars($row['CustName']);
$address = htmlspecialchars($row['CustAddress']);

$paymentKey = $row['PaymentKey'];

$query = "SELECT CardNum FROM payment WHERE PaymentKey = $paymentKey";
$result = $connection->query($query);
$row = $result->fetch_array(MYSQLI_ASSOC);
$result->close();

$cardNumber = htmlspecialchars($row['CardNum']);

$query = "SELECT ProductName, ProductPrice, OrderQty FROM orderdetails INNER JOIN products ON orderdetails.ProductKey = products.ProductKey WHERE OrderKey = $orderKey";
$result = $connection->query($query);
$rows = $result->num_rows;

$orderedProducts = "";
for ($rowNum = 0; $rowNum < $rows; $rowNum++)
{
    $row = $result->fetch_array(MYSQLI_ASSOC);
    $productName = htmlspecialchars($row['ProductName']);
    $price = htmlspecialchars($row['ProductPrice']);
    $price = "$" . number_format($price, 2);
    $orderedQty = htmlspecialchars($row['OrderQty']);
    
    $orderedProducts .=<<<_END
    <tr>
        <td>$productName</td>
        <td>$price</td>
        <td>$orderedQty</td>
    </tr>
    _END;
}

$result->close();
$connection->close();

?>
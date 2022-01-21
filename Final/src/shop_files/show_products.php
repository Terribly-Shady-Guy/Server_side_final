<?php

require_once "src/config.php";
require_once "src/product.php";

$connection = new mysqli($hn, $un, $pw, $db);
if ($connection->$connect_error) die("Failed to connect to database");

$query = "SELECT * FROM Products";
$result = $connection->query($query);
if(!$result) die("Failed to retreive product data");

$rows = $result->num_rows;
$productList = "<div class='ProductRow'>\n";

for ($rowNum = 0; $rowNum < $rows; $rowNum++)
{
    $row = $result->fetch_array(MYSQLI_ASSOC);
    
    $product = new Product($row);
    $productList .= $product->createProductCard();
    
    if (($rowNum + 1) % 3 == 0 && ($rowNum != 0 && $rowNum != $rows - 1))
    {
        $productList .= "</div>\n";
        $productList .= "<div class='ProductRow'>\n";
    }
}

$productList .= "</div>\n";

$result->close();
$connection->close();

?>
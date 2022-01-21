<?php

require_once "src/config.php";

$connection = new mysqli($hn, $un, $pw, $db);
if ($connection->connect_error) die("Failed to connect to database");

$query = "SELECT ProductImage, ProductName, ProductPrice FROM Products LIMIT 2";
$result = $connection->query($query);
if (!$result) die("Failed to retreive data.");

$rows = $result->num_rows;
$featuredProducts = "";

for ($rowNum = 0; $rowNum < $rows; $rowNum++)
{
    $row = $result->fetch_array(MYSQLI_ASSOC);
    $image = htmlspecialchars($row['ProductImage']);
    $productName = htmlspecialchars($row['ProductName']);
    $price = htmlspecialchars($row['ProductPrice']);
    $price = "$" . number_format($price, 2);

    $featuredProducts .= <<<_END
        <div class="productCard">
            <img src="images/$image">
            <h3 class="ProductName">$productName</h3>
            <p class="ProductPrice">$price</p>
        </div>\n
    _END;
}

$result->close();
$connection->close();

?>
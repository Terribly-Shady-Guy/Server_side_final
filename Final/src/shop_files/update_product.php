<?php

require_once "../config.php";
require_once "../utils.php";

session_start();

if (isset($_POST['product_name'])
&& isset($_POST['description'])
&& isset($_POST['price'])
&& isset($_POST['inv_qty'])
&& isset($_POST['FileName'])
&& isset($_POST['Product'])
&& isset($_SESSION['username']))
{
    $connection = new mysqli($hn, $un, $pw, $db);
    if ($connection->connect_error) die("Failed to connect to database");

    if(is_uploaded_file($_FILES['product_image']['tmp_name']))
    {
        switch ($_FILES['product_image']['type'])
        {
            case 'image/jpeg':
                $ext = '.jpg';
                break;
            case 'image/png':
                $ext = '.png';
                break;
            case 'image/tiff':
                $ext = '.tif';
                break;
            default:
                $ext = '';
                break;
        }
    }
    else
    {
        $fileName = sanitizeInput($_POST['FileName'], $connection);
    }

    if ($ext || isset($fileName))
    {
        $productKey = sanitizeInput($_POST['Product'], $connection);
        $productName = sanitizeInput($_POST['product_name'], $connection);
        $description = sanitizeInput($_POST['description'], $connection);
        $price = sanitizeInput($_POST['price'], $connection);
        $invQty = sanitizeInput($_POST['inv_qty'], $connection);

        if (validateFloat($price) && validateInt($invQty))
        {
            if (!isset($fileName))
            {
                $fileName = $_FILES['product_image']['name'];
                $folder = "../../images/" . $fileName;
                move_uploaded_file($_FILES['product_image']['tmp_name'], $folder);
            }

            $stmt = $connection->prepare("UPDATE products SET ProductImage = ?, ProductName = ?, ProductDescription = ?, ProductPrice = ?, InventoryQty = ? WHERE Productkey = $productKey");
            $stmt->bind_param("sssdi", $fileName, $productName, $description, $price, $invQty);
            $stmt->execute();
            $stmt->close();
        }
        
        header('Location: ../../product_list.php');
    }
    else
    {
        echo "file is not a valid image type.";
    }

    $connection->close();
}
else
{
    echo "You do not have permission to update this product.";
}

?>
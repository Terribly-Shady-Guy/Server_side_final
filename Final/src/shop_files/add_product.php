<?php

require_once "../utils.php";
require_once "../config.php";

session_start();

if (isset($_POST['product_name'])
    && isset($_POST['description'])
    && isset($_POST['price'])
    && isset($_POST['inv_qty'])
    && isset($_SESSION['username']))
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

        if ($ext)
        {
            $connection = new mysqli($hn, $un, $pw, $db);
            if ($connection->connect_error) die("Failed to connect to database");

            $productKey = null;
            $fileName = $_FILES['product_image']['name'];
            $productName = sanitizeInput($_POST['product_name'], $connection);
            $description = sanitizeInput($_POST['description'], $connection);
            $price = sanitizeInput($_POST['price'], $connection);
            $invQty = sanitizeInput($_POST['inv_qty'], $connection);

            if (validateInt($invQty) && validateFloat($price))
            {
                $stmt = $connection->prepare("INSERT INTO Products VALUES(?,?,?,?,?,?)");
                $stmt->bind_param("isssdi", $productKey, $fileName, $productName, $description, $price, $invQty);
                $stmt->execute();
                $stmt->close();

                $folder = "../../images/" . $fileName;
                move_uploaded_file($_FILES['product_image']['tmp_name'], $folder);
            }

            $connection->close();
            
            header('Location: ../../product_list.php');
        }
        else
        {
            echo "file is not a valid image type.";
        }
}
else
{
    echo "You do not have permission to add a new product.";
}

?>
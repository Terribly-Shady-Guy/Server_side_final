<?php

require_once "html_utils.php";
require_once "src/shop_files/get_product.php";

echo <<<_END
<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <title>Update Product</title>
        <link rel="stylesheet" href="styles/form_style.css">
        <link rel="stylesheet" href="styles/style.css">
    </head>
    <body>
        <div id="Content">
            <header>
                <h1>Modify a product</h1>
            </header>
            <form id="product" method="post" action="src/shop_files/update_product.php" enctype="multipart/form-data">
                <table>
                    <tr>
                        <td>Product image:</td>
                        <td><input type="file" name="product_image"></td>
                    </tr>
                    <tr>
                        <td>product Name:</td>
                        <td><input type="text" id="product_name" name="product_name" required autocomplete="off" value="$name">
                    </tr>
                    <tr>
                        <td>Description:</td>
                        <td><textarea id="description" name="description" required>$description</textarea></td>
                    </tr>
                    <tr>
                        <td>Price:</td>
                        <td><input type="text" id="price" name="price" required autocomplete="off" value="$price"></td>
                    </tr>
                    <tr>
                        <td>Inventory Qty:</td>
                        <td><input type="text" id="inv_qty" name="inv_qty" required autocomplete="off" value="$invQty"></td>
                    </tr>
                    <tr>
                        <td><a href="product_list.php">back to products</a></td>
                        <td><input type="submit" name="submit" value="submit"></td>
                    </tr>
                </table>
                <input type="hidden" name="FileName" value="$fileName">
                <input type="hidden" name="Product" value="$productKey">
            </form>
            $footer
        </div>
    </body>
</html>
_END;

?>
<?php

require_once "html_utils.php";
require_once "src/cart_files/show_cart.php";

echo <<<_END
<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <title>Shopping Cart</title>
        <link rel="stylesheet" href="styles/style.css">
        <link rel="stylesheet" href="styles/shopping_cart_layout.css">
    </head>
    <body>
        $header
        <div id="MainContent">
            \n$cartList
        </div>
        <div id="Details">
            <div class="DetailsCol">
                <p>Subtotal:</p>
                <p>Tax:</p>
                <p>Total:</p>
            </div>
            <div class="DetailsCol">
                <p>$subtotal</p>
                <p>$tax</p>
                <p>$total</p>
            </div>
            <div class="DetailsCol">
                <p><a href="checkout.php">Proceed to Checkout</a></p>
            </div>
        </div>
        $footer
        $loginScript
    </body>
</html>
_END;

?>
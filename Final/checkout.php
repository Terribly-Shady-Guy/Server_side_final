<?php

require_once "html_utils.php";

echo <<<_END
<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <title>Checkout</title>
        <link rel="stylesheet" href="styles/style.css">
        <link rel="stylesheet" href="styles/form_style.css">
    </head>
    <body>
        <div id="Content">
            <header>
                <h1>Thank you for shopping with us!</h1>
            </header>
            <form id="Checkout" method="post" action="src/checkout_files/process_checkout.php">
                <table>
                    <tr>
                        <td>First Name:</td>
                        <td><input type="text" id="FirstName" name="FirstName" required></td>
                    </tr>
                    <tr>
                        <td>Last Name:</td>
                        <td><input type="text" id="LastName" name="LastName" required></td>
                    </tr>
                    <tr>
                        <td>Street Address:</td>
                        <td><input type="text" id="StreetAddress" name="StreetAddress" required></td>
                    </tr>
                    <tr>
                        <td>City:</td>
                        <td><input type="text" id="City" name="City" required></td>
                    </tr>
                    <tr>
                        <td>State:</td>
                        <td><input type="text" id="State" name="State" maxlength="2" placeholder="XX" size="2" required></td>
                    </tr>
                    <tr>
                        <td>Zip:</td>
                        <td><input type="text" id="Zip" name="Zip" maxlength="5" placeholder="NNNNN" size="5" required></td>
                    </tr>
                    <tr>
                        <td>Card Number:</td>
                        <td><input type="text" id="CardNumber" name="CardNumber" maxlength="19" size="22" placeholder="NNNN NNNN NNNN NNNN" autocomplete="off" required></td>
                    </tr>
                    <tr>
                        <td>CCV:</td>
                        <td><input type="text" id="CVV" name="CVV" placeholder="NNN" size="3" autocomplete="off" required></td>
                    </tr>
                    <tr>
                        <td>Expiry Date:</td>
                        <td><input type="text" id="ExpiryDate" name="ExpiryDate" placeholder="NN/NN" size="5" autocomplete="off" required></td>
                    </tr>
                    <tr>
                        <td><input type="submit" name="submit" id="submit" value="Checkout"></td>
                        <td><a href="shopping_cart.php">Return to cart</a></td>
                    </tr>
                </table>
            </form>
            $footer
        </div>
    </body>
</html>
_END;

?>
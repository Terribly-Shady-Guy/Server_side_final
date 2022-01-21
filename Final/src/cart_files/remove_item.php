<?php

require_once "../product.php";

session_start();

if (isset($_SESSION['cart']) && isset($_POST['Product']))
{
    $productKey = $_POST['Product'];
    $length = count($_SESSION['cart']);

    for ($index = 0; $index < $length; $index++)
    {
        $itemKey = $_SESSION['cart'][$index]->getProductKey();
        if ($productKey == $itemKey)
        {
            unset($_SESSION['cart'][$index]);
            $_SESSION['cart'] = array_values($_SESSION['cart']);
            break;
        }
    }
    
    header("Location: ../../shopping_cart.php");
}

?>
<?php

require_once "src/product.php";

session_start();

const SALES_TAX_RATE = 0.06875;
$cartList = "";
$subtotal = 0;
$tax = 0;
$total = 0;

if (isset($_SESSION['cart']))
{
    foreach($_SESSION['cart'] as $cartItem)
    {
        $cartList .= $cartItem->createCartCard();
        $subtotal += $cartItem->getProductSubtotal();
    }

    $tax = $subtotal * SALES_TAX_RATE;
    $total = $subtotal + $tax;

    $_SESSION['total'] = $total;
}

$subtotal = "$" . number_format($subtotal, 2);
$tax = "$" . number_format($tax, 2);
$total = "$" . number_format($total, 2);

?>
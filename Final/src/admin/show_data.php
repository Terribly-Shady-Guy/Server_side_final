<?php

require_once "src/config.php";
require_once "show_users_data.php";
require_once "show_customer_data.php";
require_once "show_payment_data.php";
require_once "show_order_data.php";
require_once "show_orderdetails_data.php";

session_start();

if (isset($_SESSION['username']))
{
    $connection = new mysqli($hn, $un, $pw, $db);
    if ($connection->connect_error) die ("Failed to connect to database.");

    $users = showUserData($connection);
    $customers = showCustomerData($connection);
    $payment = showPaymentData($connection);
    $orders = showOrderData($connection);
    $orderDetails = showOrderdetailsData($connection);

    $connection->close();

    $dataTables = <<<_END
        <h3>Users</h3>
        <table>
            <tr>
                <th>UserKey</th>
                <th>Username</th>
                <th>UserPassword</th>
                <th>AccountType</th>
                <th>UserFirstName</th>
                <th>UserLastName</th>
                <th>UserEmail</th>
                <th>Delete</th>
            </tr>
            $users
        </table>
        <h3>Customers</h3>
        <table>
            <tr>
                <th>CustomerKey</th>
                <th>CustFirstName</th>
                <th>CustLastName</th>
                <th>CustStreetAddress</th>
                <th>CustCity</th>
                <th>CustState</th>
                <th>CustZip</th>
                <th>Delete</th>
            </tr>
            $customers
        </table>
        <h3>Payment</h3>
        <table>
            <tr>
                <th>PaymentKey</th>
                <th>CustomerKey</th>
                <th>CardNum</th>
                <th>CVV</th>
                <th>ExpiryDate</th>
                <th>Delete</th>
            </tr>
            $payment
        </table>
        <h3>Orders</h3>
        <table>
            <tr>
                <th>OrderKey</th>
                <th>Total</th>
                <th>OrderDate</th>
                <th>CustomerKey</th>
                <th>PaymentKey</th>
                <th>Delete</th>
            </tr>
            $orders
        </table>
        <h3>OrderDetails</h3>
        <table>
            <tr>
                <th>OrderKey</th>
                <th>ProductKey</th>
                <th>OrderQty</th>
                <th>Delete</th>
            </tr>
            $orderDetails
        </table>
    _END;
}
else
{
    $dataTables = "you do not have permission to view this page.";
}

?>
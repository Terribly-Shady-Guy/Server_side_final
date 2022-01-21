<?php

require_once "../utils.php";

function addPayment($connection, $customerKey)
{
    $paymentKey = null;
    $cardNumber = sanitizeInput($_POST['CardNumber'], $connection);
    $cvv = sanitizeInput($_POST['CVV'], $connection);
    $expiryDate = sanitizeInput($_POST['ExpiryDate'], $connection);
    
    $row = getPaymentKey($connection, $cardNumber);

    if (!empty($row))
    {
        $paymentKey = $row['PaymentKey'];
    }
    else
    {
        $stmt = $connection->prepare("INSERT INTO Payment VALUES(?,?,?,?,?)");
        $stmt->bind_param('iisss', $paymentKey, $customerKey, $cardNumber, $cvv, $expiryDate);
        $stmt->execute();
        $stmt->close();
        
        $paymentKey = $connection->insert_id;
    }

    return $paymentKey;
}

function getPaymentKey($connection, $cardNumber)
{
    $query = "SELECT PaymentKey FROM Payment WHERE CardNum = '$cardNumber'";
    $result = $connection->query($query);
    if ($result->num_rows == 0)
    {
        $row = array();
    }
    else
    {
        $row = $result->fetch_array(MYSQLI_ASSOC);
    }

    $result->close();
    return $row;
}

?>
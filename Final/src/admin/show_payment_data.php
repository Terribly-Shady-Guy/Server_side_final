<?php


function showPaymentData($connection)
{
    $query = "SELECT * FROM payment";
    $result = $connection->query($query);
    $rows = $result->num_rows;

    $payment = "";
    for ($rowNum = 0; $rowNum < $rows; $rowNum++)
    {
        $row = $result->fetch_array(MYSQLI_ASSOC);

        $paymentKey = htmlspecialchars($row['PaymentKey']);
        $customerKey = htmlspecialchars($row['CustomerKey']);
        $cardNumber = htmlspecialchars($row['CardNum']);
        $cvv = htmlspecialchars($row['CVV']);
        $expiryDate = htmlspecialchars($row['ExpiryDate']);

        $payment .= <<<_END
        \n<tr>
            <td>$paymentKey</td>
            <td>$customerKey</td>
            <td>$cardNumber</td>
            <td>$cvv</td>
            <td>$expiryDate</td>
            <td>
                <form method="post" action="src/admin/delete_payment.php">
                    <input type="submit" name="DeletePayment" value="Delete">
                    <input type="hidden" name="PaymentKey" value="$paymentKey">
                </form>
            </td>
        </tr>
        _END;
    }

    $result->close();

    return $payment;
}

?>
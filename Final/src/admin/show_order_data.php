<?php

function showOrderData($connection)
{
    $query = "SELECT * FROM orders";
    $result = $connection->query($query);
    $rows = $result->num_rows;

    $orders = "";
    for ($rowNum = 0; $rowNum < $rows; $rowNum++)
    {
        $row = $result->fetch_array(MYSQLI_ASSOC);

        $orderKey = htmlspecialchars($row['OrderKey']);
        $total = htmlspecialchars($row['Total']);
        $orderDate = htmlspecialchars($row['OrderDate']);
        $customerKey = htmlspecialchars($row['CustomerKey']);
        $paymentKey = htmlspecialchars($row['PaymentKey']);

        $orders .= <<<_END
        \n<tr>
            <td>$orderKey</td>
            <td>$total</td>
            <td>$orderDate</td>
            <td>$customerKey</td>
            <td>$paymentKey</td>
            <td>
                <form method="post" action="src/admin/delete_order.php">
                    <input type="submit" value="Delete">
                    <input type="hidden" name="orderKey" value="$orderKey">
                </form>
            </td>
        </tr>
        _END;
    }

    $result->close();

    return $orders;
}

?>
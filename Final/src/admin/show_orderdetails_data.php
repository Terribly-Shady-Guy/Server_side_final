<?php

function showOrderdetailsData($connection)
{
    $query = "SELECT * FROM orderdetails";
    $result = $connection->query($query);
    $rows = $result->num_rows;
    
    $orderDetails = "";
    for ($rowNum = 0; $rowNum < $rows; $rowNum++)
    {
        $row = $result->fetch_array(MYSQLI_ASSOC);

        $orderKey = htmlspecialchars($row['OrderKey']);
        $productKey = htmlspecialchars($row['ProductKey']);
        $orderQty = htmlspecialchars($row['OrderQty']);

        $orderDetails .= <<<_END
        \n<tr>
            <td>$orderKey</td>
            <td>$productKey</td>
            <td>$orderQty</td>
            <td>
                <form method="post" action="src/admin/delete_orderdetails.php">
                    <input type="submit" value="Delete">
                    <input type="hidden" name="OrderKey" value="$orderKey">
                    <input type="hidden" name="ProductKey" value="$productKey">
                </form>
            </td>
        </tr>
        _END;
    }

    $result->close();

    return $orderDetails;
}

?>
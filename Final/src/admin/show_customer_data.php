<?php

function showCustomerData($connection)
{
    $query = "SELECT * FROM customer";
    $result = $connection->query($query);

    $rows = $result->num_rows;
    $customers = "";

    for ($rowNum = 0; $rowNum < $rows; $rowNum++)
    {
        $row = $result->fetch_array(MYSQLI_ASSOC);

        $customerKey = htmlspecialchars($row['CustomerKey']);
        $firstName = htmlspecialchars($row['CustFirstName']);
        $lastName = htmlspecialchars($row['CustLastName']);
        $streetAddress = htmlspecialchars($row['CustStreetAddress']);
        $city = htmlspecialchars($row['CustCity']);
        $state = htmlspecialchars($row['CustState']);
        $zip = htmlspecialchars($row['CustZip']);

        $customers .= <<<_END
        \n<tr>
            <td>$customerKey</td>
            <td>$firstName</td>
            <td>$lastName</td>
            <td>$streetAddress</td>
            <td>$city</td>
            <td>$state</td>
            <td>$zip</td>
            <td>
                <form method="post" action="src/admin/delete_customer.php">
                    <input type="submit" name="deleteCustomer" value="Delete">
                    <input type="hidden" name="CustomerKey" value="$customerKey">
                </form>
            </td>
        </tr>
        _END;
    }

    $result->close();

    return $customers;
}

?>
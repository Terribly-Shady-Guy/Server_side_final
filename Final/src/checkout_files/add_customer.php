<?php

require_once "../utils.php";

function addCustomer($connection)
{
    $customerKey = null;
    $firstName = sanitizeInput($_POST['FirstName'], $connection);
    $lastName = sanitizeInput($_POST['LastName'], $connection);
    $street = sanitizeInput($_POST['StreetAddress'], $connection);
    $city = sanitizeInput($_POST['City'], $connection);
    $state = sanitizeInput($_POST['State'], $connection);
    $zip = sanitizeInput($_POST['Zip'], $connection);
    
   $row = getCustomerKey($connection, $firstName, $lastName);

    if (!empty($row))
    {
        $customerKey = $row['CustomerKey'];
    }
    else
    {
        
        $stmt = $connection->prepare("INSERT INTO Customer VALUES(?,?,?,?,?,?,?)");
        $stmt->bind_param("issssss", $customerKey, $firstName, $lastName, $street, $city, $state, $zip);
        $stmt->execute();
        $stmt->close();
    
        $customerKey = $connection->insert_id;
    }

    return $customerKey;
}

function getCustomerKey($connection, $firstName, $lastName)
{
    $query = "SELECT CustomerKey FROM Customer WHERE CustFirstName = '$firstName' AND CustLastName = '$lastName'";
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
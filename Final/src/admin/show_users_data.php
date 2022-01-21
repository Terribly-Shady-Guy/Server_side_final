<?php

function showUserData($connection)
{
    $query = "SELECT * FROM users";
    $result = $connection->query($query);

    $rows = $result->num_rows;
    $users = "";
    for ($rowNum = 0; $rowNum < $rows; $rowNum++)
    {
        $row = $result->fetch_array(MYSQLI_ASSOC);
        $userKey = htmlspecialchars($row['UserKey']);
        $username = htmlspecialchars($row['Username']);
        $password = htmlspecialchars($row['UserPassword']);
        $accountType = htmlspecialchars($row['AccountType']);
        $userFirstName = htmlspecialchars($row['UserFirstName']);
        $userLastName = htmlspecialchars($row['UserLastName']);
        $userEmail = htmlspecialchars($row['UserEmail']);

        $users .= <<<_END
        \n<tr>
            <td>$userKey</td>
            <td>$username</td>
            <td>$password</td>
            <td>$accountType</td>
            <td>$userFirstName</td>
            <td>$userLastName</td>
            <td>$userEmail</td>
            <td>
                <form method="post" action="src/admin/delete_user.php">
                    <input type="submit" name="deleteUser" value="Delete">
                    <input type="hidden" name="UserKey" value="$userKey">
                </form>
            </td>
        </tr>
        _END;
    }

    $result->close();

    return $users;
}

?>
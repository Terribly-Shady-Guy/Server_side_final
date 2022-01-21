<?php

require_once "../config.php";
require_once "../utils.php";

if (isset($_POST['UserKey']))
{
    $connection = new mysqli($hn, $un, $pw, $db);
    if ($connection->connect_error) die ("Failed to connect to database.");

    $userKey = sanitizeInput($_POST['UserKey'], $connection);

    $stmt = $connection->prepare("DELETE FROM users WHERE UserKey = ?");
    $stmt->bind_param("i", $userKey);
    $stmt->execute();
    $stmt->close();

    $connection->close();
    header("Location: ../../admin.php");
}

?>
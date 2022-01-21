<?php

require_once "../config.php";
require_once "../utils.php";

if (isset($_POST['Username']) && isset($_POST['Password']))
{
    $connection = new mysqli($hn, $un, $pw, $db);
    if ($connection->connect_error) die("Failed to connect to database");

    $username = sanitizeInput($_POST['Username'], $connection);
    $password = sanitizeInput($_POST['Password'], $connection);

    $stmt = $connection->prepare("SELECT * FROM users WHERE Username = ?");
    $stmt->bind_param("s", $username);
    $stmt->execute();
    $result = $stmt->get_result();
    if ($result == false) die("Failed to find user.");

    foreach ($result as $user)
    {
        if (password_verify($password, $user['UserPassword']))
        {
            session_start();
            $_SESSION['username'] = $username;
            header('Location: ../../index.php');
        }
        else
        {
            echo "password incorrect";
        }
    }

    $result->close();
    $stmt->close();
    $connection->close();
}

?>
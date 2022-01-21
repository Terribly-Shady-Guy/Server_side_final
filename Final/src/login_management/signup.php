<?php

require_once '../config.php';
require_once "../utils.php";

if (isset($_POST['Username'])
&& isset($_POST['Password'])
&& isset($_POST['Email'])
&& isset($_POST['FirstName'])
&& isset($_POST['LastName']))
{
    $connection = new mysqli($hn, $un, $pw, $db);
    if ($connection->connect_error) die("Failed to connect to database.");

    $id = null;
    $username = sanitizeInput($_POST['Username'], $connection);
    $password = sanitizeInput($_POST['Password'], $connection);
    $password = password_hash($password, PASSWORD_DEFAULT);
    $accountType = "admin";
    $firstName = sanitizeInput($_POST['FirstName'], $connection);
    $lastName = sanitizeInput($_POST['LastName'], $connection);
    $email = sanitizeInput($_POST['Email'], $connection);

    $stmt = $connection->prepare("INSERT INTO users VALUES(?,?,?,?,?,?,?)");
    $stmt->bind_param('issssss', $id, $username, $password, $accountType, $firstName, $lastName, $email);
    $stmt->execute();
    
    $stmt->close();
    $connection->close();

    header('Location: ../../index.php');
}

?>
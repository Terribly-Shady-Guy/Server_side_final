<?php

session_start();

$response = Array();

if (isset($_SESSION['username']))
{
    $response['auth'] = true;
    $response['username'] = $_SESSION['username'];
    $response['accountType'] = $_SESSION['accountType'];
}
else
{
    $response['auth'] = false;
}

echo json_encode($response);

?>
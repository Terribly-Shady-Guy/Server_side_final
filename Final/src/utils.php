<?php

function sanitizeInput($string, $connection)
{
    $string = strip_tags($string);
    $string = htmlentities($string);
    $string = stripslashes($string);
    return $connection->real_escape_string($string);
}

function validateInt($number)
{
    if (filter_var($number, FILTER_VALIDATE_INT))
    {
        if ($number > 0)
        {
            return true;
        }
    }

    return false;
}

function validateFloat($number)
{
    if (filter_var($number, FILTER_VALIDATE_FLOAT))
    {
        if ($number > 0)
        {
            return true;
        }
    }

    return false;
}
?>
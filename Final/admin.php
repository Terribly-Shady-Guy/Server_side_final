<?php

require_once "src/admin/show_data.php";

echo <<<_END
<!DOCTYPE html>
<html>
    <head>
        <title>Admin</title>
        <meta charset="utf-8">
    </head>
    <body>
        <style>
            table {
                width: 90%;
            }

            td, h3, h1 {
                text-align: center;
            }
        </style>
        <h1>Admin Page</h1>
        <a href="index.php">To home</a>
        <a href="product_list.php">To shop</a>
        $dataTables
    </body>
</html>
_END;

?>
<?php

require_once "html_utils.php";

echo <<<_END
<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <title>Create Account</title>
        <link rel="stylesheet" href="styles/style.css">
        <link rel="stylesheet" href="styles/form_style.css">
    </head>
    <body>
        <div id="Content">
            <header>
                <h1>Thank you for joining us!</h1>
            </header>
            <form id="CreateAccount" method="post" action="src/login_management/signup.php">
                <table>
                    <tr>
                        <td>Username:</td>
                        <td><input type="text" id="Username" name="Username" autocomplete="off" required></td>
                    </tr>
                    <tr>
                        <td>Password:</td>
                        <td><input type="password" id="Password" name="Password" required></td>
                    </tr>
                    <tr>
                        <td>Email:</td>
                        <td><input type="text" id="Email:" name="Email" autocomplete="off" required></td>
                    </tr>
                    <tr>
                        <td>First Name:</td>
                        <td><input type="text" id="FirstName" name="FirstName" autocomplete="off" required></td>
                    </tr>
                    <tr>
                        <td>Last Name:</td>
                        <td><input type="text" id="LastName" name="LastName" autocomplete="off" required></td>
                    </tr>
                    <tr>
                        <td><input type="submit" id="Create" name="Create" value="Create"></td>
                        <td><a href="index.php">Back To Home Page</a></td>
                    </tr>
                </table>
            </form>
            $footer
        </div>
    </body>
</html>
_END;

?>
<?php

$header = <<<_END
<header>
    <img id="Banner" src="images/ssb-ultimate-banner.jpg">
    <ul id="Navigation">
        <a href="index.php"><li>Home</li></a>
        <a href=product_list.php><li>Shop</li></a>
    </ul>
    <form id="LoginForm" method="post" action="src/login_management/login.php">
        <div class="LoginCol">
            <p><a href="create_account.php">Sign Up</a></p>
            <input type="submit" name="Login" id="login" value="Login">
        </div>
        <div class="LoginCol">
            <input type="text" name="Username" id="Username" placeholder="Enter Username" autocomplete="off" required>
            <input type="password" name="Password" id="Password" placeholder="Enter Password" required>
        </div>  
    </form>
    <div id="verify_auth_result" hidden>
        <input type="button" value="Logout" id="logout" onclick="logout()">
        <a href="admin.php">to admin page</a>
        <p id="Welcome"></p>
    </div>
</header>
_END;

$footer = <<<_END
<footer>
    <ul id="ContactInfo">
        <li>Phone: (763) 487-7777</li>
        <li>Mailing Address: 1450 Main st. Minneapolis, MN 55406</li>
    </ul>
    <p>Made by gamers for gamers!</p>
</footer>
_END;

$loginScript = <<<_END
<script>
    var varifyAuthDiv = document.getElementById("verify_auth_result");
    var loginForm = document.getElementById("LoginForm");

    fetch("src/login_management/verify_auth.php")
    .then(response => response.json())
    .then(function(data) {
        if(data.auth) {
            loginForm.style.display = 'none';
            varifyAuthDiv.style.display = 'block';
            var welcome = document.getElementById("Welcome");
            welcome.innerHTML = "Welcome back " + data.username;

            var addProductLink = document.getElementById("AddProductLink");
            var updateButtons = document.getElementsByClassName("Update");
            var deleteButtons = document.getElementsByClassName("Delete");

            if (addProductLink != null) {
                addProductLink.style.display = 'block';
            }

            if (updateButtons.length > 0) {
                for (index = 0; index < updateButtons.length; index++) {
                    updateButtons[index].style.display = 'block';
                    deleteButtons[index].style.display = 'block';
                }
            }
        }
    });

    function logout() {
        fetch('src/login_management/logout.php')
        .then(function() { 
            location.reload(); 
        });
    }
</script>
_END;

?>
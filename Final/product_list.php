<?php

require_once "html_utils.php";
require_once "src/shop_files/show_products.php";

echo <<<_END
<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <title>Shop</title>
        <link rel="stylesheet" href="styles/product_list_layout.css">
        <link rel="stylesheet" href="styles/style.css">
    </head>
    <body>
        $header
        <div id="MainContent">
            <p id="CartLink"><a href="shopping_cart.php">To Cart</a></p>
            <p id="AddProductLink" hidden><a href="product_form.php">Add product</a></p>
            $productList
        </div>
        $footer
        $loginScript
        <script>
            function sendData(event) {
                if (event.submitter.value == "add") {
                    event.preventDefault();
                    
                    var submittedForm = event.submitter.form;
                    var qty = submittedForm.elements.namedItem("Qty");
                    var product = submittedForm.elements.namedItem("Product");

                    var formData = new FormData();
                    formData.append("Qty", qty.value);
                    formData.append("Product", product.value);
                    
                    fetch("src/shop_files/add_cart.php", {
                        method: 'POST',
                        body: formData
                    });
                }
            }
            
            var forms = document.getElementsByClassName("AddCartForm");
            for (index = 0; index < forms.length; index++) {
                forms[index].addEventListener("submit", sendData);
            }
        </script>
    </body>
</html>
_END;

?>
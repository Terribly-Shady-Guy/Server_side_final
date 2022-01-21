<?php

class Product
{
    private $productKey;
    private $image;
    private $name;
    private $description;
    private $price;
    private $invQty;
    private $orderQty;

    public function __construct($productValues, $orderQty = 0)
    {
        $this->productKey = $productValues['ProductKey'];
        $this->image = $productValues['ProductImage'];
        $this->name = $productValues['ProductName'];
        $this->description = $productValues['ProductDescription'];
        $this->price = $productValues['ProductPrice'];
        $this->invQty = $productValues['InventoryQty'];
        $this->orderQty = $orderQty;
    }

    public function getProductKey()
    {
        return $this->productKey;
    }

    public function getProductSubtotal()
    {
        return $this->price * $this->orderQty;
    }

    public function getOrderQty()
    {
        return $this->orderQty;
    }

    public function addOrderQty($orderQty)
    {
        $this->orderQty += $orderQty;
    }

    public function createProductCard()
    {
        $productKey = htmlspecialchars($this->productKey);
        $image = htmlspecialchars($this->image);
        $name = htmlspecialchars($this->name);
        $description = htmlspecialchars($this->description);
        $price = htmlspecialchars($this->price);
        $price = "$" . number_format($price, 2);
        $invQty = htmlspecialchars($this->invQty);

        return <<<_END
        <div class="ProductCard">
            <img src="images/$image">
            <h3 class="ProductName">$name</h3>
            <p class="ProductDescription">$description</p>
            <p class="ProductQty">Items in stock: $invQty</p>
            <p class="ProductPrice">$price</p>
            <form class="AddCartForm" action="" method="post">
                <div class="FormRow">
                    <label>Qty:</label> 
                    <input type="text" id="Qty" name="Qty" size="3" maxlength="2" value="1" autocomplete="off">
                    <input type="hidden" id="Product" name="Product" value="$productKey">
                    <input type="submit" name="Add" value="add">
                </div>
                <div class="FormRow">
                    <input type="submit" name="update" value="update" class="Update" hidden formaction="update_form.php">
                    <input type="submit" name="delete" value="delete" class="Delete" hidden formaction="src/shop_files/delete_product.php">
                </div>
            </form>
        </div>\n
        _END;
    }

    public function createCartCard()
    {
        $productKey = htmlspecialchars($this->productKey);
        $image = htmlspecialchars($this->image);
        $name = htmlspecialchars($this->name);
        $description = htmlspecialchars($this->description);
        $price = htmlspecialchars($this->price);
        $price = "$" . number_format($price, 2);
        $orderQty = htmlspecialchars($this->orderQty);

        $subtotal = $this->price * $this->orderQty;
        $subtotal = "$" . number_format($subtotal, 2);

        return <<<_END
        <div class="CartItem">
            <div class="CartItemCol">
                <img src="images/$image">
            </div>
            <div Class="CartItemCol">
                <h3 class="ProductName">$name</h3>
                <p class="ProductDescription">$description</p>
                <p class="ProductQty">$orderQty</p>
                <p class="ProductPrice">$price</p>
            </div>
            <div class="CartItemCol">
                <p class="ItemSubtotal">$subtotal<p>
                <form method="post" action="src/cart_files/remove_item.php">
                    <input type="submit" name="remove" value="remove">
                    <input type="hidden" name="Product" value="$productKey">
                </form>
            </div>
        </div>\n
        _END;
    }
}

?>
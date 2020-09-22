<?php
  include_once 'header.php'
?>

<h1>All Products</h1>

<div id="all">
    
    <div class="product" onclick="openDesc('product1Desc')">
        <img src="product_images/product1.jpg" class="image">
        <p class="product_name">product1</p>
        <p class="product_price">$499.99</p>
        <form action="includes/products-inc.php" method="POST">
            <label for="add_product1" class="ask_quant" onclick="noShow()">Quantity: </label>
            <input id="add_product1" name="quantity" type="number" value="0" min="0" class="quant" onclick="noShow()">
            <input type="hidden" name="product_bought" value="product1">
            <input id="the" type="submit" name="submit" value="Add to cart" onclick="noShow()">
        </form>
    </div>
    <div class="description" id="product1Desc">
        <a class="close" onclick="closeDesc('product1Desc')">&#10006</a>
        <h1 class="desc_head">product1</h1>
        <p class="desc_cont">This is a state of the art laptop with 256GB SSD hard drive with 16 GB RAM</p>
    </div>

    <div class="product" onclick="openDesc('product2Desc')">
        <img src="product_images/product2.jpg" class="image">
        <p class="product_name">product2</p>
        <p class="product_price">$79.99</p>
        <form action="includes/products-inc.php" method="POST">
            <label for="add_product2" class="ask_quant" onclick="noShow()">Quantity: </label>
            <input id="add_product2" name="quantity" type="number" value="0" min="0" class="quant" onclick="noShow()">
            <input type="hidden" name="product_bought" value="product2">
            <input type="submit" name="submit" value="Add to cart" onclick="noShow()">
        </form>
    </div>
    <div class="description" id="product2Desc">
        <a class="close" onclick="closeDesc('product2Desc')">&#10006</a>
        <h1 class="desc_head">product2</h1>
        <p class="desc_cont">High quality sound output, wireless connection, and noise cancelling functionality</p>
    </div>

    <div class="product" onclick="openDesc('product3Desc')">
        <img src="product_images/product3.png" class="image">
        <p class="product_name">product3</p>
        <p class="product_price">$550.00</p>
        <form action="includes/products-inc.php" method="POST">
            <label for="add_product3" class="ask_quant" onclick="noShow()">Quantity: </label>
            <input id="add_product3" name="quantity" type="number" value="0" min="0" class="quant" onclick="noShow()">
            <input type="hidden" name="product_bought" value="product3">
            <input type="submit" name="submit" value="Add to cart" onclick="noShow()">
        </form>
    </div>
    <div class="description" id="product3Desc">
        <a class="close" onclick="closeDesc('product3Desc')">&#10006</a>
        <h1 class="desc_head">product3</h1>
        <p class="desc_cont">OLED display with 4K resolution and 60fps</p>
    </div>

    <div class="product" onclick="openDesc('product4Desc')">
        <img src="product_images/product4.png" class="image">
        <p class="product_name">product4</p>
        <p class="product_price">$299.00</p>
        <form action="includes/products-inc.php" method="POST">
            <label for="add_cell_product4" class="ask_quant" onclick="noShow()">Quantity: </label>
            <input id="add_cell_product4" name="quantity" type="number" value="0" min="0" class="quant" onclick="noShow()">
            <input type="hidden" name="product_bought" value="product4">
            <input type="submit" name="submit" value="Add to cart" onclick="noShow()">
        </form>
    </div>
    <div class="description" id="product4Desc">
        <a class="close" onclick="closeDesc('product4Desc')">&#10006</a>
        <h1 class="desc_head">product4</h1>
        <p class="desc_cont">New iPhone 11 with all the same features as previous models</p>
    </div>
</div>

<script src="products_script.js"></script>
<?php
  include_once 'footer.php'
?>
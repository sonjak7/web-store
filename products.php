<?php
  include_once 'header.php';
  include_once 'includes/db-inc.php';

  if(!(isset($_SESSION['userID']))){
    die('Not logged in');
  }

?>

<h1>All Products</h1>

<div id="all">
    
<?php

    $product_query = "SELECT productID, productName, price, image_path, description FROM products";
    $product_result = mysqli_query($conn, $product_query);
    if (!$product_result) {
        die("Query FAILED");
    }

    // $productArr = mysqli_fetch_array($product_result);  //create 2D array of all products
    // $fields_num = mysqli_num_fields($product_result);   //# of products


    while($row = mysqli_fetch_object($product_result)){
        $key = $row->productID;  //ID of product, used to open product description when clicked
        $name = $row->productName;
        $price = $row->price;
        $image_path = $row->image_path;
        $description = $row->description;

        //product information/add to cart button
        echo "<div class='product' onclick='openDesc($key)'>
                <p class='product_name'>$name</p>
                <p class='product_price'>$$price</p>      
                <div class='image_container'><img class='image' src='$image_path'></div>
                <form action='includes/products-inc.php' method='POST'>
                 <label for='add' class='ask_quant' onclick='noShow()'>Quantity: </label>
                 <input id='add' name='quantity' type='number' value='0' min='0' class='quant' onclick='noShow()'>
                 <input type='hidden' name='product_bought' value=$key>
                 <input id='the' type='submit' name='add_to_cart' value='Add to cart' onclick='noShow()'>
                </form>";
              
        //remove from cart button
        if($_SESSION['isAdmin'] == 1){
            echo "  <form action='includes/products-inc.php' method='POST' onsubmit='return confirm(\"Are you sure you want to remove $name?\");'>
                    <input type='hidden' name='product_deleted' value=$key>
                    <input class='remove_product' type='submit' name='delete_product' value='Delete Product' onclick='noShow()'>
                    </form>";
        }

        //description box for product
        echo " </div><div class='description' id='$key'>
                <a class='close' onclick='closeDesc($key)'>&#10006</a>
                <h1 class='desc_head'>$name</h1>
                <p class='desc_cont'>$description</p>
               </div>";
    }

?>
<!-- 
    // <div class="product" onclick="openDesc('product1Desc')">
    //      <div class="image_container"><img src="product_images/product1.jpg" class="image"></div> 
    //     <p class="product_name">product1</p>
    //     <p class="product_price">$499.99</p>
    //     <form action="includes/products-inc.php" method="POST">
    //         <label for="add_product1" class="ask_quant" onclick="noShow()">Quantity: </label>
    //         <input id="add_product1" name="quantity" type="number" value="0" min="0" class="quant" onclick="noShow()">
    //         <input type="hidden" name="product_bought" value="product1">
    //         <input id="the" type="submit" name="submit" value="Add to cart" onclick="noShow()">
    //     </form>
    // </div>
    // <div class="description" id="product1Desc">
    //     <a class="close" onclick="closeDesc('product1Desc')">&#10006</a>
    //     <h1 class="desc_head">product1</h1>
    //     <p class="desc_cont">This is a state of the art laptop with 256GB SSD hard drive with 16 GB RAM</p>
    // </div>

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
</div> -->

<script src="products_script.js"></script>
<?php
  include_once 'footer.php'
?>
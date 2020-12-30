<?php
  include_once 'header.php';
  include_once 'includes/db-inc.php';

  if(!(isset($_SESSION['userID']))){
    die('Not logged in');
  }
  if($_SESSION['isAdmin'] == 0){
      die('Access Denied');
  }
?>

<h1 style="text-align: left">Add New Product</h1>

<form action='includes/add-product-inc.php' method='POST'>
  <label for="name" class="ask_prod">Product Name: </label>
  <input id="name" type="text" name="name" class="add-prod" required><br>

  <label for="price" class="ask_prod">Product Price: </label>
  <input id="price" type="number" step="0.01" min="0" name="price" class="add-prod" required><br>

  <label for="image" class="ask_prod">Product Image File Name: </label>
  <input id="image" type="text" min="0" name="image" class="add-prod" placeholder="productx.jpg *from product_images folder*"><br>

  <label for="description" class="ask_prod">Product Description: </label>
  <textarea id="description" type="text" name="description" class="add-prod"></textarea><br>

  <input id="add_product" type="submit" name="add_product" value="Add Product">
</form>

<?php
  include_once 'footer.php';
?>
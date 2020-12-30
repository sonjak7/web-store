<?php
  include_once 'header.php';
  include_once 'includes/db-inc.php';

  if(!(isset($_SESSION['userID']))){
    die('Not logged in');
  }
  if($_SESSION['isAdmin'] == 0){
      die('Access Denied');
  }

  echo "<h1 style='text-align: left'>Track Orders</h1>";

  echo "<form action='' method='POST'>

    <fieldset class='filter_field'>
    <legend style='color:black'>Filter By</legend>

    <label for='date' class='ask_filter' class='ord_input'>Date: </label>
    <input id='date' type='date' name='date'>";

    $user_query = "SELECT userID, firstname, lastname FROM Users";
    $user_result = mysqli_query($conn, $user_query);
    if (!$user_result) {
        die("Failed to find users");
    }
    echo "<label for='user' class='ask_filter' class='ord_input'>User: </label>
    <select name='user' id='user'>
    <option></option>";
    while($row = mysqli_fetch_object($user_result)){
      echo "<option value=$row->userID>$row->userID - $row->firstname $row->lastname</option>";
    }
    echo "</select>";


    $product_query = "SELECT productID, productName FROM Products";
    $product_result = mysqli_query($conn, $product_query);
    if (!$product_result) {
        die("Failed to find products");
    }
    echo "<label for='product' class='ask_filter' class='ord_input'>Product: </label>
    <select name='product' id='product'>
    <option></option>";
    while($row = mysqli_fetch_object($product_result)){
      echo "<option value=$row->productID>$row->productID - $row->productName</option>";
    }
    echo "</select>";
  
    echo "<span class='ask_filter'>Shipping Status: </span>";
    echo "<input type='radio' id='shipped' name='ship_stat' value='1'>";
    echo "<label for='shipped' class='rad_filter'>Shipped</label>";
    echo "<input type='radio' id='not_shipped' name='ship_stat' value='0'>";
    echo "<label for='not_shipped' class='rad_filter'>Not Shipped</label>";
    echo "<input type='radio' id='all_ships' name='ship_stat' value='2' checked='checked'>";
    echo "<label for='all_ships' class='rad_filter'>All</label>";

    echo "<input id='filter' type='submit' name='filter' value=Search Orders>
    </fieldset></form>";


if (isset($_POST['filter'])) {
  $date = mysqli_real_escape_string($conn, $_POST['date']);
  $user = mysqli_real_escape_string($conn, $_POST['user']);
  $product = mysqli_real_escape_string($conn, $_POST['product']);
  $ship_stat = mysqli_real_escape_string($conn, $_POST['ship_stat']);

  $query = "SELECT up.orderID, CONCAT(u.firstname, ' ', u.lastname) AS userName, p.productName, (p.price * up.quantity) AS total, up.quantity, up.date, up.isShipped FROM 
  Users_Products up INNER JOIN Users u ON up.userID = u.userID INNER JOIN Products p ON up.productID = p.productID";

  //if the user is using ANY filter
  if($date != NULL or $user != NULL or $product != NULL or $ship_stat != 2){
    $query .= " WHERE";
    
    //if one of the filters was 'date'
    if($date != NULL){
      $query .= " up.date = CAST('". $date ."' AS DATE)";
    }

    //if one of the filters was 'user' and the 'date' filter was not used
    if($user != NULL and $date == NULL){
      $query .= " u.userID = $user";
    }
    //if both 'date' and 'user' filter was used(AND is now needed)
    else if($user != NULL){
      $query .= " AND u.userID = $user";
    }

    //same logic as above
    if($product != NULL and $date == NULL and $user == NULL){
      $query .= " p.productID = $product";
    }
    else if($product != NULL){
      $query .= " AND p.productID = $product";
    }

    //same logic as above
    if($ship_stat != 2 and $date == NULL and $user == NULL and $product == NULL){
      $query .= " up.isShipped = $ship_stat";
    }
    else if($ship_stat != 2){
      $query .= " AND up.isShipped = $ship_stat";
    }
  }

  $result = mysqli_query($conn, $query);
  if (!$result) {
      die("Failed to find info");
  }

  echo "<h1> Results </h1>";
  echo "<table border='1'><tr>";
  // printing table headers
  echo "<td><h4>User</h4></td>";
  echo "<td><h4>Product Purchased</h4></td>";
  echo "<td><h4>Quantity</h4></td>";
  echo "<td><h4>Date</h4></td>";
  echo "<td><h4>Shipping Status</h4></td>";
  echo "<td><h4>Total</h4></td>";
  echo "</tr>";

  while($row = mysqli_fetch_object($result)){
    $orderID = $row->orderID;
    $userName = $row->userName;
    $productName = $row->productName;
    $quantity = $row->quantity;
    $date = $row->date;
    $total = round($row->total, 2);
    if($row->isShipped == 1){
        $tellShipped = "Shipped";
    }
    else{
        $tellShipped = "Not Shipped";
    }
    echo "<tr>";
    echo "<td>$userName</td>";
    echo "<td>$productName</td>"; 
    echo "<td>$quantity</td>";
    echo "<td>$date</td>";	 
    echo "<td>$tellShipped</td>";
    echo "<td>$$total</td>";
    if($row->isShipped == 0){
      echo "<form action='includes/track-order-inc.php' method='POST'>";
      echo "<td style='background-color:transparent'>";
      echo "<input type='hidden' name='prod_shipped' value='$orderID'>";
      echo "<input type='submit' name='ship' value='Ship' class='ship'>";
      echo "</td></form>";
    }
    echo "</tr>";
  }
}
  include_once 'footer.php';
?>
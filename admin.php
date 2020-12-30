<?php
  include_once 'header.php';
  include_once 'includes/db-inc.php';

  if(!(isset($_SESSION['userID'])) or $_SESSION['isAdmin'] != 1){
    die('Not allowed');
  }
?>

<a href="orders.php" class="control_button">Track Orders</a>
<a href="add-prod.php" class="control_button">Add Product</a>
<a href="users.php" class="control_button">Show Users</a>

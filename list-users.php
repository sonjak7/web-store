<?php
  include_once 'header.php';
  include_once 'includes/db-inc.php';

  if(!(isset($_SESSION['userID']))){
    die('Not logged in');
  }
  if($_SESSION['isAdmin'] == 0){
      die('Access Denied');
  }

  $query = "SELECT userID, firstname, lastname, email_ID, isAdmin FROM Users";
  $result = mysqli_query($conn, $query);
  if (!$result) {
      die("Failed to find users");
  }

  echo "<h1> All Users </h1>";
  echo "<table border='1'><tr>";
  // printing table headers
  echo "<td><h4>User ID</h4></td>";
  echo "<td><h4>First Name</h4></td>";
  echo "<td><h4>Last Name</h4></td>";
  echo "<td><h4>Email ID</h4></td>";
  echo "<td><h4>Administrator</h4></td>";
  echo "</tr>";

  while($row = mysqli_fetch_object($result)){
    $userID = $row->userID;
    $firstname = $row->firstname;
    $lastname = $row->lastname;
    $email_ID = $row->email_ID;
    if($row->isAdmin == 1){
        $tellAdmin = "Yes";
    }
    else{
        $tellAdmin = "No";
    }
    echo "<tr>";
    echo "<td>$userID</td>";
    echo "<td>$firstname</td>"; 
    echo "<td>$lastname</td>";
    echo "<td>$email_ID</td>";	 
    echo "<td>$tellAdmin</td>";
    // echo "<td class='mod_cell remove'><form action='includes/deletes-inc.php' method='POST'>	
    // <input type='hidden' name='product_deleted' value='$row->productID'>
    // <input type='submit' name='submit' class='delete_prod' value='Remove'>
    // </form></td>";	//delete button for product
    echo "</tr>";
  }

  include_once 'footer.php';
?>
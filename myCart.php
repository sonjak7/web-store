<?php
	include_once 'header.php';
	include_once 'includes/db-inc.php';

	if(!(isset($_SESSION['userID']))){
		die('Not logged in');
	}

	$userID = $_SESSION['userID'];
	$firstname = $_SESSION['firstname'];
	$lastname = $_SESSION['lastname'];

	$info_query = "SELECT up.productID, p.productName, p.price, up.quantity, (up.quantity * p.price) AS net FROM Users_Products up INNER JOIN Products p ON up.productID = p.productID WHERE up.isPurchased = 0 AND up.isShipped = 0 AND up.userID = $userID";
	//find the product name, price, quantity, and total price (quantity * price) of all products in user's cart

	$info_result = mysqli_query($conn, $info_query);
	if (!$info_result) {
		die("Query to show fields from table failed");
	}

	$total_query = "SELECT SUM(up.quantity * p.price) FROM Users_Products up INNER JOIN Products p ON up.productID = p.productID WHERE up.isPurchased = 0 AND up.isPurchased = 0 AND up.userID = $userID";
	//find the total balance in cart: summation of (quantity * price) for each product

	$total_result = mysqli_query($conn, $total_query);
	if (!$total_result) {
		die("Query failed to find total");
	}
	$total_arr = mysqli_fetch_array($total_result);
	$total = round($total_arr[0], 2);
	

	echo "<h1> MY CART | $firstname $lastname </h1>";
	echo "<h1> TOTAL | $$total </h1>";

	echo "<table border='1'><tr>";
	// printing table headers
	echo "<td><h4>Product</h4></td>";
	echo "<td><h4>Price</h4></td>";
	echo "<td><h4>Quantity</h4></td>";
	echo "<td><h4>Total</h4></td>";
	echo "</tr>";

    while($row = mysqli_fetch_object($info_result)){
		$name = $row->productName;
		$price = round($row->price, 2);
		$quantity = $row->quantity;
		$net = round($row->net, 2);

		echo "<tr>";
		echo "<td>$name</td>";
		echo "<td>$$price</td>"; 
		echo "<td>$quantity</td>";	
		echo "<td>$$net</td>";
		echo "<td class='mod_cell remove'><form action='includes/deletes-inc.php' method='POST'>	
		<input type='hidden' name='product_deleted' value='$row->productID'>
		<input type='submit' name='submit' class='delete_prod' value='Remove'>
		</form></td>";	//delete button for product
		// INDIVIDUAL PURCHASES
		// echo "<td class='mod_cell'><form action='includes/purchase-inc.php' method='POST'>
		// <input type='hidden' name='product_purchased' value='$row->productID'>
		// <input type='submit' name='submit' class='edit' value='Purchase'>
		// </form></td>"; //purchase button for product
		echo "</tr>";
	}
	echo "</table>";

	$len = mysqli_num_rows($info_result);
	if($len > 0){	//if there are products in the cart
		echo "<form action='includes/purchase-inc.php' method='POST'>";
		echo "<input type='submit' name='submit' class='edit' value='Purchase'></form>";
	}

	// printing table contents
	// for($i=0; $i<$fields_num; $i++) {
	// 	$field = mysqli_fetch_field($result);
	// 	$price_index = $i * 2 + 2;		// will retrieve index of current product price in $cartArr
	// 	$quantity_index = $i * 2 + 1;	// will retrieve index of current quantity value in $cartArr
	// 	if($cartArr[$quantity_index] > 0){
	// 		echo "<tr>";
	// 		echo "<td>$field->name</td>";
	// 		echo "<td>$$cartArr[$price_index]</td>"; 
	// 		echo "<td>$cartArr[$quantity_index]</td>";	
	// 		echo "<td>$$all_prices[$i]</td>";
	// 		echo "<td class='delete_cell'><form action='includes/deletes-inc.php' method='POST'>	
	// 		<input type='hidden' name='product_deleted' value='$row->productID'>
	// 		<input type='submit' name='submit' value='Delete'>
	// 		</form></td>";	//delete button for product
	// 		echo "</tr>";
	// 	}
	// }
	
	//PRINTS DATABASE ITEMS ALTOGETHER, USED FOR HORIZONTAL TABLE 
	// while($row = mysqli_fetch_row($result)) {
	// 	echo "<tr>";
	// 	// $row is array... foreach( .. ) puts every element
	// 	// of $row to $cell variable
	// 	foreach($row as $cell)
	// 		echo "<td>$cell</td>";
	// 	echo "</tr>\n";
	// }
	// echo "<tr>";

	// mysqli_free_result($result);
	// mysqli_close($conn);

	include_once 'footer.php';
?>

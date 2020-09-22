<?php
	include_once 'header.php';
	include_once 'includes/db-inc.php';

	$email_ID = $_SESSION['email_ID'];

	$query = "SELECT product1,product2,product3,product4 FROM cart WHERE cart.email_ID = '$email_ID'";

	$result = mysqli_query($conn, $query);
	if (!$result) {
		die("Query to show fields from table failed");
	}

	//Get total # of products
	$query1 = "SELECT * FROM cart WHERE cart.email_ID = '$email_ID'";
	$result1 = mysqli_query($conn, $query1);
	if (!$result1) {
		die("Query1 FAILED");
	}

	$cartArr = mysqli_fetch_array($result1);

	// $all_quantities = [$cartArr[1], $cartArr[3], $cartArr[5], $cartArr[7]];
	$total_p1 = $cartArr[1] * $cartArr[2];
	$total_p2 = $cartArr[3] * $cartArr[4];
	$total_p3 = $cartArr[5] * $cartArr[6];
	$total_p4 = $cartArr[7] * $cartArr[8];
	$all_prices = [$total_p1, $total_p2, $total_p3, $total_p4];
	$grand_total = $total_p1 + $total_p2 + $total_p3 + $total_p4;
	

	// get number of columns in table
	$fields_num = mysqli_num_fields($result);
	echo "<h1> MY CART | $email_ID </h1>";
	echo "<h1> TOTAL | $$grand_total </h1>";

	echo "<table border='1'><tr>";
	// printing table headers
	echo "<td><h4>Product</h4></td>";
	echo "<td><h4>Price</h4></td>";
	echo "<td><h4>Quantity</h4></td>";
	echo "<td><h4>Total</h4></td>";
	echo "</tr>";

	// printing table contents
	for($i=0; $i<$fields_num; $i++) {
		$field = mysqli_fetch_field($result);
		echo "<tr>";
		echo "<td>$field->name</td>";
		$price_index = $i * 2 + 2;		// will retrieve index of current product price in $cartArr
		$quantity_index = $i * 2 + 1;	// will retrieve index of current quantity value in $cartArr
		echo "<td>$$cartArr[$price_index]</td>"; 
		echo "<td>$cartArr[$quantity_index]</td>";	
		echo "<td>$$all_prices[$i]</td>";
		echo "<td class='delete_cell'><form action='includes/deletes-inc.php' method='POST'>	
		<input type='hidden' name='product_deleted' value='$field->name'>
		<input type='submit' name='submit' value='Delete'>
		</form></td>";	//delete button for product
		echo "</tr>";
	}
	
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

	mysqli_free_result($result);
	mysqli_close($conn);

	include_once 'footer.php';
?>

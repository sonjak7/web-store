<?php
	include_once 'header.php';
	include_once 'includes/db-inc.php';

	$email_ID = $_SESSION['email_ID'];

	$query = "SELECT product1,product2,product3 FROM cart WHERE cart.email_ID = '$email_ID'";

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

	$total_p1 = $cartArr[1] * $cartArr[2];
	$total_p2 = $cartArr[3] * $cartArr[4];
	$total_p3 = $cartArr[5] * $cartArr[6];
	$grand_total = $total_p1 + $total_p2 + $total_p3;

	// get number of columns in table
	$fields_num = mysqli_num_fields($result);
	echo "<h1> MY CART | $email_ID </h1>";
	echo "<h1> TOTAL | $$grand_total </h1>";
	echo "<table border='1'><tr>";

	// printing table headers
	for($i=0; $i<$fields_num; $i++) {
		$field = mysqli_fetch_field($result);
		echo "<td><b>$field->name</b></td>";
	}
	echo "</tr>\n";
	while($row = mysqli_fetch_row($result)) {
		echo "<tr>";
		// $row is array... foreach( .. ) puts every element
		// of $row to $cell variable
		foreach($row as $cell)
			echo "<td>$cell</td>";
		echo "</tr>\n";
	}

	mysqli_free_result($result);
	mysqli_close($conn);

	include_once 'footer.php';
?>
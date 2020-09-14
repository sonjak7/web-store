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

	$total_p1 = $cartArr[1] * $cartArr[2];
	$total_p2 = $cartArr[3] * $cartArr[4];
	$total_p3 = $cartArr[5] * $cartArr[6];
	$total_p4 = $cartArr[7] * $cartArr[8];
	$grand_total = $total_p1 + $total_p2 + $total_p3 + $total_p4;

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
	echo "<tr>";

	// $resultQ is same as $result, used to re-loop through products
	$resultQ = mysqli_query($conn, $query);
	if (!$resultQ) {
		die("Query to show fields from table failed");
	}

	
	for($x=0; $x<$fields_num; $x++) {
		$field = mysqli_fetch_field($resultQ);

		// if($field->name == "product1"){
		// 	$prod_delete = "UPDATE cart SET product1 = 0 WHERE cart.email_ID = '$email_ID'";
		// }
		// if($field->name == "product2"){
		// 	$prod_delete = "UPDATE cart SET product2 = 0 WHERE cart.email_ID = '$email_ID'";
		// }
		// if($field->name == "product3"){
		// 	$prod_delete = "UPDATE cart SET product3 = 0 WHERE cart.email_ID = '$email_ID'";
		// }
		// if($field->name == "product4"){
		// 	$prod_delete = "UPDATE cart SET product4 = 0 WHERE cart.email_ID = '$email_ID'";
		// }
		//$result_pd = mysqli_query($conn, $prod_delete);
		/*if(!$result_pd) {
			die("Query FAILED");
		}*/
		//echo "<td><button type='button' onclick='alert(\"$field->name\")'>Delete</button></td>";
		$prod_delete = "UPDATE cart SET $field->name = 0 WHERE cart.email_ID = '$email_ID'";
		echo "<td><button type='button' onclick=mysqli_query($conn, $prod_delete)>Delete</button></td>";
	}

	mysqli_free_result($result);
	mysqli_close($conn);

	include_once 'footer.php';
?>

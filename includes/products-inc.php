<?php
	session_start();
  	if (isset($_POST['submit'])) {
    	include 'db-inc.php';

        $email_ID = $_SESSION['email_ID'];

		//User inputs
		$quantity = mysqli_real_escape_string($conn, $_POST['quantity']);
        $product_bought = mysqli_real_escape_string($conn, $_POST['product_bought']);

		if($quantity == 0){
			$message_status = "Quantity must be greater than 0";
            echo "<script type='text/javascript'>alert('$message_status');</script>";
            echo "<script type='text/javascript'> document.location = '../products.php'; </script>";
        }
        else{
            $query = "SELECT $product_bought FROM cart WHERE email_ID = '$email_ID'";
            $result = mysqli_query($conn, $query);
	        if(!$result) {
		        die("Query failed");
            }
            $cartArr = mysqli_fetch_array($result);
	        $curr_prod = $cartArr[0];

            $query = "UPDATE cart SET $product_bought = '$quantity' + '$curr_prod' WHERE email_ID = '$email_ID'";
            $result = mysqli_query($conn, $query);
	        if(!$result) {
		        die("Query failed");
            }
            $message_status = "$quantity item/s added to cart";
            echo "<script type='text/javascript'>alert('$message_status');</script>";
            echo "<script type='text/javascript'> document.location = '../products.php'; </script>";
        }
	}
	else{
        header("Location: ../products.php");
		exit();
	}	
?>
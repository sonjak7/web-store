<?php
	session_start();
  	if (isset($_POST['submit'])) {
    	include 'db-inc.php';

        $email_ID = $_SESSION['email_ID'];

        //User inputs
        $product_deleted = mysqli_real_escape_string($conn, $_POST['product_deleted']);

        $query = "UPDATE cart SET $product_deleted = 0 WHERE cart.email_ID = '$email_ID'";
        $result = $result = mysqli_query($conn, $query);
        if(!$result) {
            die("Query failed");
        }
        $message_status = "deleted $product_deleted";
        echo "<script type='text/javascript'>alert('$message_status');</script>";
        echo "<script type='text/javascript'> document.location = '../myCart.php'; </script>";
    }
    else{
        header("Location: ../myCart.php");
        exit();
    }	
?>
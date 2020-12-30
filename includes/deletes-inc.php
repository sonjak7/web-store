<?php
	session_start();
  	if (isset($_POST['submit'])) {
    	include 'db-inc.php';

        $userID = $_SESSION['userID'];

        //User inputs
        $product_deleted = mysqli_real_escape_string($conn, $_POST['product_deleted']);

        $query = "DELETE FROM Users_Products WHERE userID = ? AND productID = ?";
        $stmt = mysqli_stmt_init($conn); //Creating param query
        mysqli_stmt_prepare($stmt, $query);
        mysqli_stmt_bind_param($stmt, "ss", $userID, $product_deleted);
        if(!(mysqli_stmt_execute($stmt))){
            die("Query failed");
        }
        $message_status = "Product removed";
        echo "<script type='text/javascript'>alert('$message_status');</script>";
        echo "<script type='text/javascript'> document.location = '../myCart.php'; </script>";
    }
    else{
        header("Location: ../myCart.php");
        exit();
    }	
?>
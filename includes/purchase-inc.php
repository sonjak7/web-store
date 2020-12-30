<?php
	session_start();
  	if (isset($_POST['submit'])) {
    	include 'db-inc.php';

        $userID = $_SESSION['userID'];
        date_default_timezone_set("America/Los_Angeles");
        $date = date("Y-m-d");

        $query = "UPDATE Users_Products SET isPurchased = 1, date = CAST('". $date ."' AS DATE) WHERE userID = ? AND isShipped = 0 AND isPurchased = 0";
        $stmt = mysqli_stmt_init($conn); //Creating param query
        mysqli_stmt_prepare($stmt, $query);
        mysqli_stmt_bind_param($stmt, "s", $userID);
        if(!(mysqli_stmt_execute($stmt))){
            die("Query failed");
        }
        $message_status = "Products purchased";
        echo "<script type='text/javascript'>alert('$message_status');</script>";
        echo "<script type='text/javascript'> document.location = '../myCart.php'; </script>";
    }

    // CODE FOR PURCHASING INDIVIDUAL PRODUCTS
    //     $product_purchased = mysqli_real_escape_string($conn, $_POST['product_purchased']);
    //     date_default_timezone_set("America/Los_Angeles");
    //     $date = date("Y-m-d");

    //     $query = "UPDATE Users_Products SET isPurchased = 1, date = CAST('". $date ."' AS DATE) WHERE userID = ? AND productID = ? AND isShipped = 0";
    //     $stmt = mysqli_stmt_init($conn); //Creating param query
    //     mysqli_stmt_prepare($stmt, $query);
    //     mysqli_stmt_bind_param($stmt, "ss", $userID, $product_purchased);
    //     if(!(mysqli_stmt_execute($stmt))){
    //         die("Query failed");
    //     }
    //     $message_status = "Product purchased";
    //     echo "<script type='text/javascript'>alert('$message_status');</script>";
    //     echo "<script type='text/javascript'> document.location = '../myCart.php'; </script>";
    // }
    else{
        header("Location: ../myCart.php");
        exit();
    }	
?>
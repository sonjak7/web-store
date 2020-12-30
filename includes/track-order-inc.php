<?php
    session_start();
    include 'db-inc.php';

  	if (isset($_POST['ship'])) {
        $prod_shipped = mysqli_real_escape_string($conn, $_POST['prod_shipped']);
        $query = "UPDATE Users_Products SET isShipped = 1 WHERE orderID = ?";
        $stmt = mysqli_stmt_init($conn); //Creating param query
        mysqli_stmt_prepare($stmt, $query);
        mysqli_stmt_bind_param($stmt, "s", $prod_shipped);
        if(!(mysqli_stmt_execute($stmt))){
            $message_status = "Unable to ship product";
            echo "<script type='text/javascript'>alert('$message_status');</script>";
            echo "<script type='text/javascript'> document.location = '../track-orders.php'; </script>";
            exit();
        }
        $message_status = "Product shipped!";
        echo "<script type='text/javascript'>alert('$message_status');</script>";
        echo "<script type='text/javascript'> document.location = '../track-orders.php'; </script>";
    }
?>

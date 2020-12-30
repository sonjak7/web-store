<?php
    session_start();
    include 'db-inc.php';

  	if (isset($_POST['add_product'])) {
        $name = mysqli_real_escape_string($conn, $_POST['name']);
        $price = mysqli_real_escape_string($conn, $_POST['price']);
        $image = mysqli_real_escape_string($conn, $_POST['image']);
        $description = mysqli_real_escape_string($conn, $_POST['description']);
        $image_path = 'product_images/' . $image;

        $query = "INSERT INTO Products(productName, price, image_path, description) VALUES (?, ?, ?, ?)";
        $stmt = mysqli_stmt_init($conn); //Creating param query
        mysqli_stmt_prepare($stmt, $query);
        mysqli_stmt_bind_param($stmt, "ssss", $name, $price, $image_path, $description);
        if(!(mysqli_stmt_execute($stmt))){
            $message_status = "Unable to add product";
            echo "<script type='text/javascript'>alert('$message_status');</script>";
            echo "<script type='text/javascript'> document.location = '../add-product.php'; </script>";
            exit();
        }
        $message_status = "Product added!";
        echo "<script type='text/javascript'>alert('$message_status');</script>";
        echo "<script type='text/javascript'> document.location = '../add-product.php'; </script>";
    }
?>
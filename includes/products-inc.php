<!-- ADD SELECTED ITEM TO CART, WITH GIVEN QUANTITY -->
<?php
    session_start();

    include 'db-inc.php';

    if (isset($_POST['delete_product'])) {
        $product_deleted = mysqli_real_escape_string($conn, $_POST['product_deleted']);
        $query = "DELETE FROM Products WHERE productID = ?";
        $stmt = mysqli_stmt_init($conn); //Creating param query
        mysqli_stmt_prepare($stmt, $query);           
        mysqli_stmt_bind_param($stmt, "s", $product_deleted);
        if(!(mysqli_stmt_execute($stmt))){
            $message_status = "Could not delete product";
            echo "<script type='text/javascript'>alert('$message_status');</script>";
            echo "<script type='text/javascript'> document.location = '../products.php'; </script>";
            exit();
        }
        else{
            $message = "Product deleted!";
            echo "<script type='text/javascript'>alert('$message');</script>";
            echo "<script type='text/javascript'> document.location = '../products.php'; </script>";
        }
    }
  	else if (isset($_POST['add_to_cart'])) {
		//User inputs
		$quantity = mysqli_real_escape_string($conn, $_POST['quantity']);
        $product_bought = mysqli_real_escape_string($conn, $_POST['product_bought']);
        $userID = $_SESSION['userID']; 
        
		if($quantity == 0){
			$message_status = "Quantity must be greater than 0";
            echo "<script type='text/javascript'>alert('$message_status');</script>";
            echo "<script type='text/javascript'> document.location = '../products.php'; </script>";
        }
        else{
            //check if product has already been added to cart(so we know whether to add or append product)
            $check_query = "SELECT quantity FROM Users_Products WHERE userID = ? AND productID = ? AND isPurchased = 0 AND isShipped = 0";
            $check_stmt = mysqli_stmt_init($conn);
            mysqli_stmt_prepare($check_stmt, $check_query);
            mysqli_stmt_bind_param($check_stmt, "ss", $userID, $product_bought);
            mysqli_stmt_execute($check_stmt);
            $check_result = mysqli_stmt_get_result($check_stmt);
            $check_len = mysqli_num_rows($check_result);

            if($check_len == 0){ //user is adding a new product to cart
                $query = "INSERT INTO Users_Products (userID, productID, quantity) VALUES (?, ?, ?)";
                $stmt = mysqli_stmt_init($conn); //Creating param query
                mysqli_stmt_prepare($stmt, $query);           
                mysqli_stmt_bind_param($stmt, "sss", $userID, $product_bought, $quantity);
                if(!(mysqli_stmt_execute($stmt))){
                    $message_status = "Could not add to cart";
                    echo "<script type='text/javascript'>alert('$message_status');</script>";
                    echo "<script type='text/javascript'> document.location = '../products.php'; </script>";
                    exit();
                }
                else{
                    $message = "Product added!";
                    echo "<script type='text/javascript'>alert('$message');</script>";
                    echo "<script type='text/javascript'> document.location = '../products.php'; </script>";
                }
            }
            else{   //user is adding a prexisting item to their cart (append quantity)
                $checkArr = mysqli_fetch_array($check_result);
                $prev_quant = $checkArr[0];
                $new_quant = $prev_quant + $quantity;
                $query = "UPDATE Users_Products SET quantity = $new_quant WHERE userID = ? AND productID = ?";
                $stmt = mysqli_stmt_init($conn); //Creating param query
                mysqli_stmt_prepare($stmt, $query);           
                mysqli_stmt_bind_param($stmt, "ss", $userID, $product_bought);
                if(!(mysqli_stmt_execute($stmt))){
                    $message_status = "Could not append to cart";
                    echo "<script type='text/javascript'>alert('$message_status');</script>";
                    echo "<script type='text/javascript'> document.location = '../products.php'; </script>";
                    exit();
                }
                else{
                    $message = "Product appended!";
                    echo "<script type='text/javascript'>alert('$message');</script>";
                    echo "<script type='text/javascript'> document.location = '../products.php'; </script>";
                }
            }

            // $query = "INSERT INTO Users (email_ID, password, firstname, lastname, isAdmin) VALUES (?, ?, ?, ?, ?)"; 
            // $stmt = mysqli_stmt_init($conn); //Creating param query
            // mysqli_stmt_prepare($stmt, $query);
            // mysqli_stmt_bind_param($stmt, "sssss", $email_ID, $password, $firstname, $lastname, $isAdmin);
            // if(!(mysqli_stmt_execute($stmt))){
            //     $message_status = "Creating new user failed";
            //     echo "<script type='text/javascript'>alert('$message_status');</script>";
            //     echo "<script type='text/javascript'> document.location = '../index.php'; </script>";
            //     exit();
            // }
            // else{
            //     $message = "New user successfully added";
            //     echo "<script type='text/javascript'>alert('$message');</script>";
            //     echo "<script type='text/javascript'> document.location = '../index.php'; </script>";
            // }

            // $query = "SELECT $product_bought FROM cart WHERE email_ID = '$email_ID'";
            // $result = mysqli_query($conn, $query);
	        // if(!$result) {
		    //     die("Query failed");
            // }
            // $cartArr = mysqli_fetch_array($result);
	        // $curr_prod = $cartArr[0];

            // $query = "UPDATE cart SET $product_bought = '$quantity' + '$curr_prod' WHERE email_ID = '$email_ID'";
            // $result = mysqli_query($conn, $query);

	        // if(!$result) {
		    //     die("Query failed");
            // }
            // $message_status = "$quantity item/s added to cart";
            // echo "<script type='text/javascript'>alert('$message_status');</script>";
            // echo "<script type='text/javascript'> document.location = '../products.php'; </script>";

        }
	}
	else{
        header("Location: ../products.php");
		exit();
	}	
?>
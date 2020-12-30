<?php
	session_start();
  	if (isset($_POST['submit'])) {
    	include 'db-inc.php';

		//User inputs
		$firstname = mysqli_real_escape_string($conn, $_POST['firstname']);
		$lastname = mysqli_real_escape_string($conn, $_POST['lastname']);
		$email_ID = mysqli_real_escape_string($conn, $_POST['email_ID']);
		$password = mysqli_real_escape_string($conn, $_POST['password']);
		$isAdmin = 0; //FALSE

		if($email_ID == NULL || $firstname == NULL || $lastname == NULL || $password == NULL){
			$message_status = "Empty inputs";
        	echo "<script type='text/javascript'>alert('$message_status');</script>";
        	echo "<script type='text/javascript'> document.location = '../signup.php'; </script>";
      		exit();
		}
		else if(strlen($password) < 8){ // Make sure password is atleast 8 chars
			$message_status = "Password is less than 8 characters";
        	echo "<script type='text/javascript'>alert('$message_status');</script>";
        	echo "<script type='text/javascript'> document.location = '../signup.php'; </script>";
      		exit();
		}
		else{
			//Check to see if user already exists
			$query = "SELECT * FROM Users WHERE email_ID=?";
			$stmt = mysqli_stmt_init($conn); //Creating param query
			mysqli_stmt_prepare($stmt, $query);
			mysqli_stmt_bind_param($stmt, "s", $email_ID);
			mysqli_stmt_execute($stmt);
			$result = mysqli_stmt_get_result($stmt);
			$resultCheck = mysqli_num_rows($result);
			if($resultCheck != 0){
				$message_status = "User_ID already exists";
				echo "<script type='text/javascript'>alert('$message_status');</script>";
				echo "<script type='text/javascript'> document.location = '../index.php'; </script>";
				exit();
			}
			else{
				$password = $password . $salt; //Salting the password
				$password = hash('sha256', $password);

				$query = "INSERT INTO Users (email_ID, password, firstname, lastname, isAdmin) VALUES (?, ?, ?, ?, ?)"; 
				$stmt = mysqli_stmt_init($conn); //Creating param query
				mysqli_stmt_prepare($stmt, $query);
				mysqli_stmt_bind_param($stmt, "sssss", $email_ID, $password, $firstname, $lastname, $isAdmin);
				if(!(mysqli_stmt_execute($stmt))){
					$message_status = "Creating new user failed";
					echo "<script type='text/javascript'>alert('$message_status');</script>";
					echo "<script type='text/javascript'> document.location = '../index.php'; </script>";
					exit();
				}
				else{
					$message = "New user successfully added";
					echo "<script type='text/javascript'>alert('$message');</script>";
					echo "<script type='text/javascript'> document.location = '../index.php'; </script>";
				}
				

				// OLD CODE FOR CREATING USER'S CART
				// $q = 0;
				// $p1 = 499.99;
				// $p2 = 79.99;
				// $p3 = 550;
				// $cart_query = "INSERT INTO cart (email_ID, product1, prod1_price, product2, prod2_price, product3, prod3_price) VALUES (?, ?, ?, ?, ?, ?, ?)";
				// $stmt = mysqli_stmt_init($conn); //Creating param query
				// mysqli_stmt_prepare($stmt, $cart_query);
				// mysqli_stmt_bind_param($stmt, "sssssss", $email_ID, $q, $p1, $q, $p2, $q, $p3);
				// if(!(mysqli_stmt_execute($stmt))){
				// 	$message_status = "Creating new cart failed";
				// 	echo "<script type='text/javascript'>alert('$message_status');</script>";
				// 	echo "<script type='text/javascript'> document.location = '../index.php'; </script>";
				// 	exit();
				// }
				// else{
				// 	//$message = "New cart successfully added";
				// 	//echo "<script type='text/javascript'>alert('$message');</script>";
				// 	//echo "<script type='text/javascript'> document.location = '../index.php'; </script>";
				// }
			}	
		}
	}
	else{
		header("Location: ../signup.php");
		exit();
	}	
?>
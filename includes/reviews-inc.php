<?php
	session_start();
  	if (isset($_POST['submit'])) {
    	include 'db-inc.php';

        $email_ID = $_SESSION['email_ID'];
        $firstname = $_SESSION['firstname'];
        $feedback = mysqli_real_escape_string($conn, $_POST['feedback']);

        if($feedback == NULL){
            $message_status = "Empty input field";
            echo "<script type='text/javascript'>alert('$message_status');</script>";
            echo "<script type='text/javascript'> document.location = '../reviews.php'; </script>";
        }
        else{
            $query = "INSERT INTO reviews(firstname, feedback) VALUES ('$firstname', '$feedback')";
            $result = mysqli_query($conn, $query);
	        if(!$result) {
		        die("Query failed");
            }
            $message_status = "review posted";
            echo "<script type='text/javascript'>alert('$message_status');</script>";
            echo "<script type='text/javascript'> document.location = '../reviews.php'; </script>";
        }
    }
    else{
        header("Location: ../reviews.php");
		exit();
    }
?>
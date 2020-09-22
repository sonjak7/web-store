<?php
    session_start();
    include 'db-inc.php';
    $email_ID = $_SESSION['email_ID'];

  	if (isset($_POST['add_review'])) {
        $firstname = $_SESSION['firstname'];
        $feedback = mysqli_real_escape_string($conn, $_POST['feedback']);

        if($feedback == NULL){
            $message_status = "empty input field";
            echo "<script type='text/javascript'>alert('$message_status');</script>";
            echo "<script type='text/javascript'> document.location = '../reviews.php'; </script>";
            exit();
        }
        else{
            $query = "INSERT INTO reviews(firstname, email_ID, feedback) VALUES (?, ?, ?)";
            $stmt = mysqli_stmt_init($conn); //Creating param query
            mysqli_stmt_prepare($stmt, $query);
            mysqli_stmt_bind_param($stmt, "sss", $firstname, $email_ID, $feedback);
            if(!(mysqli_stmt_execute($stmt))){
                $message_status = "unable to post review";
                echo "<script type='text/javascript'>alert('$message_status');</script>";
                echo "<script type='text/javascript'> document.location = '../reviews.php'; </script>";
                exit();
            }
            $message_status = "review posted";
            echo "<script type='text/javascript'>alert('$message_status');</script>";
            echo "<script type='text/javascript'> document.location = '../reviews.php'; </script>";
        }
    }
    else if (isset($_POST['delete_review'])) {
        $review_deleted = mysqli_real_escape_string($conn, $_POST['review_deleted']);

        $query = "DELETE FROM reviews WHERE id = $review_deleted";
        $result = mysqli_query($conn, $query);
        if(!$result){
            die("Query failed");
        }
        $message_status = "review deleted";
        echo "<script type='text/javascript'>alert('$message_status');</script>";
        echo "<script type='text/javascript'> document.location = '../reviews.php'; </script>";      
    }
    else{
        header("Location: ../reviews.php");
		exit();
    }
?>
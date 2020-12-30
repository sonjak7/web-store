<?php
    session_start();
    include 'db-inc.php';

    $userID = $_SESSION['userID'];

  	if (isset($_POST['add_review'])) {
        $feedback = mysqli_real_escape_string($conn, $_POST['feedback']);

        if($feedback == NULL){
            $message_status = "Empty input field";
            echo "<script type='text/javascript'>alert('$message_status');</script>";
            echo "<script type='text/javascript'> document.location = '../reviews.php'; </script>";
            exit();
        }
        else{
            $query = "INSERT INTO Reviews(userID, feedback) VALUES (?, ?)";
            $stmt = mysqli_stmt_init($conn); //Creating param query
            mysqli_stmt_prepare($stmt, $query);
            mysqli_stmt_bind_param($stmt, "ss", $userID, $feedback);
            if(!(mysqli_stmt_execute($stmt))){
                $message_status = "Unable to post review";
                echo "<script type='text/javascript'>alert('$message_status');</script>";
                echo "<script type='text/javascript'> document.location = '../reviews.php'; </script>";
                exit();
            }
            $message_status = "Review posted!";
            echo "<script type='text/javascript'>alert('$message_status');</script>";
            echo "<script type='text/javascript'> document.location = '../reviews.php'; </script>";
        }
    }
    else if (isset($_POST['delete_review'])) {
        $review_deleted = mysqli_real_escape_string($conn, $_POST['review_deleted']);

        $query = "DELETE FROM Reviews WHERE reviewID = $review_deleted";
        $result = mysqli_query($conn, $query);
        if(!$result){
            die("Query failed");
        }
        $message_status = "Review deleted";
        echo "<script type='text/javascript'>alert('$message_status');</script>";
        echo "<script type='text/javascript'> document.location = '../reviews.php'; </script>";      
    }
    else{
        header("Location: ../reviews.php");
		exit();
    }
?>
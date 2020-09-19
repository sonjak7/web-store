<?php
  session_start();

  if (isset($_POST['submit'])){
    include 'db-inc.php';

    $email_ID=mysqli_real_escape_string($conn, $_POST['email_ID']);
    $password=mysqli_real_escape_string($conn, $_POST['password']);
		$password = $password . $salt; //Salting the password
		$password = hash('sha256', $password);

    //Check if inputs are empty
    if (($email_ID == NULL) || ($password == NULL)){
      $message_status = "Empty inputs";;
      echo "<script type='text/javascript'>alert('$message_status');</script>";
      echo "<script type='text/javascript'> document.location = '../index.php?login==emptyinput'; </script>";
      exit();
    }
    else{
      $query = "SELECT email_ID, firstname FROM User WHERE email_ID=? AND password=?";
      $stmt = mysqli_stmt_init($conn); //Creating param query
      mysqli_stmt_prepare($stmt, $query);
      mysqli_stmt_bind_param($stmt, "ss", $email_ID, $password);
      mysqli_stmt_execute($stmt);
      $result = mysqli_stmt_get_result($stmt);
      $resultCheck = mysqli_num_rows($result);
      if($resultCheck != 1){
        $message_status = "Wrong username or password";
        echo "<script type='text/javascript'>alert('$message_status');</script>";
        echo "<script type='text/javascript'> document.location = '../index.php'; </script>";
        exit();
      }
      else{
        if($finalrow = mysqli_fetch_assoc($result)){ //Used to switch to page with logged-in user
            $_SESSION['email_ID'] = $finalrow['email_ID'];
            $_SESSION['firstname'] = $finalrow['firstname'];
      
            header("Location: ../index.php?login==success");
        }
      }
    }
  }
  else{
    header("Location: ../index.php?login==error");
    exit();
  }
?>

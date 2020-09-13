<?php
  session_start();

  if (isset($_POST['submit'])){
    include 'db-inc.php';

    $email_ID=mysqli_real_escape_string($conn, $_POST['email_ID']);
    $password=mysqli_real_escape_string($conn, $_POST['password']);

    // Check if inputs are empty
    if (!isset($email_ID) || !isset($password)){
      echo "Empty Input";
      header("Location: ../index.php?login==emptyinput");
      exit();
    }
    else{
      $sql = "SELECT * FROM User WHERE email_ID='$email_ID'";
      $result = mysqli_query($conn, $sql);
      $resultCheck = mysqli_num_rows($result);
      
      // Error message email_ID
      if($resultCheck < 1){
        $message_status = "Wrong email_ID!";
        echo "<script type='text/javascript'>alert('$message_status');</script>";
        echo "<script type='text/javascript'> document.location = '../index.php'; </script>";
      }
      else{
        if($row = mysqli_fetch_assoc($result)){
          // Email_ID exists build second salt query
          $saltsql = "SELECT email_ID FROM User WHERE email_ID='$email_ID' AND password='$password'";
          $finalresult = mysqli_query($conn, $saltsql);
          if($finalrow = mysqli_fetch_assoc($finalresult)){
            // Login successful - login user
            $_SESSION['email_ID'] = $finalrow['email_ID'];
            $_SESSION['firstname'] = $finalrow['firstName'];
            $_SESSION['lastname'] = $finalrow['lastName'];
            header("Location: ../index.php?login==success");
            exit();
          }
          //Error message
          else{
            $message_status = "Wrong Password!";
            echo "<script type='text/javascript'>alert('$message_status');</script>";
            echo "<script type='text/javascript'> document.location = '../index.php'; </script>";
          }
        }
      }
    }
  }
  else{
    header("Location: ../index.php?login==error");
    exit();
  }
?>

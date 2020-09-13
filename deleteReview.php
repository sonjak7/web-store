<?php
  include_once 'header.php';
// change the value of $dbuser and $dbpass to your email_ID and password
	include 'includes/db-inc.php';

	$conn = mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);
	if (!$conn) {
		die('Could not connect: ' . mysql_error());
	}


  $reviewID = $_POST['deleteName'];

  // Check if user input is an actual restaurant ID
    $check_status = "SELECT ReviewID FROM Reviews WHERE ReviewID = '$reviewID' "; //Get data from table
    $result_status = mysqli_query($conn, $check_status); //Execute
    if($row_status = mysqli_fetch_assoc($result_status)){ //Checks table data
      $query = "DELETE FROM Reviews
                WHERE Reviews.ReviewID = '$reviewID'";
    }
    else{
      $message_status = "Invalid Restaurant ID";
      echo "<script type='text/javascript'>alert('$message_status');</script>";
      echo "<script type='text/javascript'> document.location = 'myReviews.php'; </script>";
    }


	$result = mysqli_query($conn, $query);
  if(!$result){
    die('Could not delete data:');
  }

  echo "<script type='text/javascript'> document.location = 'myReviews.php'; </script>";

	mysqli_free_result($result);
	mysqli_close($conn);

  include_once 'footer.php';


  ?>

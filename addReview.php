<?php
  session_start();
  include_once 'header.php';
// change the value of $dbuser and $dbpass to your email_ID and password
	include 'includes/db-inc.php';

	$conn = mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);
	if (!$conn) {
		die('Could not connect: ' . mysql_error());
	}

  $u_name = $_SESSION['email_ID'];
  $r_name = $_SESSION['r'];
  $reviewText = $_POST['addReview'];

  //echo "<h1>$u_name</h1>";
  //echo "<h1>$r_name</h1>";
  //echo "<h1>$reviewText</h1>";

  $query = "SELECT UserID FROM User WHERE email_ID = '$u_name' ";
  $result1 = mysqli_query($conn, $query);
  if (!$result1) {
    die("Query to show u_id from table failed!");
  }
  while($row = mysqli_fetch_row($result1)) {
    foreach($row as $u_id)
      //echo "</tr>\n";
      if(1>2){} //DONT DELETE
  }

  $querya = "SELECT RestaurantID FROM Restaurant WHERE Name = '$r_name' ";
  $resulta = mysqli_query($conn, $querya);
  if (!$resulta) {
    die("Query to show r_id from table failed");
  }
  while($rowa = mysqli_fetch_row($resulta)) {
    foreach($rowa as $r_id)
      //echo "</tr>\n";
      if(1>2){} //DONT DELETE
  }

  //echo "<h1> $u_id </h1>";
  //echo "<h1> $r_id </h1>";

  $queryb = "INSERT INTO Reviews(ReviewID, rDescription, UserID, RestaurantID)
  VALUES (NULL,'$reviewText','$u_id','$r_id')";
  $resultb = mysqli_query($conn, $queryb);
  if (!$resultb) {
    die("Query to add review failed");
  }

  echo "<script type='text/javascript'> document.location = 'myReviews.php'; </script>";


  include_once 'footer.php';

  ?>

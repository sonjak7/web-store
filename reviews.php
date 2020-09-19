<?php
	include_once 'header.php';
	include_once 'includes/db-inc.php';

    $email_ID = $_SESSION['email_ID'];
    $firstname = $_SESSION['firstname'];

    $query = "SELECT * FROM reviews";
	$result = mysqli_query($conn, $query);
	if (!$result) {
		die("Query to show fields from table failed");
    }
    while($row = mysqli_fetch_object($result)){
        echo $row->firstname;
        echo "<br>";
        echo $row->feedback;
        echo "<br>";
    }
	mysqli_free_result($result);
	mysqli_close($conn);
	include_once 'footer.php';
?>

<form action="includes/reviews-inc.php" method="POST">
    <textarea type="text" name="feedback" placeholder="Add a review..."></textarea>
    <input type="submit" name="submit" value="Add">
</form>

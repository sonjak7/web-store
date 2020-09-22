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
    echo "<table id='reviews_table'><tr>
    <td class='review_heading'><b>Name</b></td>
    <td class='all_reviews'><b>Review</b></td></tr>";

    while($row = mysqli_fetch_object($result)){
        echo "<tr>";
        echo "<td class='review_heading'>$row->firstname</td>";
        echo "<td class='all_reviews'>$row->feedback</td>";
        if($row->email_ID == $email_ID){    // if the logged in user posted the current comment 
            echo "<form action='includes/reviews-inc.php' method='POST'>";
            echo "<td style='background-color:transparent'>";
            echo "<input type='hidden' name='review_deleted' value='$row->id'>";
            echo "<input type='submit' name='delete_review' value='Delete' class='delete_review'>";
            echo "</td></form>";
        }
    }
	mysqli_free_result($result);
	mysqli_close($conn);
	include_once 'footer.php';
?>

<form action="includes/reviews-inc.php" method="POST">
        <textarea type="text" name="feedback" placeholder="Add a review..."></textarea>
        <input type="submit" name="add_review" value="Add" id="add_review">
</form>

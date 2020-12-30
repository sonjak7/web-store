<?php
	include_once 'header.php';
    include_once 'includes/db-inc.php';
    
    if(!(isset($_SESSION['userID']))){
        die('Not logged in');
    }
?>

<form action="includes/reviews-inc.php" method="POST">
        <textarea type="text" name="feedback" placeholder="Add a review..."></textarea>
        <input type="submit" name="add_review" value="Add" id="add_review">
</form>

<?php
    $userID = $_SESSION['userID'];

    $query = "SELECT CONCAT(u.firstname, ' ', u.lastname) AS name, u.userID, r.feedback, r.reviewID FROM Reviews r INNER JOIN Users u ON r.userID = u.userID";
	$result = mysqli_query($conn, $query);
	if (!$result) {
		die("Query to show fields from table failed");
    }
    echo "<table id='reviews_table'><tr>
    <td class='review_heading'><b>Name</b></td>
    <td class='all_reviews'><b>Review</b></td></tr>";

    while($row = mysqli_fetch_object($result)){
        echo "<tr>";
        echo "<td class='review_heading'>$row->name</td>";
        echo "<td class='all_reviews'>$row->feedback</td>";
        if($row->userID == $userID or $_SESSION['isAdmin'] == 1){    // if the logged in user posted the current comment 
            echo "<form action='includes/reviews-inc.php' method='POST'>";
            echo "<td style='background-color:transparent'>";
            echo "<input type='hidden' name='review_deleted' value='$row->reviewID'>";
            echo "<input type='submit' name='delete_review' value='Remove review' class='delete_review'>";
            echo "</td></form>";
        }
        echo "</tr>";
    }
    echo "</table>";
	mysqli_free_result($result);
	mysqli_close($conn);
	include_once 'footer.php';
?>



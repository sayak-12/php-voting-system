<?php
session_start();

// Include dependencies and establish database connection
include '../dependancies.php';
include '../connect.php';

// Query to retrieve data based on $type
$table = "tbl_reviews";
$query = "SELECT tbl_teacher.name AS teacher_name, tbl_reviews.course_code AS subject_name, AVG(tbl_reviews.rating) AS average_rating, COUNT(tbl_reviews.rating) AS num_ratings FROM tbl_reviews JOIN tbl_teacher ON tbl_reviews.rev_to = tbl_teacher.teacher_id GROUP BY tbl_reviews.rev_to, tbl_reviews.course_code;";
$result = mysqli_query($con, $query);

?>

<!DOCTYPE html>
<html>

<head>
    <?php include '../dependancies.php' ?>
    <title>View Ratings</title>
</head>

<body style="position: relative;">
    <?php include '../connect.php'; ?>
        <h2 class="text-left"><a href="index.php" title="Back to Dashboard"><span class="material-symbols-outlined">
            arrow_back
        </span></a>View Ratings</h2>
        <?php
        if ($result) {
            echo "<table class='table table-striped w-100'>";
            // Output table headers
            echo "<thead><tr>";
            echo "<th>Review For</th>"; // Teacher Name
            echo "<th>Course code</th>"; // Rating
            echo "<th>Times rated</th>"; // Teacher Name
            echo "<th>Average Rating</th>"; // Rating
            echo "</tr></thead>";

            // Output table rows
            echo "<tbody>";
            while ($row = mysqli_fetch_assoc($result)) {
                echo "<tr>";
                echo "<td>" . $row['teacher_name'] . "</td>"; // Teacher Name
                echo "<td>" . $row['subject_name'] . "</td>"; // Rating
                echo "<td>" . $row['num_ratings'] . "</td>"; // Rating
                echo "<td>" . $row['average_rating'] . "</td>"; // Rating
                echo "</tr>";
            }
            echo "</tbody></table>";
        } else {
            echo "<p>No data available.</p>";
        }
        ?>
</body>

</html>

<?php
// Close database connection
mysqli_close($con);
?>

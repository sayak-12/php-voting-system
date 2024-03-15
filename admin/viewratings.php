<?php
session_start();

// Include dependencies and establish database connection
include '../dependancies.php';
include '../connect.php';

// Query to retrieve data based on $type
$table = "tbl_reviews";
$query = "SELECT tbl_reviews.rev_id, tbl_student.name AS student_name, tbl_teacher.name AS teacher_name, tbl_reviews.rev_by, tbl_reviews.rev_to, tbl_reviews.rating, tbl_reviews.course_code, tbl_reviews.department, tbl_reviews.section, tbl_reviews.timestamp
          FROM $table 
          JOIN tbl_student ON tbl_reviews.rev_by = tbl_student.Enrollment 
          JOIN tbl_teacher ON tbl_reviews.rev_to = tbl_teacher.teacher_id";
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
            echo "<th>Rev ID</th>"; // Rev ID
            echo "<th>Review By</th>"; // Student Name
            echo "<th>Review For</th>"; // Teacher Name
            echo "<th>Rating</th>"; // Rating
            echo "<th>Course code</th>"; // Rating
            echo "<th>department</th>"; // Rating
            echo "<th>section</th>"; // Rating
            echo "<th>timestamp</th>"; // Rating
            echo "</tr></thead>";

            // Output table rows
            echo "<tbody>";
            while ($row = mysqli_fetch_assoc($result)) {
                echo "<tr>";
                echo "<td>" . $row['rev_id'] . "</td>"; // Rev ID
                echo "<td>" . $row['student_name'] . "</td>"; // Student Name
                echo "<td>" . $row['teacher_name'] . "</td>"; // Teacher Name
                echo "<td>" . $row['rating'] . "</td>"; // Rating
                echo "<td>" . $row['course_code'] . "</td>"; // Rating
                echo "<td>" . $row['department'] . "</td>"; // Rating
                echo "<td>" . $row['section'] . "</td>"; // Rating
                echo "<td>" . $row['timestamp'] . "</td>"; // Rating
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

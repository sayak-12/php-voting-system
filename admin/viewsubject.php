<?php
session_start();

// Include dependencies and establish database connection
include '../dependancies.php';
include '../connect.php';

// Query to retrieve data based on $type
$table = "tbl_subject";
$query = "SELECT * FROM $table";
$result = mysqli_query($con, $query);

?>

<!DOCTYPE html>
<html>

<head>
    <?php include '../dependancies.php' ?>
    <title>View Subject Info</title>
</head>

<body style="position: relative;">
    <?php include '../connect.php'; ?>
        <h2 class="text-left"><a href="index.php" title="Back to Dashboard"><span class="material-symbols-outlined">
            arrow_back
        </span></a>View Subject Info</h2>
        <?php
        if (mysqli_num_rows($result) > 0) {
            echo "<table class='table table-striped w-100'>";
            // Output table headers
            echo "<thead><tr>";
            while ($field = mysqli_fetch_field($result)) {
                echo "<th>" . ucfirst($field->name) . "</th>";
            }
            echo "</tr></thead>";

            // Output table rows
            echo "<tbody>";
            while ($row = mysqli_fetch_assoc($result)) {
                echo "<tr>";
                foreach ($row as $key => $value) {
                    echo "<td>" . $value . "</td>";
                }
                // Adding Edit and Delete links
                $idField = "course_code";
                echo "<td><a href='editsubject.php?id=" . $row[$idField] . "'>Edit</a></td>";
                echo "<td><a href='deletesubject.php?id=" . $row[$idField] . "'>Delete</a></td>";
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

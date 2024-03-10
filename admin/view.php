<?php
session_start();

if (isset($_GET["type"]) && ($_GET["type"] == "student" || $_GET["type"] == "teacher")) {
    $type = $_GET["type"];
} else {
    header("location:index.php");
    exit(); // Ensure script stops executing after redirection
}

// Include dependencies and establish database connection
include '../dependancies.php';
include '../connect.php';

// Query to retrieve data based on $type
$table = ($type == "student") ? "tbl_student" : "tbl_teacher";
$query = "SELECT * FROM $table";
$result = mysqli_query($con, $query);

?>

<!DOCTYPE html>
<html>

<head>
    <?php include '../dependancies.php' ?>
    <title>View <?php echo ucfirst($type); ?>s' Data</title>
</head>

<body>
    <?php include '../connect.php'; ?>
        <h2 class="text-left"><a href="index.php" title="Back to Dashboard"><span class="material-symbols-outlined">
            arrow_back
        </span></a>View <?php echo ucfirst($type); ?>s' Data</h2>
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
                $idField = ($type == "student") ? "Enrollment" : "teacher_id";
                echo "<td><a href='edit.php?id=" . $row[$idField] . "&type=" . $type . "'>Edit</a></td>";
                echo "<td><a href='delete.php?id=" . $row[$idField] . "&type=" . $type . "'>Delete</a></td>";
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

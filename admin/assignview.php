<?php
session_start();

// Include dependencies and establish database connection
include '../dependancies.php';
include '../connect.php';

// Query to retrieve data based on $type
$table = "tbl_teacher_assignment";
$query = "SELECT tbl_teacher_assignment.*, tbl_teacher.name as teacher_name 
          FROM $table 
          JOIN tbl_teacher ON tbl_teacher_assignment.assigned_to = tbl_teacher.teacher_id";
$result = mysqli_query($con, $query);

?>

<!DOCTYPE html>
<html>

<head>
    <?php include '../dependancies.php' ?>
    <title>View Subject Assignment Info</title>
    <style>
        tr{
            text-align: center;
        }
    </style>
</head>

<body style="position: relative; padding: 20px;">
    <?php include '../connect.php'; ?>
        <h2 class="text-left mb-3"><a href="index.php" title="Back to Dashboard"><span class="material-symbols-outlined">
            arrow_back
        </span></a>&nbsp;&nbsp;View Subject Assignment Info</h2>
        <?php
        if (mysqli_num_rows($result) > 0) {
            echo "<table class='table table-striped w-100' style='border:1px solid black;'>";
            // Output table headers
            echo "<thead><tr>";
            $fields = mysqli_fetch_fields($result);
            foreach ($fields as $field) {
                if ($field->name != "assigned_to") { // Skip displaying teacher_id
                    echo "<th>" . ucfirst($field->name) . "</th>";
                }
            }
            echo "<th>Action</th>"; // Add Action column header
            echo "</tr></thead>";

            // Output table rows
            echo "<tbody>";
            while ($row = mysqli_fetch_assoc($result)) {
                echo "<tr>";
                foreach ($row as $key => $value) {
                    if ($key != "assigned_to") { // Skip displaying teacher_id
                        echo "<td>" . $value . "</td>";
                    }
                }
                // Adding Edit and Delete links
                echo "<td><a href='deleteassignment.php?id=" . $row['id'] . "'><span class='material-symbols-outlined text-danger'>
                delete
                </span></a></td>";
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

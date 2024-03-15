<?php
session_start();

// Include dependencies and establish database connection
include '../dependancies.php';
include '../connect.php';

if(isset($_GET['id'])) {
    $id = $_GET['id'];

    $query = "DELETE FROM tbl_teacher_assignment WHERE id = $id";
    $result = mysqli_query($con, $query);

    if ($result) {
        echo "<script>alert('Assignment deleted successfully.');</script>";
    } else {
        echo "<script>alert('Error: " . mysqli_error($con) . "');</script>";
    }
} else {
    echo "<script>alert('No id parameter');</script>";
    echo "<script>window.location.href = 'assignview.php';</script>";
}

echo "<script>window.location.href = 'assignview.php';</script>";

// Close database connection
mysqli_close($con);
?>

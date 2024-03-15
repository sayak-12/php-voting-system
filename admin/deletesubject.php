<?php
session_start();
include '../connect.php';
if (isset($_GET["id"])) {
    $id = $_GET["id"];
} else {
    header("location:index.php");
    exit();
}

    $dqr = "DELETE FROM `tbl_subject` WHERE `course_code`='$id'";
    $res = mysqli_query($con, $dqr);
    if ($res) {
        echo "<script>alert('Successfully deleted!')</script>";
        echo "<script>window.location.href = 'viewsubject.php';</script>";
    }
    else{
        echo "<script>alert('Something went wrong!')</script>";
        echo "<script>window.location.href = 'viewsubject.php';</script>";
    }
?>
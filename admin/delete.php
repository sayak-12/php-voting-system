<?php
session_start();
include '../connect.php';
if (isset($_GET["type"]) && isset($_GET["id"])) {
    $type = $_GET["type"];
    $id = $_GET["id"];
} else {
    header("location:index.php");
    exit();
}

if ($type == "student") {
    $dqr = "DELETE FROM `tbl_student` WHERE Enrollment = $id";
    $res = mysqli_query($con, $dqr);
    if ($res) {
        echo "<script>alert('Successfully deleted!')</script>";
        echo "<script>window.location.href = 'view.php?type=$type';</script>";
    }
}
else if ($type == "teacher"){
    $dqr = "DELETE FROM `tbl_teacher` WHERE teacher_id = $id";
    $res = mysqli_query($con, $dqr);
    if ($res) {
        echo "<script>alert('Successfully deleted!')</script>";
        echo "<script>window.location.href = 'view.php?type=$type';</script>";
    }
}
else{
    echo "<script>alert('Invalid Type!')</script>";
    echo "<script>window.location.href = 'view.php?type=$type';</script>";
}
?>
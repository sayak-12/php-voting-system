<?php 
session_start();
include "../connect.php";

if (isset($_COOKIE['student_token'])) {
    $email = $_COOKIE['student_token'];
    $loginquery = "SELECT * FROM `tbl_student` WHERE Enrollment='$email'";
    $result = mysqli_query($con, $loginquery);
    $emailcount = mysqli_num_rows($result);
    if ($emailcount) {
        $db = mysqli_fetch_array($result);
        $_SESSION['firstname'] = $db['name'];
    } 
    else {
        setcookie('student_token', '', time() - 3600, '/');
        header('location:login.php');
    }
} else {
    header('location:login.php');
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <?php include "../dependancies.php"; ?>
    <title>Student Dashboard</title>
</head>
<body>
    <h1>Welcome, <?php echo $_SESSION['firstname'];?></h1>
    <h3>Your attendance is <?= $db["Attendance"] ?>%</h3>
    <?php

    if ($db["Attendance"] >= 75) {
        $department = $db['Department'];
        $section = $db['Section'];
        $subject_query = "SELECT course_code FROM tbl_teacher_assignment WHERE department = '$department' AND section = '$section'";
        $subject_result = mysqli_query($con, $subject_query);
    ?>
        <select name="subject" id="subject">
            <?php 
            while ($subject_row = mysqli_fetch_array($subject_result)) {
                echo "<option value='" . $subject_row['course_code'] . "'>" . $subject_row['course_code'] . "</option>";
            }
            ?>
        </select>
        <a id="goButton" href="#" class="btn btn-primary" disabled>Go</a>
    <?php
    } else {
    ?>
        <h1 class="h2 text-danger">You're Not Eligible For Teacher Remarks Because of low attendance!</h1>
    <?php
    }
    ?>
    
    <a href="logout.php"><button class="btn btn-danger">Log Out</button></a>
    <script>
        const changehandler = () => {
            const subjectSelect = document.getElementById('subject');
            const goButton = document.getElementById('goButton');
            const selectedSubject = subjectSelect.value;
            if (selectedSubject) {
                goButton.disabled = false;
                goButton.href = `rating.php?subject=${selectedSubject}`;
            } else {
                goButton.disabled = true;
                goButton.href = '#';
            }
        };

        // Add event listener for change event on subject select
        document.getElementById('subject').addEventListener('change', changehandler);
        
        // Call the changehandler initially to set initial state
        changehandler();
    </script>
</body>
</html>

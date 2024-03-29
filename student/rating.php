<?php
session_start();
include "../connect.php";

if (isset($_COOKIE['student_token']) && isset($_GET['subject'])) {
    $email = $_COOKIE['student_token'];
    $subject = $_GET['subject'];
    $loginquery = "SELECT * FROM `tbl_student` WHERE Enrollment='$email'";
    $result = mysqli_query($con, $loginquery);
    $emailcount = mysqli_num_rows($result);

    if ($emailcount) {
        $db = mysqli_fetch_array($result);
        $_SESSION['firstname'] = $db['name'];
    }
} else {
    header('location:login.php');
}
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $teacher_id = $_POST['teacher_id'];
    $rating = $_POST['rating'];
    $rev_by = $_POST['rev_by'];
    $course_code = $_POST['course_code'];
    $department = $_POST['department'];
    $section = $_POST['section'];
    $insert_query = "INSERT INTO `tbl_reviews`( `rev_by`, `rating`, `rev_to`, `course_code`, `department`, `section`) VALUES ('$rev_by','$rating','$teacher_id','$course_code','$department','$section')";
    mysqli_query($con, $insert_query);
    header('Location: ' . $_SERVER['PHP_SELF'] ."?subject=$course_code");
    exit;
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <?php include "../dependancies.php"; ?>
    <title>Rate <?= $subject ?> Teachers</title>
</head>

<body>
    <a href="index.php"><h3 class="text-left" title="Back to dashboard"><span class="material-symbols-outlined">
arrow_back
</span></h3></a>
    <h1>Welcome, <?php echo $_SESSION['firstname']; ?></h1>
    <h3>Your attendance is <?= $db["Attendance"] ?>%</h3>
    <?php

    if ($db["Attendance"] >= 75) {
        $department = $db['Department'];
        $section = $db['Section'];
        $semester = $db['semester'];
        $subject_query = "SELECT assigned_to, department, semester, section FROM tbl_teacher_assignment WHERE department = '$department' AND section = '$section' AND semester='$semester' AND course_code = '$subject'";
        $subject_result = mysqli_query($con, $subject_query);
    ?>
        <table class="table table-striped">
            <tr>
                <th>Teacher name</th>
                <th>Course Code</th>
                <th>Course name</th>
                <th>Department</th>
                <th>Semester</th>
                <th>Section</th>
                <th>Stars</th>
                <th>Submit</th>
            </tr>
            <?php
            while ($subject_row = mysqli_fetch_array($subject_result)) {
                $marquee = "select name from tbl_teacher where teacher_id = " . $subject_row["assigned_to"] . "";
                $subres = mysqli_fetch_array(mysqli_query($con, $marquee));
                $marquee2 = "select course_name from tbl_subject where course_code = '$subject'";
                $subres2 = mysqli_fetch_array(mysqli_query($con, $marquee2));
            ?>
                <form method='post' action='<?php echo $_SERVER['PHP_SELF']; ?>'>
                    <tr>
                    <input type="hidden" name="teacher_id" value="<?php echo $subject_row["assigned_to"]; ?>">
    <input type="hidden" name="rev_by" value="<?php echo $email; ?>">
    <input type="hidden" name="course_code" value="<?php echo $subject; ?>">
    <input type="hidden" name="department" value="<?php echo $department; ?>">
    <input type="hidden" name="section" value="<?php echo $section; ?>">
                        <td><?=$subres["name"]?></td>
                        <td><?=$subject?></td>
                        <td><?=$subres2["course_name"]?></td>
                        <td><?= $department ?></td>
                        <td><?=$semester?></td>
                        <td><?=$section?></td>
                        <td>
                            <select name="rating" id="">
                                <option value="">select value</option>
                                <option value="1">1</option>
                                <option value="2">2</option>
                                <option value="3">3</option>
                                <option value="4">4</option>
                                <option value="5">5</option>
                            </select>
                        </td>
                        <td>
                        <?php 
                            // Check if the review already exists for this student and teacher
                            $check_query = "SELECT * FROM tbl_reviews WHERE rev_by = '".$email."' AND rev_to = '".$subject_row["assigned_to"]."' AND department = '".$department."' and section = '".$section."' and course_code = '$subject'";
                            $check_result = mysqli_query($con, $check_query);
                            $existing_review_count = mysqli_num_rows($check_result);
                            if ($existing_review_count == 0) {
                                echo '<button type="submit" class="btn btn-primary">Submit Review</button>';
                            } else {
                                echo '<button type="button" class="btn btn-success" disabled>Review Submitted</button>';
                            }
                            ?>
                        </td>
                    </tr>
                </form>
            <?php

            }
            ?>
        </table>
    <?php
    } else {
    ?>
        <h1 class="h2 text-danger">You're Not Eligible For Teacher Remarks Because of low attendance!</h1>
    <?php
    }
    ?>

    <a href="logout.php"><button class="btn btn-danger">Log Out</button></a>

</body>

</html>
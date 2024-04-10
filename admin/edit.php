<?php
session_start();

if (isset($_GET["type"]) && isset($_GET["id"])) {
    $type = $_GET["type"];
    $id = $_GET["id"];
} else {
    header("location:index.php");
}
?>
<!DOCTYPE html>
<html>

<head>
    <?php include '../dependancies.php' ?>
    <title>Edit <?php echo $type; ?> Data</title>
</head>

<body>
    <?php include '../connect.php';
    if ($type == "student") {
        $qr = "select * from tbl_student where Enrollment = $id";
        $result = mysqli_query($con, $qr);
        $results = mysqli_fetch_array($result);
    }
    else if ($type == "teacher"){
        $qr = "select * from tbl_teacher where teacher_id = $id";
        $result = mysqli_query($con, $qr);
        $results = mysqli_fetch_array($result);
    }
    ?>
    <div>
    </div>
    <div class="container">
        <h2 class="text-left"><a href="view.php?type=<?= $type ?>" title="back to dashboard"><span class="material-symbols-outlined">
                    arrow_back
                </span></a> </h2>
        <h2 class="mb-4">Update <?php echo $type; ?> Information</h2>
        <form method="post">
            <div class="form-group mt-2">
                <label for="firstname">Full name</label>
                <input required type="text" class="form-control" id="exampleInputfirstname" name="firstname" value="<?= $results['name'] ?>">
            </div>
            <?php if ($type == "student") {
            ?>
                <div class="form-group mt-2">
                    <label for="Department">Department</label>
                    <select class="form-control" name="department">
                        <option value="CSE" <?php if($results['Department'] == 'CSE') echo 'selected'; ?>>CSE</option>
                        <option value="CSE IOT" <?php if($results['Department'] == 'CSE IOT') echo 'selected'; ?>>CSE IoT</option>
                        <option value="CSIT" <?php if($results['Department'] == 'CSIT') echo 'selected'; ?>>CSIT</option>
                        <option value="CSE AIML" <?php if($results['Department'] == 'CSE AIML') echo 'selected'; ?>>CSE AI/ML</option>
                        <option value="MECHANICAL" <?php if($results['Department'] == 'MECHANICAL') echo 'selected'; ?>>Mechanical</option>
                    </select>
                </div>
                <div class="form-group mt-2">
                    <label for="section">Section</label>
                    <input required type="text" class="form-control" id="exampleInputsection" aria-describedby="emailHelp" name="section" value="<?= $results['Section'] ?>">
                </div>
                <div class="form-group mt-2">
                    <label for="phoneno">Phone Number</label>
                    <input required type="text" class="form-control" id="exampleInputphoneno" name="phoneno" value="<?= $results['Phone'] ?>">
                </div>
                <div class="form-group mt-2">
                    <label for="attendance">Attendance</label>
                    <input required type="text" class="form-control" id="exampleInputattendance" name="attendance" value="<?= $results['Attendance'] ?>">
                </div>
                <div class="form-group mt-2">
                    <label for="semester">Semester</label>
                    <input required type="text" class="form-control" id="exampleInputsemester" name="semester" value="<?= $results['semester'] ?>">
                </div>
            <?php
            } ?>
            <?php if ($type == "teacher") {
            ?>

                <div class="form-group mt-2">
                    <label for="email">Email: </label>
                    <input required type="email" class="form-control" id="exampleInputlastname" name="email" value="<?= $results['email'] ?>">
                </div>
            <?php
            } ?>
            <button type="submit" class="btn btn-primary w-100 my-3" name="create">Update <?php echo $type; ?></button>
        </form>
    </div>
    <?php

    if (isset($_POST['create'])) {
        if ($type == "student") {
            $firstname = $_POST['firstname'];
            $department = $_POST['department'];
            $attendance = $_POST['attendance'];
            $phone = $_POST['phoneno'];
            $section = $_POST['section'];
            $semester = $_POST['semester'];

            $qr2 = "UPDATE `tbl_student` SET `name`='$firstname',`Phone`='$phone',`Department`='$department',`Attendance`='$attendance', `Section`='$section', `semester`='$semester' WHERE Enrollment = $id";
            $iquery = mysqli_query($con, $qr2);
            if ($iquery) {
                echo "<script>alert('Updation Successful...')</script>";
            echo "<script>window.location.href = 'edit.php?type=$type&id=$id';</script>";
            }
            else{
                echo "<script>alert('Some Error Occurred')</script>";
            }
        } else if ($type == "teacher") {
            $firstname = $_POST['firstname'];
            $email = $_POST['email'];


            $qr2 = "UPDATE `tbl_teacher` SET `name`='$firstname',`email`='$email' WHERE teacher_id = $id";
            $iquery = mysqli_query($con, $qr2);
            if ($iquery) {
                echo "<script>alert('Updation Successful...')</script>";
            echo "<script>window.location.href = 'edit.php?type=$type&id=$id';</script>";
            }
            else{
                echo "<script>alert('Some Error Occurred')</script>";
            }
        }
    }

    ?>
</body>

</html>

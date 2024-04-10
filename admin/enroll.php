<?php
session_start();

if (isset($_GET["type"])) {
    $type = $_GET["type"];
} else {
    header("location:index.php");
    exit();
}
?>
<!DOCTYPE html>
<html>

<head>
    <?php include '../dependancies.php' ?>
    <title>Enroll new <?php echo $type; ?></title>
</head>

<body>
    <?php include '../connect.php'; ?>
    <div>
    </div>
    <div class="container">
        <h2 class="text-left"><a href="index.php" title="back to dashboard"><span class="material-symbols-outlined">
                    arrow_back
                </span></a> </h2>
        <h2 class="mb-4">Enroll new <?php echo $type; ?></h2>
        <form method="post">
            <div class="form-group mt-2">
                <label for="firstname">Full name</label>
                <input required type="text" class="form-control" id="exampleInputfirstname" name="firstname" value="<?php echo isset($_POST['firstname']) ? htmlspecialchars($_POST['firstname']) : ''; ?>">
            </div>
            <?php if ($type == "student") {
            ?>

                <div class="form-group mt-2">
                    <label for="enrollment">Enrollment number</label>
                    <input required type="text" class="form-control" id="exampleInputlastname" name="enrollment" value="<?php echo isset($_POST['enrollment']) ? htmlspecialchars($_POST['enrollment']) : ''; ?>">
                </div>
                <div class="form-group mt-2">
                    <label for="Department">Department</label>
                    <select class="form-control" name="department">
                        <option value="CSE">CSE</option>
                        <option value="CSE IOT">CSE IoT</option>
                        <option value="CSIT">CSIT</option>
                        <option value="CSE AIML">CSE AI/ML</option>
                        <option value="MECHANICAL">Mechanical</option>
                    </select>
                </div>
                <div class="form-group mt-2">
                    <label for="phoneno">Phone Number</label>
                    <input required type="text" class="form-control" id="exampleInputphoneno" name="phoneno" value="<?php echo isset($_POST['phoneno']) ? htmlspecialchars($_POST['phoneno']) : ''; ?>">
                </div>
                <div class="form-group mt-2">
                    <label for="attendance">Attendance</label>
                    <input required type="text" class="form-control" id="exampleInputattendance" name="attendance" value="<?php echo isset($_POST['attendance']) ? htmlspecialchars($_POST['attendance']) : ''; ?>">
                </div>
                <div class="form-group mt-2">
                    <label for="semester">Semester</label>
                    <input required type="text" class="form-control" id="exampleInputsemester" name="semester">
                </div>
                <div class="form-group mt-2">
                    <label for="section">Section</label>
                    <input required type="text" class="form-control" id="exampleInputsection" name="section">
                </div>
                <div class="form-group mt-2">
                <label for="password">Password</label>
                <input required type="password" class="form-control" id="exampleInputPassword" name="password">
            </div>
            <div class="form-group mt-2">
                <label for="cPassword">Confirm Password</label>
                <input required type="password" class="form-control" id="cexampleInputPassword" name="cpassword">
            </div>
            <?php
            }?>
            <?php if ($type == "teacher"){
            ?>
                <div class="form-group mt-2">
                    <label for="email">Email: </label>
                    <input required type="email" class="form-control" id="exampleInputlastname" name="email">
                </div>
            <?php
            } ?>
           
            <button type="submit" class="btn btn-primary w-100 my-3" name="create">Enroll <?php echo $type; ?></button>
            <?php if ($type == "student") {
            ?>
                <p>Enroll teachers here: <a href="enroll.php?type=teacher">New Teachers</a></p>
            <?php
            }?>
            <?php if ($type == "teacher") {
            ?>
                <p>Enroll students here: <a href="enroll.php?type=student">New Students</a></p>
            <?php
            }?>
        </form>
    </div>
    <?php

    if (isset($_POST['create'])) {
        if ($type == "student") {
            $firstname = $_POST['firstname'];
            $enrollment = $_POST['enrollment'];
            $department = $_POST['department'];
            $attendance = $_POST['attendance'];
            $phone = $_POST['phoneno'];
            $section = $_POST['section'];
            $semester = $_POST['semester'];
            $password = $_POST['password'];
            $confirm = $_POST['cpassword'];

            $check = "SELECT * FROM `tbl_student` WHERE Enrollment = '$enrollment'";
            $qr = mysqli_query($con, $check);
            $rows = mysqli_num_rows($qr);

            if (!($rows > 0)) {
                if (($password === $confirm)) {
                    $qr2 = "INSERT INTO `tbl_student`(`Enrollment`, `name`, `Phone`, `Department`, `Section`, `Password`, `Attendance`, `semester`) VALUES ('$enrollment','$firstname','$phone','$department','$section','$password','$attendance','$semester')";
                    $iquery = mysqli_query($con, $qr2);
                    if ($iquery) {
                        echo "<script>alert('Registration Successful...')</script>";
                        echo "<script>window.location.href = 'enroll.php?type=$type';</script>";
                    } else {
                        echo "<script>alert('Some error occured')</script>";
                    }
                } else {
                    echo "<script>alert('Password and confirm password must be same')</script>";
                }
            } else {
                echo "<script>alert('Enrollment number already exists')</script>";
            }
        } else if ($type == "teacher") {
            $firstname = $_POST['firstname'];
            $email = $_POST['email'];

            $check = "SELECT * FROM `tbl_teacher` WHERE email = '$email'";
            $qr = mysqli_query($con, $check);
            $rows = mysqli_num_rows($qr);

            if (!($rows > 0)) {
                    $qr2 = "INSERT INTO `tbl_teacher`(`name`, `email`) VALUES ('$firstname','$email')";
                    $iquery = mysqli_query($con, $qr2);
                    if ($iquery) {
                        echo "<script>alert('Registration Successful...')</script>";
                        echo "<script>window.location.href = 'enroll.php?type=$type';</script>";
                    } else {
                        echo "<script>alert('Some error occured')</script>";
                    }
                
            } else {
                echo "<script>alert('email already exists')</script>";
            }
            echo "<script>window.location.href = 'enroll.php?type=$type';</script>";
            exit();
        }
    }

    ?>
</body>

</html>
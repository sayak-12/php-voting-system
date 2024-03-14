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
    $results = mysqli_query($con, $qr);
    }
    ?>
    <div>
    </div>
    <div class="container">
    <h2 class="text-left"><a href="index.php" title="back to dashboard"><span class="material-symbols-outlined">
arrow_back
</span></a> </h2>
        <h2 class="mb-4">Enroll new <?php echo $type; ?></h2>
        <?php
        if (isset($_SESSION['error'])) {
            echo "<p class='text-danger'>" . $_SESSION['error'] . "</p>";
            unset($_SESSION['error']);
        }
        if (isset($_SESSION['msg'])) {
            echo "<p class='text-success'>" . $_SESSION['msg'] . "</p>";
            unset($_SESSION['msg']);
        }
        ?>
        <form method="post" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>">
            <div class="form-group mt-2">
                <label for="firstname">Full Name</label>
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
                    <input required type="text" class="form-control" id="exampleInputdepartment1" aria-describedby="emailHelp" name="department" value="<?php echo isset($_POST['department']) ? htmlspecialchars($_POST['department']) : ''; ?>">
                </div>
                <div class="form-group mt-2">
                    <label for="phoneno">Phone Number</label>
                    <input required type="text" class="form-control" id="exampleInputphoneno" name="phoneno" value="<?php echo isset($_POST['phoneno']) ? htmlspecialchars($_POST['phoneno']) : ''; ?>">
                </div>
                <div class="form-group mt-2">
                    <label for="attendance">Attendance</label>
                    <input required type="text" class="form-control" id="exampleInputattendance" name="attendance" value="<?php echo isset($_POST['attendance']) ? htmlspecialchars($_POST['attendance']) : ''; ?>">
                </div>
            <?php
            } ?>
            <?php if ($type == "teacher") {
            ?>

                <div class="form-group mt-2">
                    <label for="email">Email: </label>
                    <input required type="email" class="form-control" id="exampleInputlastname" name="email" value="<?php echo isset($_POST['email']) ? htmlspecialchars($_POST['email']) : ''; ?>">
                </div>
            <?php
            } ?>
            <div class="form-group mt-2">
                <label for="password">Password</label>
                <input required type="password" class="form-control" id="exampleInputPassword" name="password">
            </div>
            <div class="form-group mt-2">
                <label for="cPassword">Confirm Password</label>
                <input required type="password" class="form-control" id="cexampleInputPassword" name="cpassword">
            </div>
            <button type="submit" class="btn btn-primary w-100 my-3" name="create">Enroll <?php echo $type; ?></button>
            <?php if ($type=="student") {
                ?>
                <p>Enroll teachers here: <a href="enroll.php?type=teacher">New Teachers</a></p>
                <?php
            } ?>
            <?php if ($type=="teacher") {
                ?>
                <p>Enroll students here: <a href="enroll.php?type=student">New Students</a></p>
                <?php
            } ?>
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
            $password = $_POST['password'];
            $confirm = $_POST['cpassword'];
    
            $check = "SELECT * FROM `tbl_student` WHERE Enrollment = '$enrollment'";
            $qr = mysqli_query($con, $check);
            $rows = mysqli_num_rows($qr);
            $hashed_pass = password_hash($password, PASSWORD_BCRYPT);
            $token = bin2hex(random_bytes(15));
    
            if (!($rows > 0)) {
                if (($password === $confirm)) {
                    $qr2 = "INSERT INTO `tbl_student`(`Enrollment`, `Name`, `Phone`, `Department`, `Password`, `Attendance`) VALUES ('$enrollment','$firstname','$phone','$department','$hashed_pass','$attendance')";
                    $iquery = mysqli_query($con, $qr2);
                    $_SESSION['msg'] = "Registration successful...";
                } else {
                    $_SESSION['error'] = "Passwords do not match";
                }
            } else {
                $_SESSION['error'] = "Enrollment Number already exists";
            }
            header("location: enroll.php?type=$type");
            exit(); 
        }
    else if($type=="teacher"){
        $firstname = $_POST['firstname'];
        $email = $_POST['email'];
        $password = $_POST['password'];
        $confirm = $_POST['cpassword'];

        $check = "SELECT * FROM `tbl_teacher` WHERE email = '$email'";
        $qr = mysqli_query($con, $check);
        $rows = mysqli_num_rows($qr);
        $hashed_pass = password_hash($password, PASSWORD_BCRYPT);
        $token = bin2hex(random_bytes(15));

        if (!($rows > 0)) {
            if (($password === $confirm)) {
                $qr2 = "INSERT INTO `tbl_teacher`(`name`, `email`, `password`, `rating_one`, `rating_two`, `rating_three`, `rating_four`) VALUES ('$firstname','$email','$hashed_pass','0','0','0','0')";
                $iquery = mysqli_query($con, $qr2);
                $_SESSION['msg'] = "Registration successful...";
            } else {
                $_SESSION['error'] = "Passwords do not match";
            }
        } else {
            $_SESSION['error'] = "Enrollment Number already exists";
        }
        header("location: enroll.php?type=$type");
        exit(); 
    }
    }

    ?>
</body>

</html>
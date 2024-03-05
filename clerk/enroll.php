<?php
session_start();

if (isset($_GET["type"])) {
    $type = $_GET["type"];
} else {
    header("location:dashboard.php");
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
        <h2>Enroll new <?php echo $type; ?></h2>
        <?php
        if (isset($_SESSION['error'])) {
            echo "<p class='text-danger'>" . $_SESSION['error'] . "</p>";
            unset($_SESSION['error']);
        }
        ?>
        <form method="post">
            <div class="form-group mt-2">
                <label for="firstname">Full Name</label>
                <input required type="text" class="form-control" id="exampleInputfirstname" name="firstname" value="<?php echo isset($_POST['firstname']) ? htmlspecialchars($_POST['firstname']) : ''; ?>">
            </div>
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

            <div class="form-group mt-2">
                <label for="password">Password</label>
                <input required type="password" class="form-control" id="exampleInputPassword" name="password">
            </div>
            <div class="form-group mt-2">
                <label for="cPassword">Confirm Password</label>
                <input required type="password" class="form-control" id="cexampleInputPassword" name="cpassword">
            </div>
            <button type="submit" class="btn btn-primary w-100 mt-3" name="create">Enroll <?php echo $type; ?></button>
        </form>
    </div>
    <?php

    if (isset($_POST['create'])) {
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

    ?>
</body>

</html>

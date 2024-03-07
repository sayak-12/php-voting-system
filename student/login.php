<?php
session_start();
include '../connect.php';
if (isset($_COOKIE['student_token'])) {
    header('location:dashboard.php');
}
?>
<!DOCTYPE html>
<html>

<head>
    <?php include '../dependancies.php' ?>
    <title>Log in to your account</title>
</head>

<body>
    <div>
    </div>
    <div class="container">
        <h2>Log in Now</h2>
        <form method="post">

            <div class="form-group">
                <label for="Email1">Enrollment Number: </label>
                <input required type="number" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" name="email">
            </div>

            <div class="form-group mb-3">
                <label for="Password">Password: </label>
                <input required type="password" class="form-control" id="exampleInputPassword" name="password">
            </div>
            <button type="submit" class="btn btn-primary w-100" name="login">Log in</button>
        </form><br>
        <?php
        if (isset($_POST['login'])) {
            $enrollment = $_POST['email'];
            $password = $_POST['password'];

            $loginquery = "SELECT * FROM `tbl_student` WHERE Enrollment='$enrollment'";
            $result = mysqli_query($con, $loginquery);
            $emailcount = mysqli_num_rows($result);

            if ($emailcount) {
                $db = mysqli_fetch_array($result);
                $dbpass = $db['Password'];
                if ($password = $dbpass) {
                    setcookie('student_token', $enrollment, time() + (30 * 24 * 60 * 60), '/');
                    echo "Login Successful";
                    header("location: dashboard.php");
                } else {
                    echo "Wrong Password";
                }
            } else {
                echo "Enrollment Does not exist";
            }
        }

        ?>
    </div>
</body>

</html>
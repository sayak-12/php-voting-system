<?php
session_start();
include '../connect.php';
if (isset($_GET['type'])) {
    $type = $_GET['type'];

} else {
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

    <div class="container">
        <h2>Reset the Password</h2>
        <form method="post">
            <div class="alert alert-info alert-dismissible fade show" role="alert">
                Enter and confirm your new password to proceed.<br>
                <b>Enter your New Password.</b>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
            <?php if ($type == "student") { ?>
                <div class="form-group">
                <label for="enrollment">Enter Enrollment Number: </label>
                <input required type="number" class="form-control" id="exampleInputpw1" aria-describedby="emailHelp"
                    name="enrollment">
            </div>
            <?php
            }?>
            <?php if ($type == "teacher") { ?>
                <div class="form-group">
                <label for="email">Enter Teacher Email: </label>
                <input required type="email" class="form-control" id="exampleInputpw1" aria-describedby="emailHelp"
                    name="email">
            </div>
            <?php
            }?>
            
            <div class="form-group">
                <label for="Email1">New Password</label>
                <input required type="password" class="form-control" id="exampleInputpw1" aria-describedby="emailHelp"
                    name="password">
            </div>
            <div class="form-group">
                <label for="Email1">Confirm New Password</label>
                <input required type="password" class="form-control" id="exampleInputpw2" aria-describedby="emailHelp"
                    name="cpassword">
            </div>
            <button type="submit" class="btn btn-primary w-100" name="login">Reset Password</button>
        </form><br>


        <?php
        if (isset($_POST['login'])) {
            $password = $_POST['password'];
            $cpassword = $_POST['cpassword'];
            $hashed_pass = password_hash($password, PASSWORD_BCRYPT);
            if ($password === $cpassword) {
                if ($type == "student") {
                    $resetq = "UPDATE `userdtls` SET `password`='$hashed_pass' WHERE token = '$token'";
                $result = mysqli_query($con, $resetq);
                if ($result) {
                    $_SESSION['msg'] = "Your password has been reset successfully. Please login.";
                    echo "<script>alert('Password Reset Successfully!')</script>";
                    $sqla = "SELECT * FROM `userdtls` WHERE token = '$token'";
                    $resulta = mysqli_query($con, $sqla);
                    $arr = mysqli_fetch_array($resulta);
                    $emailqq = $arr['email'];
                    echo "<script>
                              setTimeout(function() {
                                  window.location.href = 'login.php?inemail=' + '$emailqq';
                              }, 2000); 
                          </script>";
                }else{
                    echo mysqli_error($con);
                }
                }
                
                
            } else {
                echo '<script>alert("Passwords do not match")</script>';
            }
        }
        

        ?>
    </div>
</body>

</html>
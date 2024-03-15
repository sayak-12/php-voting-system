<?php
session_start();
?>
<!DOCTYPE html>
<html>

<head>
    <?php include '../dependancies.php' ?>
    <title>Add new Subject</title>
</head>

<body>
    <?php include '../connect.php'; ?>
    <div>
    </div>
    <div class="container">
        <h2 class="text-left"><a href="index.php" title="back to dashboard"><span class="material-symbols-outlined">
                    arrow_back
                </span></a> </h2>
        <h2 class="mb-4">Add new Subject</h2>
        <form method="post">
            <div class="form-group mt-2">
                <label for="firstname">New Subject Name</label>
                <input required type="text" class="form-control" id="exampleInputfirstname" name="firstname">
            </div>
            <div class="form-group mt-2">
                <label for="code">New Course Code</label>
                <input required type="text" class="form-control" id="exampleInputcode" name="code">
            </div>
            
            
           
            <button type="submit" class="btn btn-primary w-100 my-3" name="create">Add Subject</button>
        </form>
    </div>
    <?php

    if (isset($_POST['create'])) {
        
            $firstname = $_POST['firstname'];
            $code = $_POST['code'];

            $check = "SELECT * FROM `tbl_subject` WHERE course_code = '$code'";
            $qr = mysqli_query($con, $check);
            $rows = mysqli_num_rows($qr);

            if (!($rows > 0)) {
                    $qr2 = "INSERT INTO `tbl_subject`(`course_code`, `course_name`) VALUES ('$code','$firstname')";
                    $iquery = mysqli_query($con, $qr2);
                    if ($iquery) {
                        echo "<script>alert('Subject Inclusion Successful...')</script>";
                        echo "<script>window.location.href = 'viewsubject.php';</script>";
                    } else {
                        echo "<script>alert('Some error occured')</script>";
                    }
                
            } else {
                echo "<script>alert('subject already exists')</script>";
            }
        }
        

    ?>
</body>

</html>
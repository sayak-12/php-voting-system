<?php
session_start();
include '../connect.php'; 
if (isset($_GET['id'])) {
    $id = $_GET['id'];
}
else{
    header("Location:viewsubject.php");
}

$qr = "select * from tbl_subject where course_code = '$id'";
$qry = mysqli_query($con, $qr);
$res = mysqli_fetch_array($qry);
?>
<!DOCTYPE html>
<html>

<head>
    <?php include '../dependancies.php' ?>
    <title>Edit Subject</title>
</head>

<body>
    <div>
    </div>
    <div class="container">
        <h2 class="text-left"><a href="viewsubject.php" title="back to dashboard"><span class="material-symbols-outlined">
                    arrow_back
                </span></a> </h2>
        <h2 class="mb-4">Edit Subject</h2>
        <form method="post">
            <div class="form-group mt-2">
                <label for="firstname">Subject Name</label>
                <input required type="text" class="form-control" id="exampleInputfirstname" name="firstname" value="<?= $res['course_name']  ?>">
            </div>
            <div class="form-group mt-2">
                <label for="code">Course Code</label>
                <input required type="text" class="form-control" id="exampleInputcode" name="code" value="<?= $res['course_code']  ?>">
            </div>
            
            
           
            <button type="submit" class="btn btn-primary w-100 my-3" name="create">Edit Subject</button>
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
                    $qr2 = "UPDATE `tbl_subject` SET `course_code`='$code',`course_name`='$firstname' WHERE course_code='".$res['course_code']."'";
                    $iquery = mysqli_query($con, $qr2);
                    if ($iquery) {
                        echo "<script>alert('Subject Edit Successful...')</script>";
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
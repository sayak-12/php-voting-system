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
      $_SESSION['firstname'] = $db['Name'];
    } 
  } else{
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
    <h1>Welcome, <?php  echo $_SESSION['firstname'];?></h1>
    <div class="btngroup">
      <a href="enroll.php?type=student"><div class="btn btn-primary">Enroll Students</div></a>
      <a href="enroll.php?type=teacher"><div class="btn btn-primary">Enroll Teachers</div></a>
      <a href="import.php?type=student"><div class="btn btn-primary">import Students' Data</div></a>
      <a href="import.php?type=teacher"><div class="btn btn-primary">import Teachers' Data</div></a>
      <a href="view.php?type=student"><div class="btn btn-primary">View Students' Data</div></a>
      <a href="view.php?type=teacher"><div class="btn btn-primary">View Teachers' Data</div></a>
    </div>
    <a href="logout.php"><button class="btn btn-danger">Log Out</button></a>
</body>
</html>
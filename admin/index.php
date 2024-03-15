<?php 
session_start();
include "../connect.php";
if (isset($_COOKIE['remember_token'])) {
    $email = $_COOKIE['remember_token'];
    $loginquery = "SELECT * FROM `tbl_admin` WHERE email='$email'";
    $result = mysqli_query($con, $loginquery);
    $emailcount = mysqli_num_rows($result);

    if ($emailcount) {
      $db = mysqli_fetch_array($result);
      $_SESSION['firstname'] = $db['name'];
    } 
  } else{
    header('location:adminlogin.php');
  }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <?php include "../dependancies.php"; ?>
    <title>Admin Dashboard</title>
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
      <a href="addsubject.php"><div class="btn btn-primary">Add new Subject</div></a>
      <a href="viewsubject.php"><div class="btn btn-primary">View ongoing Subjects</div></a>
      <a href="assign.php"><div class="btn btn-primary">Assign Subjects</div></a>
      <a href="assignview.php"><div class="btn btn-primary">View Assigned Subjects</div></a>
      <a href="viewratings.php"><div class="btn btn-primary">View Ratings</div></a>
    </div>
    <a href="logout.php"><button class="btn btn-danger">Log Out</button></a>
</body>
</html>
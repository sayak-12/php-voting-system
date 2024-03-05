<?php 
session_start();
include "../connect.php";
if (isset($_COOKIE['remember_token'])) {
    $email = $_COOKIE['remember_token'];
    $loginquery = "SELECT * FROM `tbl_clerk` WHERE email='$email'";
    $result = mysqli_query($con, $loginquery);
    $emailcount = mysqli_num_rows($result);

    if ($emailcount) {
      $db = mysqli_fetch_array($result);
      $_SESSION['firstname'] = $db['name'];
    } 
  } else{
    header('location:clerklogin.php');
  }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <?php include "../dependancies.php"; ?>
    <title>Clerk Dashboard</title>
</head>
<body>
    <h1>Welcome, <?php  echo $_SESSION['firstname'];?></h1>
    <div class="btngroup">
      <a href="enroll.php?type=student"><div class="btn btn-primary">Enroll Students</div></a>
      <a href="enroll.php?type=teacher"><div class="btn btn-primary">Enroll Teachers</div></a>
    </div>
    <a href="logout.php"><button class="btn btn-danger">Log Out</button></a>
</body>
</html>
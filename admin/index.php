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
} else {
  header('location:adminlogin.php');
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <?php include "../dependancies.php"; ?>
  <title>Admin Dashboard</title>
</head>

<body class="d-flex flex-column align-items-center">
  <div class="navbar d-flex flex-column justify-content-center align-items-center p-3"><img src="https://upload.wikimedia.org/wikipedia/commons/thumb/b/bd/University_of_Engineering_and_Management_Kolkata_logo.png/640px-University_of_Engineering_and_Management_Kolkata_logo.png" alt="uemk logo" height="50">
    <h2 class="mt-2">University of Engineering & Management, Kolkata</h2>
  </div>
  <div class="d-flex justify-content-center align-items-center flex-column g-5">
    <h3 class="mb-3">Welcome to Admin Panel, <?php echo $_SESSION['firstname']; ?></h3>
    <div class="btngroup">
      <div class="d-flex flex-column mb-3">
        <h5 class="my-3">Students Works</h5>
        <div class="btngroup">
          <a href="enroll.php?type=student">
            <div class="btncard">
              <span class="material-symbols-outlined">
                person_add
              </span>
              <span>Add Student</span>
            </div>
          </a>
          <a href="import.php?type=student">
          <div class="btncard">
              <span class="material-symbols-outlined">
                group_add
              </span>
              <span>import students</span>
            </div>
          </a>
          <a href="view.php?type=student">
          <div class="btncard">
              <span class="material-symbols-outlined">
                person_search
              </span>
              <span>View Students</span>
            </div>
          </a>

        </div>
      </div>
      <div class="d-flex flex-column mb-3">
        <h5 class="my-3">Teachers Works</h5>
        <div class="btngroup">
          <a href="enroll.php?type=teacher">
          <div class="btncard">
              <span class="material-symbols-outlined">
                person_add
              </span>
              <span>Add Teacher</span>
            </div>
          </a>
          <a href="import.php?type=teacher">
          <div class="btncard">
              <span class="material-symbols-outlined">
                group_add
              </span>
              <span>import Teachers</span>
            </div>
          </a>
          <a href="view.php?type=teacher">
          <div class="btncard">
              <span class="material-symbols-outlined">
                person_search
              </span>
              <span>View Teachers</span>
            </div>
          </a>

        </div>
      </div>
      <div class="d-flex flex-column mb-3">
        <h5 class="my-3">Subjects Works</h5>
        <div class="btngroup">
          <a href="addsubject.php">
          <div class="btncard">
          <span class="material-symbols-outlined">
import_contacts
</span>
              <span>Add Subject</span>
            </div>
          </a>
          <a href="viewsubject.php">
          <div class="btncard">
          <span class="material-symbols-outlined">
dictionary
</span>
              <span>View Subject</span>
            </div>
          </a>
          <a href="assign.php">
          <div class="btncard">
          <span class="material-symbols-outlined">
assignment_add
</span>
              <span>Assign Subjects</span>
            </div>
          </a>
          <a href="assignview.php">
          <div class="btncard">
          <span class="material-symbols-outlined">
assignment_turned_in
</span>
              <span>View Assigned Subjects</span>
            </div>
          </a>

        </div>
      </div>

      <div class="d-flex flex-column mb-3">
        <h5 class="my-3">Ratings Works</h5>
        <div class="btngroup">
          <a href="viewratings.php">
          <div class="btncard">
          <span class="material-symbols-outlined">
thumb_up
</span>
              <span>View Ratings</span>
            </div>
          </a>

        </div>
      </div>

    </div>
    <a href="logout.php"><button class="btn btn-danger my-4">Log Out</button></a>
  </div>
</body>

</html>
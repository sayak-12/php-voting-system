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
} else {
    header('location:login.php');
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Assuming you have a form field for teacher id
    $teacher_id = $_POST['teacher_id'];
    $review1 = $_POST['review1'];
    $review2 = $_POST['review2'];
    $review3 = $_POST['review3'];
    $review4 = $_POST['review4'];

    // Insert reviews into tbl_reviews
    $insert_query = "INSERT INTO tbl_reviews (rev_by, rating_one, rating_two, rating_three, rating_four, rev_to) VALUES ('".$db['Enrollment']."', '$review1', '$review2', '$review3', '$review4', '$teacher_id')";
    mysqli_query($con, $insert_query);
    // Redirect to avoid resubmission
    header('Location: ' . $_SERVER['PHP_SELF']);
    exit;
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <?php include "../dependancies.php"; ?>
    <title>Student Dashboard</title>
</head>
<body>
    <h1>Welcome, <?php echo $_SESSION['firstname'];?></h1>
    <?php 
    $attendance_result= mysqli_query($con, "select Attendance from tbl_student where Enrollment =$email");
    $attendance_row = mysqli_fetch_array($attendance_result);
    $attendance = $attendance_row['Attendance'];
    if ($attendance >= 75) {
      ?>
      <table class="table table-striped">
        <tr>
            <th>Professor Name</th>
            <th>Review 1</th>
            <th>Review 2</th>
            <th>Review 3</th>
            <th>Review 4</th>
            <th>Submit</th>
        </tr>
        <?php 
        $qr= 'select * from tbl_teacher where department ="'. $db['Department'].'"';
        $res = mysqli_query($con, $qr);
        $count = mysqli_num_rows($res);
        if ($count) {
            while($row = mysqli_fetch_array($res)){
                ?>
                <form method="POST" action="<?php echo $_SERVER['PHP_SELF']; ?>">
                    <input type="hidden" name="teacher_id" value="<?php echo $row['teacher_id']; ?>">
                    <tr>
                        <td><?= $row["name"];?></td>
                        <td><select name="review1" id="review">
                            <option value="">select rating</option>
                            <option value="1">1</option>
                            <option value="2">2</option>
                            <option value="3">3</option>
                            <option value="4">4</option>
                            <option value="5">5</option>
                        </select></td>
                        <td><select name="review2" id="review">
                            <option value="">select rating</option>
                            <option value="1">1</option>
                            <option value="2">2</option>
                            <option value="3">3</option>
                            <option value="4">4</option>
                            <option value="5">5</option>
                        </select></td>
                        <td><select name="review3" id="review">
                            <option value="">select rating</option>
                            <option value="1">1</option>
                            <option value="2">2</option>
                            <option value="3">3</option>
                            <option value="4">4</option>
                            <option value="5">5</option>
                        </select></td>
                        <td><select name="review4" id="review">
                            <option value="">select rating</option>
                            <option value="1">1</option>
                            <option value="2">2</option>
                            <option value="3">3</option>
                            <option value="4">4</option>
                            <option value="5">5</option>
                        </select></td>
                        <td>
                        <?php 
                            $check_query = "SELECT * FROM tbl_reviews WHERE rev_by = '".$db['Enrollment']."' AND rev_to = '".$row['teacher_id']."'";
                            $check_result = mysqli_query($con, $check_query);
                            $existing_review_count = mysqli_num_rows($check_result);
                            if ($existing_review_count == 0) {
                                echo '<button type="submit" class="btn btn-primary">Submit Review</button>';
                            } else {
                                echo '<button type="button" class="btn btn-success" disabled>Review Submitted</button>';
                            }
                            ?>
                        </td>
                    </tr>
                </form>
                <?php
            }
        }
        ?>
    </table>
      <?php
    }
    else{
      ?>
      <h1 class="h2 text-danger">You're Not Eligible For Teacher Remarks Because of low attendance!</h1>
      <?php
    }
    ?>
    
    <a href="logout.php"><button class="btn btn-danger">Log Out</button></a>
</body>
</html>

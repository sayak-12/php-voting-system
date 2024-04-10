<?php
session_start();
?>
<!DOCTYPE html>
<html>

<head>
    <?php include '../dependancies.php' ?>
    <title>Assign Subjects to teachers</title>
</head>

<body>
    <?php include '../connect.php'; ?>
    <div>
    </div>
    <div class="container">
        <h2 class="text-left"><a href="index.php" title="back to dashboard"><span class="material-symbols-outlined">
                    arrow_back
                </span></a> </h2>
        <h2 class="mb-4">Assign Subjects</h2>
        <form method="post">
            <div class="form-group mt-2">
                <label for="dept">Department name</label>
                <input required type="text" class="form-control" id="exampleInputdept" name="dept">
            </div>
            <div class="form-group mt-2">
                <label for="section">Section</label>
                <input required type="text" class="form-control" id="exampleInputsec" name="section">
            </div>
            <div class="form-group mt-2">
                <label for="semester">Semester</label>
                <select name="semester" id="semester" class="w-100 form-control">
                    <option value="">Select a Semester</option>
                    <?php
                    for ($i = 1; $i <= 10; $i++) {
                        echo "<option value=\"$i\">$i</option>";
                    }
                    ?>
                </select>
            </div>

            <div class="form-group mt-2">
                <label for="code">Course Details</label>
                <select name="code" id="" class="w-100  form-control">
                    <option value="">Select a course code</option>
                    <?php
                    $query = "SELECT course_code, course_name FROM tbl_subject";
                    $result = mysqli_query($con, $query);
                    if ($result) {
                        while ($row = mysqli_fetch_assoc($result)) {
                            echo "<option value=\"" . $row['course_code'] . "\">" . $row['course_code'] . " - " . $row['course_name'] . "</option>";
                        }
                    } ?>
                </select>
            </div>
            <div class="form-group mt-2">
                <label for="teacher">Assign faculty</label>
                <select name="teacher" id="" class="w-100  form-control">
                    <option value="">Select a teacher</option>
                    <?php
                    $query = "SELECT teacher_id, name FROM tbl_teacher";
                    $result = mysqli_query($con, $query);
                    if ($result) {
                        while ($row = mysqli_fetch_assoc($result)) {
                            echo "<option value=\"" . $row['teacher_id'] . "\">" . $row['name'] . "</option>";
                        }
                    } ?>
                </select>
            </div>

            <button type="submit" class="btn btn-primary w-100 my-3" name="create">Assign</button>
        </form>
    </div>
    <?php
if (isset($_POST['create'])) {
    $dept = $_POST['dept'];
    $section = $_POST['section'];
    $semester = $_POST['semester'];
    $code = $_POST['code'];
    $teacher = $_POST['teacher'];
    $insert_query = "INSERT INTO tbl_teacher_assignment (course_code, department, semester, section, assigned_to) 
                    VALUES ('$code', '$dept', '$semester', '$section', '$teacher')";
    $insert_result = mysqli_query($con, $insert_query);

if ($insert_result) {
    echo "<script>alert('Assignment successful!');</script>";
} else {
    echo "<script>alert('Error: " . mysqli_error($con) . "');</script>";
}

}

    ?>
</body>

</html>
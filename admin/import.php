<?php
session_start();

if (isset($_GET["type"]) && ($_GET["type"] == "student" || $_GET["type"] == "teacher")) {
    $type = $_GET["type"];
} else {
    header("location:dashboard.php");
}

if (isset($_POST["create"])) {
    if (isset($_FILES["file"]) && $_FILES["file"]["error"] == 0) {
        $file = $_FILES["file"]["tmp_name"];
        $file_info = pathinfo($_FILES["file"]["name"]);
        if ($file_info["extension"] == "csv") {
            include '../connect.php';

            $handle = fopen($file, "r");
            if ($handle !== FALSE) {
                if ($type == "student") {
                    fgetcsv($handle);
                $sql = "INSERT INTO `tbl_student` (`Enrollment`, `Name`, `Phone`, `Department`, `Password`, `Attendance`) VALUES ";
                while (($data = fgetcsv($handle)) !== FALSE) {
                    $sql .= "('" . implode("', '", array_map('addslashes', $data)) . "'),";
                }
                fclose($handle);
                $sql = rtrim($sql, ",");
                if (mysqli_query($con, $sql)) {
                    $_SESSION['msg'] = "Successfully imported!";
                } else {
                    $_SESSION['error'] = "Error: " . mysqli_error($con);
                }
                }
                else if ($type=="teacher"){
                    fgetcsv($handle);
                $sql = "INSERT INTO `tbl_teacher` (`teacher_id`, `name`, `email`) VALUES ";
                while (($data = fgetcsv($handle)) !== FALSE) {
                    $sql .= "('" . implode("', '", array_map('addslashes', $data)) . "'),";
                }
                fclose($handle);
                $sql = rtrim($sql, ",");
                if (mysqli_query($con, $sql)) {
                    $_SESSION['msg'] = "Successfully imported!";
                } else {
                    $_SESSION['error'] = "Error: " . mysqli_error($con);
                }
                }
            } else {
                $_SESSION['error'] = "Error reading the CSV file.";
            }
            mysqli_close($con);
        } else {
            $_SESSION['error'] = "Please upload a CSV file.";
        }
        header("Location: import.php?type=$type");
        exit();
    } else {
        $_SESSION['error'] = "Error uploading file.";
    }
}
?>
<!DOCTYPE html>
<html>

<head>
    <?php include '../dependancies.php' ?>
    <title>Import <?php echo $type; ?>s' Data</title>
</head>

<body>
    <?php include '../connect.php'; ?>
    <div>
    </div>
    <div class="container">
        <h2 class="text-left"><a href="dashboard.php" title="back to dashboard"><span class="material-symbols-outlined">
                    arrow_back
                </span></a> </h2>
        <h2 class="mb-2">Enroll new <?php echo $type; ?></h2>
        <?php
        if (isset($_SESSION['error'])) {
            echo "<p class='text-danger'>" . $_SESSION['error'] . "</p>";
            unset($_SESSION['error']);
        }
        if (isset($_SESSION['msg'])) {
            echo "<p class='text-success'>" . $_SESSION['msg'] . "</p>";
            unset($_SESSION['msg']);
        }
        ?>
        <form method="post" enctype="multipart/form-data" action="import.php?type=<?php echo $type; ?>">
            <label for="file" class="mb-1 text-danger">Enter the database in .CSV format.</label>
            <input type="file" name="file" id="file">
            <button type="submit" class="btn btn-primary w-100 my-3" name="create">Enroll <?php echo $type; ?></button>
            <?php if ($type == "student") { ?>
                <p>Enroll individual student here: <a href="enroll.php?type=student">New Student</a></p>
            <?php } ?>
            <?php if ($type == "teacher") { ?>
                <p>Enroll individual teacher here: <a href="enroll.php?type=teacher">New Teacher</a></p>
            <?php } ?>
        </form>
    </div>
</body>

</html>
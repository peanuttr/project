<?php
require "../../config/db.php";
$db = new db();
if (isset($_FILES['upload'])) {
    $file = $_FILES['upload']['tmp_name'];
    $file_open = fopen($file, "r");
    $status = "ทำงาน";
    while (($csv = fgetcsv($file_open, ",")) !== false) {
        $dep = $csv[0];
        $jobTitle = $csv[1];
        $fisrtname = $csv[3];
        $lastname = $csv[4];
        $stmt = $db->sqlQuery("SELECT * FROM department WHERE `department_name` LIKE '%$dep%'");
        $stmt->execute();
        while ($result = $stmt->fetch(PDO::FETCH_ASSOC)) {
            $department_id = $result['id'];
            $department_name = $result['department_name'];
            $stmt1 = $db->sqlQuery("INSERT INTO `personnels`(`personnel_firstname`, `personnel_lastname`, `job_title`, `status`, `department_id`) VALUES ('$fisrtname', '$lastname', '$jobTitle', '$status', '$department_id')");
            $stmt1->execute();
        }
    }
    if ($stmt1) {
        header("location: ../../../../../project/views/personnel/personnel-management.php");
    }
} else {
    if (is_null($_POST['id'])) {
        $fisrtname = $_POST['fisrtname'];
        $lastname = $_POST['lastname'];
        $jobTitle = $_POST['jobTitle'];
        $telephone = $_POST['telephone'];
        $extensionNumber = $_POST['extensionNumber'];
        $status = $_POST['status'];
        $email = $_POST['email'];
        $department_id = $_POST['departmentId'];

        $stmt = $db->sqlQuery("INSERT INTO `personnels`(`personnel_firstname`, `personnel_lastname`, `job_title`, `telephone_number`, `extension_number`, `status`, `email`, `department_id`) VALUES ('$fisrtname', '$lastname', '$jobTitle', '$telephone', '$extensionNumber', '$status', '$email', '$department_id')");
        if ($stmt->execute()) {
            header("location: ../../../../../project/views/personnel/personnel-management.php");
        }
    } else {
        $_id = $_POST['id'];
        $fname = $_POST['fisrtname'];
        $lname = $_POST['lastname'];
        $jobTitle = $_POST['jobTitle'];
        $telephone = $_POST['telephone'];
        $extensionNumber = $_POST['extensionNumber'];
        $status = $_POST['status'];
        $email = $_POST['email'];
        $department_id = $_POST['departmentId'];

        $stmt = $db->sqlQuery("UPDATE `personnels` SET `personnel_firstname`= '$fname', `personnel_lastname`= '$lname', `job_title` = '$jobTitle', `telephone_number`= '$telephone', `extension_number` = '$extensionNumber', `status`= '$status', `email`= '$email',`department_id`= '$department_id' WHERE `id`= '$_id'");
        if ($stmt->execute()) {
            header("location: ../../../../../project/views/personnel/personnel-management.php");
        }
    }
}

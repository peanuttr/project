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
        $fisrtname = $csv[2];
        $lastname = $csv[3];
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
} 
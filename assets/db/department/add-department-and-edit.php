<?php
require "../../config/db.php";
$db = new db();
if (is_null($_POST['id'])) {
    $departmentName = $_POST['departmentName'];
    $departmentNumber = $_POST['departmentNumber'];

    $stmt = $db->sqlQuery("INSERT INTO `department`(`department_name`, `department_number`) VALUES ('$departmentName', '$departmentNumber')");
    if ($stmt->execute()) {
        header("location: ../../../../../project/views/department/department-management.php");
    }
} else {
    $_id = $_POST['id'];
    $departmentNameEdit = $_POST['departmentName'];
    $departmentNumberEdit = $_POST['departmentNumber'];

    $stmt = $db->sqlQuery("UPDATE `department` SET `department_name`= '$departmentNameEdit', `department_number` = '$departmentNumberEdit' WHERE `id`= '$_id'");
    if ($stmt->execute()) {
        header("location: ../../../../../project/views/department/department-management.php");
    }
}

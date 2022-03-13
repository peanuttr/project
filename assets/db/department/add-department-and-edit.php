<?php
require "../../config/db.php";
$db = new db();
if (is_null($_POST['id'])) {
    $departmentName = $_POST['departmentName'];

    echo "departmentName:$departmentName";

    $stmt = $db->insertData("INSERT INTO `department`(`department_name`) VALUES ('$departmentName')");
    if ($stmt->execute()) {
        header("location: ../../../../../project/views/department/department-management.php");
    }
} else {
    $_id = $_POST['id'];
    $departmentNameEdit = $_POST['departmentName'];

    $stmt = $db->updateData("UPDATE `department` SET `department_name`= '$departmentNameEdit' WHERE `id`= '$_id'");
    if ($stmt->execute()) {
        header("location: ../../../../../project/views/department/department-management.php");
    }
}

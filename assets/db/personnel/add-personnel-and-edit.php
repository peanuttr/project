<?php
require "../../config/db.php";
$db = new db();
if (is_null($_POST['id'])) {
    $fisrtname = $_POST['fisrtname'];
    $lastname = $_POST['lastname'];
    $telephone = $_POST['telephone'];
    $status = $_POST['status'];
    $email = $_POST['email'];
    $department_id = $_POST['department_id'];

    echo "fisrtname:$fisrtname";
    echo "lastname:$lastname";
    echo "telephone:$telephone";
    echo "status:$status";
    echo "email:$email";
    echo "department_id:$department_id";

    $stmt = $db->insertData("INSERT INTO `personnels`(`personnel_firstname`, `personnel_lastname`, `telephone_number`, `status`, `email`, `department_id`) VALUES ('$fisrtname', '$lastname', '$telephone', '$status', '$email', '$department_id')");
    if ($stmt->execute()) {
        header("location: ../../../../../project/views/personnel/personnel-management.php");
    }
} else {
    $_id = $_POST['id'];
    $fname = $_POST['fisrtname'];
    $lname = $_POST['lastname'];
    $telephone = $_POST['telephone'];
    $status = $_POST['status'];
    $email = $_POST['email'];
    $department_id = $_POST['department_id'];

    $stmt = $db->updateData("UPDATE `personnels` SET `personnel_firstname`= '$fname', `personnel_lastname`= '$lname', `telephone_number`= '$telephone', `status`= '$status', `email`= '$email',`department_id`= '$department_id' WHERE `id`= '$_id'");
    if ($stmt->execute()) {
        header("location: ../../../../../project/views/personnel/personnel-management.php");
    }
}

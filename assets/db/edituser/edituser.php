<?php
require "../../config/db.php";
session_start();
$db = new db();

$_id = $_SESSION['userid'];
$userName = $_POST['userName'];
$password = $_POST['password'];
$firstName = $_POST['firstname'];
$lastName = $_POST['lastname'];
$telephone = $_POST['telephone'];
$email = $_POST['email'];
$departmentId = $_POST['departmentId'];

echo $_id;

$stmt = $db->sqlQuery("UPDATE `staffs` SET `username`= '$userName', `password`= '$password', `staff_firstname` = '$firstName', `staff_lastname`= '$lastName', `telephone` = '$telephone', `email`= '$email', `department_id`= '$departmentId' WHERE `id`= '$_id'");
if ($stmt->execute()) {
    header("location: ../../../../../project/views/edituser/edituser.php");
}
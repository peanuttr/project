<?php
require "../../config/db.php";
$db = new db();
if(is_null($_POST['id'])){
    $username = $_POST['username'];
    $password = $_POST['password'];
    $fisrtname = $_POST['fisrtname'];
    $lastname = $_POST['lastname'];
    $telephone = $_POST['telephone'];
    $email = $_POST['email'];
    $permission = $_POST['permission'];
    $department_id = $_POST['department_id'];

    echo "username:$username";
    echo "password:$password";
    echo "fisrtname:$fisrtname";
    echo "lastname:$lastname";
    echo "telephone:$telephone";
    echo "email:$email";
    echo "permission:$permission";
    echo "department_id:$department_id";

    $stmt = $db->connect()->prepare("INSERT INTO `staffs`(`username`, `password`, `staff_firstname`, `staff_lastname`, `permission`, `telephone`, `email`, `department_id`) VALUES ('$username','$password','$fisrtname','$lastname','$permission','$telephone','$email','$department_id')");
    if ($stmt->execute()) {
        header("location: ../../../../../project/views/user/user-management.php");
    }
} else {
    $_id = $_POST['id'];
    $username = $_POST['username'];
    $password = $_POST['password'];
    $fname = $_POST['fisrtname'];
    $lname = $_POST['lastname'];
    $telephone = $_POST['telephone'];
    $email = $_POST['email'];
    $permission = $_POST['permission'];
    $department_id = $_POST['department_id'];

    $stmt = $db->connect()->prepare("UPDATE `staffs` SET `username`= '$username', `password`= '$password', `staff_firstname`= '$fname', `staff_lastname`= '$lname', `permission`= '$permission', `telephone`= '$telephone',`email`= '$email',`department_id`= '$department_id' WHERE `id`= '$_id'");
    if ($stmt->execute()) {
        header("location: ../../../../../project/views/user/user-management.php");
    }
}
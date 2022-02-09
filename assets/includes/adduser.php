<?php
require_once "../controller/userController.php";
$userController = new userController();
if (!empty($_POST)) {
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

    echo $userController->addUser($username, $password, $fisrtname, $lastname, $telephone, $email, $permission, $department_id);
    header("location: ../../views/user-management.php");
}

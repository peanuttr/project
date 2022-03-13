<?php
require "./assets/db/user/user.php";

$user = new user;
$data = $user->getAll();

foreach ($data as $result) {
    echo $result['staff_firstname'];
    echo $result['staff_lastname'];
    echo $result['department_name'];
}
// print_r($data);
// echo $data;
// header("location: ./views/login/login.php");

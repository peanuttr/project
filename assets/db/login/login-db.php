<?php
session_start();
require '../../config/db.php';

if (isset($_POST['submit'])) {
    $user = $_POST['username'];
    $pass = $_POST['password'];
    $db = new db();
    $stmt = $db->sqlQuery("SELECT * FROM `staffs` WHERE `username` = '$user' AND `password` = '$pass'");
    $stmt->execute();
    $res = $stmt->fetch(PDO::FETCH_ASSOC);
    if (!empty($res['username'])) {
        $_SESSION['username'] = $res['username'];
        $_SESSION['status'] = $res['permission'];
        $_SESSION['firstName'] = $res['staff_firstname'];
        $_SESSION['userid'] = $res['id'];
        sleep(3);
        header('location: ../../../../../project/views/dashboard/dashboard.php');
    } else {
        sleep(3);
        header('location: ../../../../../project/views/login/login.php');
    }
}

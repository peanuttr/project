<?php
require "../../config/db.php";
$db = new db();

if(isset($_POST['id'])){
    $_id = $_POST['id'];
    // $stmt = $db->connect()->prepare("DELETE FROM staffs WHERE id = $_id");
    // if ($stmt->execute()) {
    //     header("location: ../../../../../project/views/user/user-management.php");
    // }
    $data = $db->DeleteData("DELETE FROM staffs WHERE id = $_id");
    if ($data->execute()) {
        header("location: ../../../../../project/views/user/user-management.php");
    }
}

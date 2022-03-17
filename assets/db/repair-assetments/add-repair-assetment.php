<?php
require "../../config/db.php";
$db = new db();
if(isset($_POST['submit'])){
    $_id = $_POST['assets-id'];
    $data = $_POST['date'];
    $detail = $_POST['detail'];
    $p_id = $_POST['personnel_id'];
    // $assets_number = $_POST['assets_number'];
    // $assets_name = $_POST['name'];
    $stmt = $db->sqlQuery("INSERT INTO `repair_notice`(`detail`, `date_notice`, `status`, `personel_id`, `asset_id`,`image`) VALUES ('$detail', '$data', '1', '$p_id', '$_id', 'null')");
    if ($stmt->execute()) {
        header("location: ../../../../../project/views/repair-assetments/repair-assetments-manage.php");
    }
}
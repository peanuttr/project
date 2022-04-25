<?php
require "../../config/db.php";
$db = new db();

if(isset($_POST['submit'])){
    $assets = array();
    for($i = 0 ; $i < count($_POST['assets_number']); $i++){
        array_push($assets,['id' => $_POST['assets_id'][$i], 'assets_number' => $_POST['assets_number'][$i], 'assets_name' => $_POST['assets_name'][$i]]);
    }
    $date = $_POST['date'];
    $s_id = $_POST['staff_id'];
    $detail = $_POST['detail'];
    $day = substr($date, 0, 2);
    $month = substr($date, 3, 2);
    $year = substr($date, 6) - 543;
    $newDate = "$day-$month-$year";
    $newFormatDate = date("Y-m-d", strtotime($newDate));

    $stmt = $db->sqlQuery("INSERT INTO `sells`( `detail`, `selling_date`, `status`, `staff_id`) VALUES ('$detail', '$newFormatDate','1', '$s_id')");
    if($stmt->execute()){
        $stmt = $db->sqlQuery("SELECT * FROM `sells` ORDER BY `id` DESC LIMIT 1");
        $stmt->execute();
        $res = $stmt->fetch(PDO::FETCH_ASSOC);
        foreach($assets as $resp){
            $stmt = $db->sqlQuery("INSERT INTO `detail_sells`(`asset_id`,`sell_id`) VALUES ('".$resp['id']."','".$res['id']."')");
            $stmt->execute();
            $stmt = $db->sqlQuery("UPDATE `assets` SET `status`='แจ้งจำหน่าย' WHERE  `id`=".$resp['id']);
            $stmt->execute();
        }
        header("location: ../../../../../project/views/sale-assetments/sale-assetment-manage.php");
    }
}
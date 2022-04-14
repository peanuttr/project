<?php
require "../../config/db.php";
$db = new db();

if(isset($_POST['submit'])){
    $assets = array();
    for($i = 0 ; $i < count($_POST['assets_number']); $i++){
        array_push($assets,['id' => $_POST['assets_id'][$i], 'assets_number' => $_POST['assets_number'][$i], 'assets_name' => $_POST['assets_name'][$i]]);
    }
    $date = $_POST['date'];
    $p_id = $_POST['personnel_id'];
    $detail = $_POST['detail'];
    $day = substr($date, 0, 2);
    $month = substr($date, 3, 2);
    $year = substr($date, 6) - 543;
    $newDate = "$day-$month-$year";
    $newFormatDate = date("Y-m-d", strtotime($newDate));

    $stmt = $db->sqlQuery("INSERT INTO `repair_notice`( `detail`, `date_notice`, `status`, `personel_id`,`image`) VALUES ('$detail', '$newFormatDate','1', '$p_id', 'null')");
    if($stmt->execute()){
        $stmt = $db->sqlQuery("SELECT * FROM `repair_notice` ORDER BY `id` DESC LIMIT 1");
        $stmt->execute();
        $res = $stmt->fetch(PDO::FETCH_ASSOC);
        foreach($assets as $resp){
            $stmt = $db->sqlQuery("INSERT INTO `detail_repair_notice`(`asset_id`,`repair_id`) VALUES ('".$resp['id']."','".$res['id']."')");
            $stmt->execute();
        }
        header("location: ../../../../../project/views/repair-assetments/repair-assetments-manage.php");
    }

    
    

    // $_id = $_POST['assets-id'];
    // $data = $_POST['date'];
    // $detail = $_POST['detail'];
    // $p_id = $_POST['personnel_id'];
    // $assets_number = $_POST['assets_number'];
    // $assets_name = $_POST['name'];
    // $stmt = $db->sqlQuery("INSERT INTO `repair_notice`(`detail`, `date_notice`, `status`, `personel_id`, `asset_id`,`image`) VALUES ('$detail', '$data', '1', '$p_id', '$_id', 'null')");
    // if ($stmt->execute()) {
    //     header("location: ../../../../../project/views/repair-assetments/repair-assetments-manage.php");
    // }
}
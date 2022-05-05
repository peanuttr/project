<?php
require "../../config/db.php";
$db = new db();

if (isset($_POST['submit'])) {
    $_id = $_POST['id'];
    $assets = array();
    for ($i = 0; $i < count($_POST['assets_number']); $i++) {
        array_push($assets, ['id' => $_POST['assets_id'][$i], 'assets_number' => $_POST['assets_number'][$i], 'assets_name' => $_POST['assets_name'][$i]]);
    }
    $date = $_POST['date'];
    $p_id = $_POST['personnel_id'];
    $detail = $_POST['detail'];
    $day = substr($date, 0, 2);
    $month = substr($date, 3, 2);
    $year = substr($date, 6) - 543;
    $newDate = "$day-$month-$year";
    $newFormatDate = date("Y-m-d", strtotime($newDate));

    $stmt = $db->sqlQuery("UPDATE `repair_notice` SET `detail` = '$detail', `date_notice` = '$newFormatDate', `status` = '1', `personel_id` = '$p_id',`image` = '$image' WHERE  `id`='$_id'");
    if ($stmt->execute()) {
        foreach ($assets as $resp) {
            $stmt = $db->sqlQuery("UPDATE `detail_repair_notice` SET `asset_id` = '$resp[id]' WHERE  `repair_id`='$_id'");
        }

        header("location: ../../../../../project/views/asset-detail/asset-management.php");
    }
    // print_r($newFormatDate);
}

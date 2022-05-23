<?php
require "../../config/db.php";
$db = new db();

if (isset($_POST['id'])) {
    $_id = $_POST['id'];
    $assetId = array();
    $stmt = $db->sqlQuery("SELECT asset_id FROM `detail_borrow_and_return` WHERE `borrow_and_return_id` = $_id");
    $stmt->execute();
    while ($result = $stmt->fetch(PDO::FETCH_ASSOC)) {
        array_push($assetId, $result['asset_id']);
    }

    $stmt = $db->sqlQuery("UPDATE `borrow_and_return` set `status` = 'ไม่อนุมัติ' WHERE `id` = $_id");
    $stmt->execute();
    foreach($assetId as $index) {
        $stmt = $db->sqlQuery("UPDATE `detail_borrow_and_return` set `status`='ไม่อนุมัติ' WHERE `borrow_and_return_id`='$_id'");
        $stmt->execute();
        $stmt = $db->sqlQuery("UPDATE `assets` set `status`='อยู่ในคลัง' WHERE `id`='$index'");
        $stmt->execute();
    }
}


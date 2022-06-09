<?php
require "../../config/db.php";
$db = new db();

if (isset($_POST['id'])) {
    $_id = $_POST['id'];
    $assetId = array();
    $stmt = $db->sqlQuery("SELECT asset_id FROM `detail_sells` WHERE `sell_id` = $_id");
    $stmt->execute();
    while ($result = $stmt->fetch(PDO::FETCH_ASSOC)) {
        array_push($assetId, $result['asset_id']);
    }

    foreach ($assetId as $index) {
        $stmt = $db->sqlQuery("UPDATE `assets` set `status`='อยู่ในคลัง' WHERE `id`='$index'");
        $stmt->execute();
    }

    $stmt = $db->sqlQuery("DELETE FROM detail_sells WHERE sell_id = $_id");
    
    if ($stmt->execute()) {
        $stmt = $db->sqlQuery("DELETE FROM sells WHERE id = $_id");
        $stmt->execute();
        header("location: ../../../../../project/views/asset-detail/asset-management.php");
    }
}
?>
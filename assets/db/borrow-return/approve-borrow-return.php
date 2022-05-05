<?php
session_start();
require "../../config/db.php";
$db = new db();

if (isset($_POST['id'])) {
    $_id = $_POST['id'];
    $assetId = $_SESSION['asset_id'];

    foreach ($assetId as $index) {
        $stmt = $db->sqlQuery("UPDATE `detail_borrow_and_return` set `status`='ถูกยืม' WHERE `borrow_and_return_id`='$_id'");
        $stmt->execute();
        $stmt = $db->sqlQuery("UPDATE `assets` set `status`='ถูกยืม' WHERE `id`='$index'");
        $stmt->execute();
    }

    if($stmt->execute()) {
        header("location: ../../../../../project/views/borrow-return/borrow-return-management.php");
    }
}
?>
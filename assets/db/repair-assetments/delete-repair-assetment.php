<?php
require "../../config/db.php";
$db = new db();

if (isset($_POST['id'])) {
    $_id = $_POST['id'];
    $stmt = $db->sqlQuery("DELETE FROM detail_repair_notice WHERE repair_id = $_id");
    if ($stmt->execute()) {
        $stmt = $db->sqlQuery("DELETE FROM repair_notice WHERE id = $_id");
        $stmt->execute();
        header("location: ../../../../../project/views/asset-detail/asset-management.php");
    }
}

<?php
require "../../config/db.php";
$db = new db();

if (isset($_POST['id'])) {
    $_id = $_POST['id'];
    $stmt = $db->sqlQuery("DELETE FROM assets WHERE id = $_id");
    if ($stmt->execute()) {
        header("location: ../../../../../project/views/asset-detail/asset-management.php");
    }
}

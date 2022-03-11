<?php
require "../../config/db.php";
$db = new db();

if(isset($_POST['id'])){
    $_id = $_POST['id'];
    $stmt = $db->connect()->prepare("DELETE FROM assets_types WHERE id = $_id");
    if ($stmt->execute()) {
        header("location: ../../../../../project/views/assetments-type/assetments-type-management.php");
    }
}

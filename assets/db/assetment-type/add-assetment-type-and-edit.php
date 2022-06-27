<?php
require "../../config/db.php";
$db = new db();
    if (is_null($_POST['id'])) {
        $assetmentTypeName = $_POST['assetmentTypeName'];
        $assetmentTypeNumber = $_POST['assetmentTypeNumber'];

        // echo "assetmentTypeName:$assetmentTypeName";

        $stmt = $db->sqlQuery("INSERT INTO `assets_types`(`assets_types_name`,`assets_types_number`) VALUES ('$assetmentTypeName','$assetmentTypeNumber')");
        if ($stmt->execute()) {
            header("location: ../../../../../project/views/assetments-type/assetments-type-management.php");
        }
    } else {
        $_id = $_POST['id'];
        $assetmentTypeName = $_POST['assetmentTypeName'];
        $assetmentTypeNumber = $_POST['assetmentTypeNumber'];

        $stmt = $db->sqlQuery("UPDATE `assets_types` SET `assets_types_name`= '$assetmentTypeName' ,`assets_types_number` = '$assetmentTypeNumber' WHERE `id`= '$_id'");
        if ($stmt->execute()) {
            header("location: ../../../../../project/views/assetments-type/assetments-type-management.php");
        }
    }
<?php
require "../../config/db.php";
$db = new db();
if (is_null($_POST['id'])) {
    $assetmentTypeName = $_POST['assetmentTypeName'];

    echo "assetmentTypeName:$assetmentTypeName";

    $stmt = $db->connect()->prepare("INSERT INTO `assets_types`(`assets_types_name`) VALUES ('$assetmentTypeName')");
    if ($stmt->execute()) {
        header("location: ../../../../../project/views/assetments-type/assetments-type-management.php");
    }
} else {
    $_id = $_POST['id'];
    $assetmentTypeNameEdit = $_POST['assetmentTypeName'];

    $stmt = $db->connect()->prepare("UPDATE `assets_types` SET `assets_types_name`= '$assetmentTypeNameEdit' WHERE `id`= '$_id'");
    if ($stmt->execute()) {
        header("location: ../../../../../project/views/assetments-type/assetments-type-management.php");
    }
}


// if ($stmt->execute()) {
//     header("location: ../../../../../project/views/assetments-type/assetments-type-management.php");
// }
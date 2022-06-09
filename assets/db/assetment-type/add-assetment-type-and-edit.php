<?php
require "../../config/db.php";
$db = new db();
// if (isset($_FILES['upload'])) {
//     $file = $_FILES['upload']['tmp_name'];
//     $file_open = fopen($file, "r");
//     while (($csv = fgetcsv($file_open, ",")) !== false) {
//         $assetmentTypeNumber = $csv[0];
//         $assetmentTypeName = $csv[1];
//         // echo 'No:'. $assetmentTypeNumber." Name:".$assetmentTypeName;
//         $stmt = $db->sqlQuery("INSERT INTO `assets_types`(`assets_types_name`) VALUES ('$assetmentTypeName')");
//         $stmt->execute();
//     }
//     header("location: ../../../../../project/views/assetments-type/assetments-type-management.php");
// } else {
    if (is_null($_POST['id'])) {
        $assetmentTypeName = $_POST['assetmentTypeName'];

        // echo "assetmentTypeName:$assetmentTypeName";

        $stmt = $db->sqlQuery("INSERT INTO `assets_types`(`assets_types_name`) VALUES ('$assetmentTypeName')");
        if ($stmt->execute()) {
            header("location: ../../../../../project/views/assetments-type/assetments-type-management.php");
        }
    } else {
        $_id = $_POST['id'];
        $assetmentTypeName = $_POST['assetmentTypeName'];

        $stmt = $db->sqlQuery("UPDATE `assets_types` SET `assets_types_name`= '$assetmentTypeName' WHERE `id`= '$_id'");
        if ($stmt->execute()) {
            header("location: ../../../../../project/views/assetments-type/assetments-type-management.php");
        }
    }
// }



// if ($stmt->execute()) {
//     header("location: ../../../../../project/views/assetments-type/assetments-type-management.php");
// }
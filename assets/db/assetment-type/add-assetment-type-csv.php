<?php
require "../../config/db.php";
$db = new db();
if (isset($_FILES['upload'])) {
    $file = $_FILES['upload']['tmp_name'];
    $file_open = fopen($file, "r");
    while (($csv = fgetcsv($file_open, ",")) !== false) {
        $assetmentTypeNumber = $csv[0];
        $assetmentTypeName = $csv[1];
        // echo 'No:'. $assetmentTypeNumber." Name:".$assetmentTypeName;
        $stmt = $db->sqlQuery("INSERT INTO `assets_types`(`assets_types_number`,`assets_types_name`) VALUES ('$assetmentTypeNumber','$assetmentTypeName')");
        $stmt->execute();
    }
    header("location: ../../../../../project/views/assetments-type/assetments-type-management.php");
}
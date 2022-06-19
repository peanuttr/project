<?php
require "../../config/db.php";
$db = new db();
if (isset($_FILES['upload'])) {
    $file = $_FILES['upload']['tmp_name'];
    $file_open = fopen($file, "r");
    while (($csv = fgetcsv($file_open, ",")) !== false) {
        $placeName = $csv[0];
        // $assetmentTypeName = $csv[1];
        // echo 'No:'. $assetmentTypeNumber." Name:".$assetmentTypeName;
        $stmt = $db->sqlQuery("INSERT INTO `place`(`placename`) VALUES ('$placeName')");
        $stmt->execute();
    }
    header("location: ../../../../../project/views/place/place-management.php");
}
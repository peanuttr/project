<?php
require "../../config/db.php";
$db = new db();
if (isset($_FILES['upload'])) {
    $file = $_FILES['upload']['tmp_name'];
    $file_open = fopen($file, "r");
    while (($csv = fgetcsv($file_open, ",")) !== false) {
        $unitName = $csv[0];
        $stmt = $db->sqlQuery("INSERT INTO `unit`(`unit_name`) VALUES ('$unitName')");
        $stmt->execute();
    }
    header("location: ../../../../../project/views/unit/unit-management.php");
}
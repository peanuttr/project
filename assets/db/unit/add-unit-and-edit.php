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
} else {
    if (is_null($_POST['id'])) {
        $unitName = $_POST['unitName'];

        echo "unitName:$unitName";

        $stmt = $db->sqlQuery("INSERT INTO `unit`(`unit_name`) VALUES ('$unitName')");
        if ($stmt->execute()) {
            header("location: ../../../../../project/views/unit/unit-management.php");
        }
    } else {
        $_id = $_POST['id'];
        $unitNameEdit = $_POST['unitName'];

        $stmt = $db->sqlQuery("UPDATE `unit` SET `unit_name`= '$unitNameEdit' WHERE `id`= '$_id'");
        if ($stmt->execute()) {
            header("location: ../../../../../project/views/unit/unit-management.php");
        }
    }
}

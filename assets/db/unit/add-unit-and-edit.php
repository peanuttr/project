<?php
require "../../config/db.php";
$db = new db();
if (is_null($_POST['id'])) {
    $unitName = $_POST['unitName'];

    echo "unitName:$unitName";

    $stmt = $db->connect()->prepare("INSERT INTO `unit`(`unit_name`) VALUES ('$unitName')");
    if ($stmt->execute()) {
        header("location: ../../../../../project/views/unit/unit-management.php");
    }
} else {
    $_id = $_POST['id'];
    $unitNameEdit = $_POST['unitName'];

    $stmt = $db->connect()->prepare("UPDATE `unit` SET `unit_name`= '$unitNameEdit' WHERE `id`= '$_id'");
    if ($stmt->execute()) {
        header("location: ../../../../../project/views/unit/unit-management.php");
    }
}

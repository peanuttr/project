<?php
require "../../config/db.php";
$db = new db();
if (is_null($_POST['id'])) {
    $moneySourceName = $_POST['moneySourceName'];

    echo "moneySourceName:$moneySourceName";

    $stmt = $db->connect()->prepare("INSERT INTO `money_source`(`money_source_name`) VALUES ('$moneySourceName')");
    if ($stmt->execute()) {
        header("location: ../../../../../project/views/money-source/money-source-management.php");
    }
} else {
    $_id = $_POST['id'];
    $unitNameEdit = $_POST['unitName'];

    $stmt = $db->connect()->prepare("UPDATE `unit` SET `unit_name`= '$unitNameEdit' WHERE `id`= '$_id'");
    if ($stmt->execute()) {
        header("location: ../../../../../project/views/unit/unit-management.php");
    }
}

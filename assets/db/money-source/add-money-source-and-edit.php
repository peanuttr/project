<?php
require "../../config/db.php";
$db = new db();
if (is_null($_POST['id'])) {
    $moneySourceName = $_POST['moneySourceName'];

    echo "moneySourceName:$moneySourceName";

    $stmt = $db->sqlQuery("INSERT INTO `money_source`(`money_source_name`) VALUES ('$moneySourceName')");
    if ($stmt->execute()) {
        header("location: ../../../../../project/views/money-source/money-source-management.php");
    }
} else {
    $_id = $_POST['id'];
    $moneySourceNameEdit = $_POST['moneySourceName'];

    $stmt = $db->sqlQuery("UPDATE `money_source` SET `money_source_name`= '$moneySourceNameEdit' WHERE `id`= '$_id'");
    if ($stmt->execute()) {
        header("location: ../../../../../project/views/money-source/money-source-management.php");
    }
}

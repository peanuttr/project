<?php
require "../../config/db.php";
$db = new db();
    if (is_null($_POST['id'])) {
        $moneySourceName = $_POST['moneySourceName'];
        $moneySourceNumber = $_POST['moneySourceNumber'];

        $stmt = $db->sqlQuery("INSERT INTO `money_source`(`money_source_name`, `money_source_number`) VALUES ('$moneySourceName', '$moneySourceNumber')");
        if ($stmt->execute()) {
            header("location: ../../../../../project/views/money-source/money-source-management.php");
        }
    } else {
        $_id = $_POST['id'];
        $moneySourceNameEdit = $_POST['moneySourceName'];
        $moneySourceNumberEdit = $_POST['moneySourceNumber'];

        $stmt = $db->sqlQuery("UPDATE `money_source` SET `money_source_name`= '$moneySourceNameEdit', `money_source_number` = '$moneySourceNumberEdit' WHERE `id`= '$_id'");
        if ($stmt->execute()) {
            header("location: ../../../../../project/views/money-source/money-source-management.php");
        }
    }
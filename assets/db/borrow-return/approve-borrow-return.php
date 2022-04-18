<?php
require "../../config/db.php";
$db = new db();

if (isset($_GET['id'])) {
    $_id = $_GET['id'];

    $stmt = $db->sqlQuery("UPDATE `borrow_and_return` set `status`='อนุมัติ' WHERE `id`='$_id'");
    $stmt->execute();
    if($stmt->execute()) {
        header("location: ../../../../../project/views/borrow-return/borrow-return-management.php");
    }
}
?>
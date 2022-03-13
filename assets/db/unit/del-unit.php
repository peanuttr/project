<?php
require "../../config/db.php";
$db = new db();

if(isset($_POST['id'])){
    $_id = $_POST['id'];
    $stmt = $db->sqlQuery("DELETE FROM unit WHERE id = $_id");
    if ($stmt->execute()) {
        header("location: ../../../../../project/views/unit/unit-management.php");
    }
}

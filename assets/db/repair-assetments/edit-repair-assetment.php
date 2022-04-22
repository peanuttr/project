<?php
include "../../config/db.php";

$db = new db();

if(isset($_POST['id'])){
    $id = $_POST['id'];

    $stmt = $db->sqlQuery("UPDATE `repair_notice` SET `status`='2' WHERE  `id`='$id'");
}
?>
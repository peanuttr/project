<?php
require "../../config/db.php";
$db = new db();

if(isset($_POST['id'])){
    $id = $_POST['id'];
    $status = $_POST['status'];
    $assets = json_decode($_POST['assets']);


    $stmt = $db->sqlQuery("UPDATE `sells` SET `status`='$status' WHERE  `id`='$id'");
    $stmt->execute();
    if($status == 0){
        foreach( $assets as $res){
            $stmt = $db->sqlQuery("UPDATE `assets` SET `status`='อยู่ในตลัง' WHERE  `id`='$res->id'");
            $stmt->execute();
        }
    }
    if($status == 2){
        foreach( $assets as $res){
            $stmt = $db->sqlQuery("UPDATE `assets` SET `status`='ดำเนินการจำหน่าย' WHERE  `id`='$res->id'");
            $stmt->execute();
        }
    }
    else if($status == 3 ){
        foreach( $assets as $res){
            $stmt = $db->sqlQuery("UPDATE `assets` SET `status`='จำหน่ายสำเร็จ' WHERE  `id`='$res->id'");
            $stmt->execute();
        }
    }
}
?>
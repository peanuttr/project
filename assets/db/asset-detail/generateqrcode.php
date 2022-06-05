<?php
include('../../libs/phpqrcode/qrlib.php');
require "../../config/db.php";
$db = new db();
$_id = $_GET['id'];
// echo $_id;
QRcode::png(
                "http://localhost/project/views/asset-detail/asset-detail.php?id=" . $_id,
                $_SERVER['DOCUMENT_ROOT'] . "/project/assets/qrcode/" . $_id . ".png",
                QR_ECLEVEL_M,
                1
            );
            $stmt = $db->sqlQuery("UPDATE `assets` SET `qr-code`='" . $_id . ".png' WHERE `id` =".$_id);
            $stmt->execute();

            header("location: ../../../../../project/views/asset-detail/asset-management.php");

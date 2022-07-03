<?php
session_start();
require "../../config/db.php";
$db = new db();

if (isset($_POST['submit'])) {
    $assets = array();
    print_r(array_count_values($_POST['assets_id']));
    $dup = array_count_values($_POST['assets_id']);
    $flag = true;
    foreach ($dup as $key => $value) {
        echo $dup[$key];
        if ($dup[$key] > 1) {
            $flag = false;
            echo "<script>alert('ห้ามเลือกครุภัณฑ์ซ้ำ');
            window.location.href='../../../../../project/views/borrow-return/return-asset.php';
            </script>";
            break;
        }
    }
    if ($flag) {
        for ($i = 0; $i < count($_POST['assets_number']); $i++) {
            array_push($assets, ['id' => $_POST['assets_id'][$i], 'assets_number' => $_POST['assets_number'][$i], 'assets_name' => $_POST['assets_name'][$i]]);
        }
    }
    if ($flag) {
        for ($i = 0; $i < count($_POST['assets_number']); $i++) {
            array_push($assets, ['id' => $_POST['assets_id'][$i], 'assets_number' => $_POST['assets_number'][$i], 'assets_name' => $_POST['assets_name'][$i]]);
        }

        $personnelId = $_POST['personnelId'];
        $staffId = $_POST['staffId'];

        foreach ($assets as $resp) {
            $stmt = $db->sqlQuery("UPDATE `detail_borrow_and_return` set `status`='คืนแล้ว', `return_personel_id`='$personnelId', `return_staff_id`='$staffId' WHERE `asset_id`= '" . $resp['id'] . "'");
            $stmt->execute();
            $stmt = $db->sqlQuery("UPDATE `assets` set `status`='อยู่ในคลัง' WHERE `id`='" . $resp['id'] . "'");
            $stmt->execute();
        }
        header("location: ../../../../../project/views/borrow-return/borrow-return-management.php");
    }
}

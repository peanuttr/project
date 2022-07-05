<?php
session_start();
require "../../config/db.php";
$db = new db();

if (isset($_POST['submit'])) {
    $assets = array();
    $returnDate = $_POST['returnDate'];
    $returnDay = substr($returnDate, 0, 2);
    $returnMonth = substr($returnDate, 3, 2);
    $returnYear = substr($returnDate, 6) - 543;
    $newReturnDate = "$returnDay-$returnMonth-$returnYear";
    $newFormatReturnDate = date("Y-m-d", strtotime($newReturnDate));
    $borrowNumber = $_POST['numberBorrow'];
    $borrowId = '';

    $stmt = $db->sqlQuery("SELECT id FROM `borrow_and_return` WHERE `number_borrow` = $borrowNumber");
    $stmt->execute();
    while ($result = $stmt->fetch(PDO::FETCH_ASSOC)) {
        $borrowId = $result['id'];
    }

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
            $stmt = $db->sqlQuery("UPDATE `detail_borrow_and_return` set `status`='คืนแล้ว', `return_personel_id`='$personnelId', `return_staff_id`='$staffId', `return_date`='$newFormatReturnDate' WHERE `asset_id`= '" . $resp['id'] . "' AND `borrow_and_return_id` = '$borrowId'");
            $stmt->execute();
            $stmt = $db->sqlQuery("UPDATE `assets` set `status`='อยู่ในคลัง' WHERE `id`='" . $resp['id'] . "'");
            $stmt->execute();
        }
        header("location: ../../../../../project/views/borrow-return/borrow-return-management.php");
    }
}

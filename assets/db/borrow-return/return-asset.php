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

    $stmt = $db->sqlQuery("SELECT id,number_borrow FROM `borrow_and_return` WHERE `number_borrow` = $borrowNumber");
    $stmt->execute();
    while ($result = $stmt->fetch(PDO::FETCH_ASSOC)) {
        $borrowId = $result['id'];
    }

    $detailId = array();
    $stmt = $db->sqlQuery("SELECT asset_id FROM `detail_borrow_and_return` WHERE `borrow_and_return_id` = $borrowId AND `status` LIKE '%ถูกยืม%'");
    $stmt->execute();
    while ($result = $stmt->fetch(PDO::FETCH_ASSOC)) {
        array_push($detailId,$result['asset_id']);
    }
    $asstVal = array_values($_POST['assets_id']);
    // $$detailId = array_values($detailId);
    print_r($asstVal);
    print_r($detailId);

    $result= array_intersect($asstVal,$detailId);
    print_r($result);

    $isEqu = false;
    if($result){
        // echo "hello world";
        $isEqu = true;
    }else{
        echo "<script>alert('ไม่พบหมายเลขครุภัณฑ์ในรายการ');
        window.location.href='../../../../../project/views/borrow-return/return-asset.php';
        </script>";
    }
    
    $dup = array_count_values($_POST['assets_id']);
    $flag = true;
    foreach ($dup as $key => $value) {
        if ($dup[$key] > 1) {
            $flag = false;
            echo "<script>alert('ห้ามเลือกครุภัณฑ์ซ้ำ');
            window.location.href='../../../../../project/views/borrow-return/return-asset.php';
            </script>";
            break;
        }
    }

    if ($flag && $isEqu) {
        // for ($i = 0; $i < count($_POST['assets_number']); $i++) {
        //     array_push($assets, ['id' => $_POST['assets_id'][$i], 'assets_number' => $_POST['assets_number'][$i], 'assets_name' => $_POST['assets_name'][$i]]);
        // }

        $personnelId = $_POST['personnelId'];
        $staffId = $_POST['staffId'];

        foreach ($asstVal as $key => $val) {
            $stmt = $db->sqlQuery("UPDATE `detail_borrow_and_return` set `status`='คืนแล้ว', `return_personel_id`='$personnelId', `return_staff_id`='$staffId', `return_date`='$newFormatReturnDate' WHERE `asset_id`= '" . $asstVal[$key] . "' AND `borrow_and_return_id` = '$borrowId'");
            $stmt->execute();
            $stmt = $db->sqlQuery("UPDATE `assets` set `status`='อยู่ในคลัง' WHERE `id`='" . $asstVal[$key] . "'");
            $stmt->execute();
        }
         header("location: ../../../../../project/views/borrow-return/borrow-return-management.php");
    }
}

<?php
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
            echo "<script>alert('ห้ามเลือกครุภัณฑ์ซ้ำ')
            javascript:history.back()</script>";
            break;
        }
    }
    if ($flag) {
        for ($i = 0; $i < count($_POST['assets_number']); $i++) {
            array_push($assets, ['id' => $_POST['assets_id'][$i], 'assets_number' => $_POST['assets_number'][$i], 'assets_name' => $_POST['assets_name'][$i]]);
        }
    }
    $detail = $_POST['detail'];
    $personnelId = $_POST['personnelId'];
    $placeId = $_POST['placeId'];
    $staffId = $_POST['staffId'];
    $borrowDate = $_POST['borrowDate'];
    $returnDate = $_POST['returnDate'];
    $borrowDay = substr($borrowDate, 0, 2);
    $borrowMonth = substr($borrowDate, 3, 2);
    $borrowYear = substr($borrowDate, 6) - 543;
    $returnDay = substr($returnDate, 0, 2);
    $returnMonth = substr($returnDate, 3, 2);
    $returnYear = substr($returnDate, 6) - 543;
    $newBorrowDate = "$borrowDay-$borrowMonth-$borrowYear";
    $newReturnDate = "$returnDay-$returnMonth-$returnYear";
    $newFormatBorrowDate = date("Y-m-d", strtotime($newBorrowDate));
    $newFormatReturnDate = date("Y-m-d", strtotime($newReturnDate));
    $currentYear = date("Y") + 543;
    $newCurrentYear = substr($currentYear, 2) . "0";

    $stmt = $db->sqlQuery(("SELECT id FROM `borrow_and_return` ORDER BY `id` DESC LIMIT 1"));
    $stmt->execute();
    $result = $stmt->fetch((PDO::FETCH_ASSOC));
    $newFormatCurrentYear = $newCurrentYear . ($result['id'] + 1);

    if ($flag) {
        if ($borrowDay < $returnDay && $borrowMonth <= $returnMonth && $borrowYear <= $returnYear) {
            $stmt = $db->sqlQuery("INSERT INTO `borrow_and_return`(`number_borrow`, `borrow_date`, `return_date`, `staff_id`, `personel_id`, `detail`, `status`) VALUES ('$newFormatCurrentYear', '$newFormatBorrowDate', '$newFormatReturnDate', '$staffId', '$personnelId', '$detail', 'รออนุมัติ')");

            if ($stmt->execute()) {
                $stmt = $db->sqlQuery("SELECT * FROM `borrow_and_return` ORDER BY `id` DESC LIMIT 1");
                $stmt->execute();
                $res = $stmt->fetch(PDO::FETCH_ASSOC);
                foreach ($assets as $resp) {
                    $stmt = $db->sqlQuery("INSERT INTO `detail_borrow_and_return`(`asset_id`, `borrow_and_return_id`, `place_id`, `status`) VALUES ('" . $resp['id'] . "','" . $res['id'] . "', '$placeId', 'รออนุมัติ')");
                    $stmt->execute();
                    $stmt = $db->sqlQuery("UPDATE `assets` set `place_id`='$placeId', `status`='รออนุมัติการยืม' WHERE `id`='" . $resp['id'] . "'");
                    $stmt->execute();
                }
            }
            // $message = "บันทึกข้อมูลการยืมครุภัณฑ์เรียบร้อย";
            // echo "<script type='text/javascript'>alert('$message');</script>";
            header("location: ../../../../../project/views/borrow-return/borrow-return-management.php");
        } else if ($borrowDay > $returnDay && $borrowMonth < $returnMonth && $borrowYear <= $returnYear) {
            $stmt = $db->sqlQuery("INSERT INTO `borrow_and_return`(`number_borrow`, `borrow_date`, `return_date`, `staff_id`, `personel_id`, `detail`, `status`) VALUES ('$newFormatCurrentYear', '$newFormatBorrowDate', '$newFormatReturnDate', '$staffId', '$personnelId', '$detail', 'รออนุมัติ')");

            if ($stmt->execute()) {
                $stmt = $db->sqlQuery("SELECT * FROM `borrow_and_return` ORDER BY `id` DESC LIMIT 1");
                $stmt->execute();
                $res = $stmt->fetch(PDO::FETCH_ASSOC);
                foreach ($assets as $resp) {
                    $stmt = $db->sqlQuery("INSERT INTO `detail_borrow_and_return`(`asset_id`, `borrow_and_return_id`, `place_id`, `status`) VALUES ('" . $resp['id'] . "','" . $res['id'] . "', '$placeId', 'รออนุมัติ')");
                    $stmt->execute();
                    $stmt = $db->sqlQuery("UPDATE `assets` set `place_id`='$placeId', `status`='รออนุมัติการยืม' WHERE `id`='" . $resp['id'] . "'");
                    $stmt->execute();
                }
                // $message = "บันทึกข้อมูลการยืมครุภัณฑ์เรียบร้อย";
                // echo "<script type='text/javascript'>alert('$message');</script>";
                header("location: ../../../../../project/views/borrow-return/borrow-return-management.php");
            }
        } else if ($borrowDay >= $returnDay && $borrowMonth >= $returnMonth && $borrowYear < $returnYear) {
            $stmt = $db->sqlQuery("INSERT INTO `borrow_and_return`(`number_borrow`, `borrow_date`, `return_date`, `staff_id`, `personel_id`, `detail`, `status`) VALUES ('$newFormatCurrentYear', '$newFormatBorrowDate', '$newFormatReturnDate', '$staffId', '$personnelId', '$detail', 'รออนุมัติ')");

            if ($stmt->execute()) {
                $stmt = $db->sqlQuery("SELECT * FROM `borrow_and_return` ORDER BY `id` DESC LIMIT 1");
                $stmt->execute();
                $res = $stmt->fetch(PDO::FETCH_ASSOC);
                foreach ($assets as $resp) {
                    $stmt = $db->sqlQuery("INSERT INTO `detail_borrow_and_return`(`asset_id`, `borrow_and_return_id`, `place_id`, `status`) VALUES ('" . $resp['id'] . "','" . $res['id'] . "', '$placeId', 'รออนุมัติ')");
                    $stmt->execute();
                    $stmt = $db->sqlQuery("UPDATE `assets` set `place_id`='$placeId', `status`='รออนุมัติการยืม' WHERE `id`='" . $resp['id'] . "'");
                    $stmt->execute();
                }
                // $message = "บันทึกข้อมูลการยืมครุภัณฑ์เรียบร้อย";
                // echo "<script type='text/javascript'>alert('$message');</script>";
                header("location: ../../../../../project/views/borrow-return/borrow-return-management.php");
            }
        } else {
            echo ("<script LANGUAGE='JavaScript'>
    window.alert('วันที่คืนห้ามน้อยกว่าวันที่ยืม');
    window.location.href='../../../../../project/views/borrow-return/borrow-return-add.php';
    </script>");
        }
    }
}

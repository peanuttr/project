<?php
require "../../config/db.php";
$db = new db();

if (isset($_POST['submit'])) {
    $assets = array();
    for ($i = 0; $i < count($_POST['assets_number']); $i++) {
        array_push($assets, ['id' => $_POST['assets_id'][$i], 'assets_number' => $_POST['assets_number'][$i], 'assets_name' => $_POST['assets_name'][$i]]);
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

    $stmt = $db->sqlQuery("INSERT INTO `borrow_and_return`(`borrow_date`, `return_date`, `staff_id`, `personel_id`, `detail`) VALUES ('$newFormatBorrowDate', '$newFormatReturnDate', '$staffId', '$personnelId', '$detail')");

    if ($stmt->execute()) {
        $stmt = $db->sqlQuery("SELECT * FROM `borrow_and_return` ORDER BY `id` DESC LIMIT 1");
        $stmt->execute();
        $res = $stmt->fetch(PDO::FETCH_ASSOC);
        foreach ($assets as $resp) {
            $stmt = $db->sqlQuery("INSERT INTO `detail_borrow_and_return`(`asset_id`, `borrow_and_return_id`, `place_id`, `status`) VALUES ('" . $resp['id'] . "','" . $res['id'] . "', '$placeId', 'ถูกยืม')");
            $stmt->execute();
            $stmt = $db->sqlQuery("UPDATE `assets` set `place_id`='$placeId', `status`='รออนุมัติการยืม' WHERE `id`='". $resp['id'] ."'");
            $stmt->execute();
        }
        header("location: ../../../../../project/views/borrow-return/borrow-return-management.php");
    }
}

// if (is_null($_POST['id'])) {
//     $assetId = $_POST['assets-id'];
//     $detail = $_POST['detail'];
//     $borrowDate = $_POST['borrowDate'];
//     $returnDate = $_POST['returnDate'];
//     $personnelId = $_POST['personnelId'];
//     $placeId = $_POST['placeId'];
//     $staffId = $_POST['staffId'];
//     $borrowId;
//     $newFormatBorrowDate = date("Y-m-d", strtotime($borrowDate));
//     $newFormatReturnDate = date('Y-m-d', strtotime($returnDate));

//     $stmt = $db->sqlQuery("INSERT INTO `borrow_and_return`(`borrow_date`, `return_date`, `staff_id`, `personel_id`) VALUES ('$newFormatBorrowDate', '$newFormatReturnDate', '$staffId', '$personnelId')");

//     if ($stmt->execute()) {
//         $newstmt = $db->sqlQuery("SELECT * FROM borrow_and_return");
//         $newstmt->execute();

//         while ($result = $newstmt->fetch(PDO::FETCH_ASSOC)) {
//             $borrowId = $result['id'];
//         }

//         $stmt2 = $db->sqlQuery("INSERT INTO `detail_borrow_and_return`(`detail`, `borrow_and_return_id`, `place_id`, `asset_id`) VALUES ('$detail', '$borrowId', '$placeId', '$assetId')");
//         if ($stmt2->execute()) {
//             header("location: ../../../../../project/views/borrow-return/borrow-return-management.php");
//         }
//         echo "Hello";
//     }
    // } else {
    //     $_id = $_POST['id'];
    //     $assetmentTypeNameEdit = $_POST['assetmentTypeName'];

    //     $stmt = $db->sqlQuery("UPDATE `assets_types` SET `assets_types_name`= '$assetmentTypeNameEdit' WHERE `id`= '$_id'");
    //     if ($stmt->execute()) {
    //         header("location: ../../../../../project/views/assetments-type/assetments-type-management.php");
    //     }
    // }
// }
<?php
require "../../config/db.php";
$db = new db();

if (is_null($_POST['id'])) {
    $assetId = $_POST['assets-id'];
    $detail = $_POST['detail'];
    $borrowDate = $_POST['borrowDate'];
    $returnDate = $_POST['returnDate'];
    $personnelId = $_POST['personnelId'];
    $placeId = $_POST['placeId'];
    $staffId = $_POST['staffId'];
    $borrowId;
    $newFormatBorrowDate = date("Y-m-d", strtotime($borrowDate));
    $newFormatReturnDate = date('Y-m-d', strtotime($returnDate));

    $stmt = $db->sqlQuery("INSERT INTO `borrow_and_return`(`borrow_date`, `return_date`, `staff_id`, `personel_id`) VALUES ('$newFormatBorrowDate', '$newFormatReturnDate', '$staffId', '$personnelId')");

    if ($stmt->execute()) {
        $newstmt = $db->sqlQuery("SELECT * FROM borrow_and_return");
        $newstmt->execute();
    
        while ($result = $newstmt->fetch(PDO::FETCH_ASSOC)) {
            $borrowId = $result['id'];
        }

        $stmt2 = $db->sqlQuery("INSERT INTO `detail_borrow_and_return`(`detail`, `borrow_and_return_id`, `place_id`, `asset_id`) VALUES ('$detail', '$borrowId', '$placeId', '$assetId')");
        if ($stmt2->execute()) {
            header("location: ../../../../../project/views/borrow-return/borrow-return-management.php");
        }
        echo "Hello";
    }
// } else {
//     $_id = $_POST['id'];
//     $assetmentTypeNameEdit = $_POST['assetmentTypeName'];

//     $stmt = $db->sqlQuery("UPDATE `assets_types` SET `assets_types_name`= '$assetmentTypeNameEdit' WHERE `id`= '$_id'");
//     if ($stmt->execute()) {
//         header("location: ../../../../../project/views/assetments-type/assetments-type-management.php");
//     }
// }
}

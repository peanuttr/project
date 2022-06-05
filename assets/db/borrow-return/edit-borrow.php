<?php
require "../../config/db.php";
$db = new db();

if (isset($_POST['submit'])) {
    $_id = $_POST['id'];
    $assets = array();
    for ($i = 0; $i < count($_POST['assets_number']); $i++) {
        array_push($assets, ['id' => $_POST['assets_id'][$i], 'assets_number' => $_POST['assets_number'][$i], 'assets_name' => $_POST['assets_name'][$i]]);
    }
    $personnelId = $_POST['personnel_id'];
    $staffId = $_POST['staff_id'];
    $placeId = $_POST['place_id'];
    $detail = $_POST['detail'];
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

    $stmt = $db->sqlQuery("UPDATE `borrow_and_return` SET  `borrow_date`='$newFormatBorrowDate', `return_date`='$newFormatReturnDate', `staff_id`='$staffId', `personel_id`='$personnelId', `detail`='$detail' WHERE id = '$_id'");
    if ($stmt->execute()) {
        foreach ($assets as $resp) {
            $stmt = $db->sqlQuery("UPDATE `detail_borrow_and_return` SET `asset_id` = '$resp[id]', `place_id`='$placeId' WHERE  `sell_id`='$_id'");
        }
        header("location: ../../../../../project/views/borrow-return/borrow-return-management.php");
    }
}

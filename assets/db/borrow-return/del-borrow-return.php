<?php
require "../../config/db.php";
$db = new db();

$borrowId;

$newstmt = $db->sqlQuery("SELECT * FROM detail_borrow_and_return");
$newstmt->execute();

while ($result = $newstmt->fetch(PDO::FETCH_ASSOC)) {
    if ($_POST['id'] == $result['id']) {
        $borrowId = $result['borrow_and_return_id'];
    }
}

if (isset($_POST['id'])) {
    $_id = $_POST['id'];

    $stmt = $db->sqlQuery("DELETE FROM detail_borrow_and_return WHERE id = $_id");

    if ($stmt->execute()) {
        $stmt2 = $db->sqlQuery("DELETE FROM borrow_and_return WHERE id = $borrowId");
        if ($stmt2->execute()) {
            header("location: ../../../../../project/views/borrow-return/borrow-return-management.php");
        }
    }
}

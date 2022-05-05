<?php
require "../../config/db.php";
$db = new db();

if (isset($_POST['id'])) {
    $_id = $_POST['id'];

    $stmt = $db->sqlQuery("DELETE FROM detail_borrow_and_return WHERE borrow_and_return_id = $_id");

    if ($stmt->execute()) {
        $stmt = $db->sqlQuery("DELETE FROM borrow_and_return WHERE id = $_id");
        $stmt->execute();
    }
}

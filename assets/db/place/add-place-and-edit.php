<?php
require "../../config/db.php";
$db = new db();
if (is_null($_POST['id'])) {
    $placeName = $_POST['placeName'];

    $stmt = $db->sqlQuery("INSERT INTO `place`(`placename`) VALUES ('$placeName')");
    if ($stmt->execute()) {
        header("location: ../../../../../project/views/place/place-management.php");
    }
} else {
    $_id = $_POST['id'];
    $placeNameEdit = $_POST['placeName'];

    $stmt = $db->sqlQuery("UPDATE `place` SET `placename`= '$placeNameEdit' WHERE `id`= '$_id'");
    if ($stmt->execute()) {
        header("location: ../../../../../project/views/place/place-management.php");
    }
}

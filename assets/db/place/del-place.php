<?php
require "../../config/db.php";
$db = new db();

if (isset($_POST['id'])) {
    $_id = $_POST['id'];
    $stmt = $db->sqlQuery("DELETE FROM place WHERE id = $_id");
    $stmt->execute();
}

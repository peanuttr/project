<?php
require "../../config/db.php";

$db = new db();
$stmt = $db->connect()->prepare("SELECT s.*,d.department_name FROM staffs AS s JOIN department AS d ON d.id = s.department_id");
$stmt->execute();

while($result = $stmt->fetch(PDO::FETCH_ASSOC)){
    
}
<?php
require "../../config/db.php";
$db = new db();
if(isset($_POST['submit'])){
    echo 'Hello';
    if (isset($_FILES['upload'])) {
        $file = $_FILES['upload']['tmp_name'];
        $file_open = fopen($file, "r");
        while (($csv = fgetcsv($file_open, ",")) !== false) {
            $departmentNumber = $csv[0];
            $departmentName = $csv[1];
            echo 'No:'. $departmentNumber." Name:".$departmentName;
            // $stmt = $db->sqlQuery("INSERT INTO `department`(`department_number`,`department_name`) VALUES ('$departmentNumber','$departmentName')");
            // $stmt->execute();
        }
        // header("location: ../../../../../project/views/assetments-type/assetments-type-management.php");
    }
}


<?php
include('../../libs/phpqrcode/qrlib.php');
require "../../config/db.php";
$db = new db();
if (isset($_FILES['upload'])) {
    $file = $_FILES['upload']['tmp_name'];
    $file_open = fopen($file, "r");
    while (($csv = fgetcsv($file_open, ",")) !== false) {
        $facultyNumber = $csv[0];
        $facultyName = $csv[1];
        $dep = $csv[2];
        $money = $csv[4];
        $year_of_budget = $csv[6];
        $assets_number = $csv[7];
        $assets_name = $csv[8];
        $unit = $csv[11];
        $date_admit = $csv[12];
        $value_assets = $csv[13];
        $delivery_number = $csv[17];
        $seller = $csv[20];
        $serial_number = $csv[21];
        $type = $csv[23];
        $newDateAdmit = date("Y-m-d", strtotime($date_admit));

        $stmt = $db->sqlQuery("SELECT * FROM `money_source` WHERE `money_source_number` LIKE '%$money%'");
        $stmt->execute();
        $resmonmey = $stmt->fetch(PDO::FETCH_ASSOC);
        $money_source_id = $resmonmey['id'];

        $stmt = $db->sqlQuery("SELECT * FROM `unit` WHERE `unit_name` LIKE '%$unit%'");
        $stmt->execute();
        $resunit = $stmt->fetch(PDO::FETCH_ASSOC);
        $unit_id = $resunit['id'];

        $stmt = $db->sqlQuery("SELECT * FROM `department` WHERE `department_number` LIKE '%$dep%'");
        $stmt->execute();
        $resdep = $stmt->fetch(PDO::FETCH_ASSOC);
        $department_id = $resdep['id'];

        $stmt = $db->sqlQuery("SELECT * FROM `assets_types` WHERE `assets_types_number` LIKE '%$type%'");
        $stmt->execute();
        $restype = $stmt->fetch(PDO::FETCH_ASSOC);
        $assets_types_id = $restype['id'];

        $stmt = $db->sqlQuery("SELECT * FROM `place` WHERE `placename` LIKE '%อยู่ภายในคณะ%'");
        $stmt->execute();
        $resplace = $stmt->fetch(PDO::FETCH_ASSOC);
        $place_id = $resplace['id'];

        // echo "nofac " . $facultyNumber . " facname " . $facultyName . " dep id " . $department_id . " money id " .  $money_source_id . " yearbud " .  $year_of_budget . " assnumber " . $assets_number . " assname " . $assets_name . " unit " .  $unit_id . " dateadmit" .  $date_admit . " value " . $value_assets . " deliveryno " . $delivery_number . " " .  $seller . " " .  $serial_number . " " .  $type . " <br>";

        // echo "number ยาว ". strlen($facultyNumber);
        // echo "number ยาว ". strlen('30800');

        $stmt = $db->sqlQuery("INSERT INTO `assets`(`faculty_number`,`faculty_name`,`assets_number`, `asset_name`, `year_of_budget`, `value_asset`, `seller_name`, `number_delivery`, `serial_number`, `date_admit`, `assets_types_id`, `unit_id`, `department_id`, `money_source_id`, `status`, `place_id`) 
        VALUES ('30800', 'คณะอุตสาหกรรมเกษตร','$assets_number','$assets_name','$year_of_budget','$value_assets','$seller','$delivery_number','$serial_number','$newDateAdmit','$assets_types_id','$unit_id','$department_id','$money_source_id','รอการแก้ไข','$place_id')");
        // $stmt->execute();
        // if ($stmt) {
        //     header("location: ../../../../../project/views/asset-detail/asset-management.php");
        // }
        if ($stmt->execute()) {
            //   echo "<script type='text/javascript'>alert('$image');</script>";
            $stmt = $db->sqlQuery("SELECT `id` FROM `assets` ORDER BY `id` DESC LIMIT 1");
            $stmt->execute();
            $res = $stmt->fetch(PDO::FETCH_ASSOC);
            $path = "http://localhost/project/views/asset-detail/asset-detail.php?id=" . $res['id'];
            // $path = "https://php-assets.herokuapp.com/views/asset-detail/asset-detail.php?id=" . $res['id'];
            QRcode::png(
                $path,
                $_SERVER['DOCUMENT_ROOT'] . "/project/assets/qrcode/" . $assets_number . ".png",
                QR_ECLEVEL_M,
                1
            );
            $stmt = $db->sqlQuery("UPDATE `assets` SET `qr-code`='" . $assets_number . ".png' WHERE `id` = ".$res['id']);
            $stmt->execute();
            header("location: ../../../../../project/views/asset-detail/asset-management.php");
        }
    }
}
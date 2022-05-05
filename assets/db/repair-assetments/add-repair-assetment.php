<?php
require "../../config/db.php";
$db = new db();

if(isset($_POST['submit'])){
    $assets = array();
    for($i = 0 ; $i < count($_POST['assets_number']); $i++){
        array_push($assets,['id' => $_POST['assets_id'][$i], 'assets_number' => $_POST['assets_number'][$i], 'assets_name' => $_POST['assets_name'][$i]]);
    }
    $date = $_POST['date'];
    $p_id = $_POST['personnel_id'];
    $detail = $_POST['detail'];
    $day = substr($date, 0, 2);
    $month = substr($date, 3, 2);
    $year = substr($date, 6) - 543;
    $newDate = "$day-$month-$year";
    $newFormatDate = date("Y-m-d", strtotime($newDate));
    $image = null;

    if (isset($_FILES['image'])) {
        $target_dir = $_SERVER['DOCUMENT_ROOT'] . "/project/assets/uploads/";
        $target_file = $target_dir . basename($_FILES["image"]["name"]);
        $uploadOk = 1;
        $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));
        $check = getimagesize($_FILES["image"]["tmp_name"]);
        if ($check !== false) {
            echo "File is an image - " . $check["mime"] . ".";
            $uploadOk = 1;
        } else {
            echo "File is not an image.";
            $uploadOk = 0;
        }
        if ($_FILES["image"]["size"] > 500000) {
            echo "Sorry, your file is too large.";
            $uploadOk = 0;
        }
        if ($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg" && $imageFileType != "gif") {
            echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
            $uploadOk = 0;
        }
        if ($uploadOk == 0) {
            echo "Sorry, your file was not uploaded.";
            // if everything is ok, try to upload file
        } else {
            if (@move_uploaded_file($_FILES["image"]["tmp_name"], $target_file)) {
                $image = ($_FILES["image"]["name"]);
                echo "The file " . htmlspecialchars(basename($_FILES["image"]["name"])) . " has been uploaded.";
            } else {
                echo "<br>";
                echo ($target_file);
                echo "<br>";
                echo "Sorry, there was an error uploading your file.";
            }
        }
        
    }

    $stmt = $db->sqlQuery("INSERT INTO `repair_notice`( `detail`, `date_notice`, `status`, `personel_id`,`image`) VALUES ('$detail', '$newFormatDate','1', '$p_id', '$image')");
    if($stmt->execute()){
        $stmt = $db->sqlQuery("SELECT * FROM `repair_notice` ORDER BY `id` DESC LIMIT 1");
        $stmt->execute();
        $res = $stmt->fetch(PDO::FETCH_ASSOC);
        foreach($assets as $resp){
            $stmt = $db->sqlQuery("INSERT INTO `detail_repair_notice`(`asset_id`,`repair_id`) VALUES ('".$resp['id']."','".$res['id']."')");
            $stmt->execute();
            $stmt = $db->sqlQuery("UPDATE `assets` SET `status`='แจ้งซ่อม' WHERE  `id`=".$resp['id']);
            $stmt->execute();
        }
        header("location: ../../../../../project/views/repair-assetments/repair-assetments-manage.php");
    }
}
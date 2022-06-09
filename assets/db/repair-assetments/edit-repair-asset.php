<?php
require "../../config/db.php";
$db = new db();

if (isset($_POST['submit'])) {
    $_id = $_POST['id'];
    $assets = array();
    for ($i = 0; $i < count($_POST['assets_number']); $i++) {
        array_push($assets, ['id' => $_POST['assets_id'][$i], 'assets_number' => $_POST['assets_number'][$i], 'assets_name' => $_POST['assets_name'][$i]]);
    }
    $date = $_POST['date'];
    $p_id = $_POST['personnel_id'];
    $detail = $_POST['detail'];
    $day = substr($date, 0, 2);
    $month = substr($date, 3, 2);
    $year = substr($date, 6) - 543;
    $newDate = "$day-$month-$year";
    $newFormatDate = date("Y-m-d", strtotime($newDate));
    // $repair_by = $_POST['repairBy'];

    // echo $repair_by."<br>";
    // echo $_id."<br>";
    // echo $detail."<br>";
    // echo $p_id."<br>";
    // echo $newFormatDate."<br>";
    if (isset($_FILES['image'])) {
        for ($i = 0; $i < count($_FILES['image']); $i++) {
            $target_dir = $_SERVER['DOCUMENT_ROOT'] . "/project/assets/uploads/";
            $target_file = $target_dir . basename($_FILES["image"]["name"][$i]);
            $uploadOk = 1;
            $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));
            $check = getimagesize($_FILES["image"]["tmp_name"][$i]);
            if ($check !== false) {
                echo "File is an image - " . $check["mime"] . ".";
                $uploadOk = 1;
            } else {
                echo "File is not an image.";
                $uploadOk = 0;
            }
            if ($_FILES["image"]["size"][$i] > 500000) {
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
                if (@move_uploaded_file($_FILES["image"]["tmp_name"][$i], $target_file)) {
                    array_push($image, ['img' => $_FILES["image"]["name"][$i]]);
                    echo "The file " . htmlspecialchars(basename($_FILES["image"]["name"][$i])) . " has been uploaded.";
                } else {
                    echo "<br>";
                    echo ($target_file);
                    echo "<br>";
                    echo "Sorry, there was an error uploading your file.";
                }
            }
        }
    }
    for ($i = 0; $i < count($assets); $i++) {
        array_push($assets[$i], $image[$i]);
    }

    $stmt = $db->sqlQuery("UPDATE `repair_notice` SET `detail` = '$detail', `date_notice` = '$newFormatDate', `status` = '1', `personel_id` = '$p_id' WHERE  `id`='$_id'");
    // $stmt = $db->sqlQuery("UPDATE `repair_notice` SET `detail` = '$detail', `date_notice` = '$newFormatDate', `status` = '1', `personel_id` = '$p_id',`repair_by`='$repair_by' WHERE  `id`='$_id'");
    if ($stmt->execute()) {
        foreach ($assets as $resp) {
            $stmt = $db->sqlQuery("UPDATE `detail_repair_notice` SET `asset_id` = '$resp[id]' , `image`=$resp[0]['img'] WHERE  `repair_id`='$_id'");
        }

        header("location: ../../../../../project/views/repair-assetments/repair-assetments-manage.php");
    }
    // print_r($newFormatDate);
}

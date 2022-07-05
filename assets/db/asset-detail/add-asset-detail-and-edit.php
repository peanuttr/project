<?php
include('../../libs/phpqrcode/qrlib.php');
require "../../config/db.php";
$db = new db();
    if (!isset($_POST['id'])) {
        $assets_number = $_POST['assetNumber'];
        $year_of_budget = $_POST['yearBudget'];
        $name = $_POST['assetName'];
        $detail = $_POST['assetDetail'];
        $date_admit = $_POST['dateAdmit'];
        $value_assets = $_POST['assetValue'];
        $delivery_number = $_POST['deliveryNumber'];
        $seller = $_POST['seller'];
        $serial_number = $_POST['serialNumber'];
        $expiration_date = $_POST['expirationDate'];
        $status = $_POST['status'];
        $department_id = $_POST['departmentId'];
        $money_source_id = $_POST['moneySourceId'];
        $assets_types_id = $_POST['assetTypeId'];
        $placeId = $_POST['placeId'];
        $unit_id = $_POST['unitId'];
        $personnelId = $_POST['personnelId'];
        $staffId = $_POST['staffId'];
        $date_pickup = $_POST['datePickup'];
        $date_delivery = $_POST['dateDelivery'];
        $feature = $_POST['assetFeature'];
        $dayAdmit = substr($date_admit, 0, 2);
        $monthAdmit = substr($date_admit, 3, 2);
        $yearAdmit = substr($date_admit, 6) - 543;
        $dayExpiration = substr($expiration_date, 0, 2);
        $monthExpiration = substr($expiration_date, 3, 2);
        $yearExpiration = substr($expiration_date, 6) - 543;
        $dayPickup = substr($date_pickup, 0, 2);
        $monthPickup = substr($date_pickup, 3, 2);
        $yearPickup = substr($date_pickup, 6) - 543;
        $dayDelivery = substr($date_delivery, 0, 2);
        $monthDelivery = substr($date_delivery, 3, 2);
        $yearDelivery = substr($date_delivery, 6) - 543;
        $newDateDelivery = "$dayDelivery-$monthDelivery-$yearDelivery";
        $newFormatDateDelivery = date("Y-m-d", strtotime($newDateDelivery));
        $newDatePickup = "$dayPickup-$monthPickup-$yearPickup";
        $newFormatDatePickup = date("Y-m-d", strtotime($newDatePickup));
        $newDateAdmit = "$dayAdmit-$monthAdmit-$yearAdmit";
        $newFormatDateAdmit = date("Y-m-d", strtotime($newDateAdmit));
        $newExpirationDate = "$dayExpiration-$monthExpiration-$yearExpiration";
        $newFormatExpirationDate = date("Y-m-d", strtotime($newExpirationDate));
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
        $stmt = $db->sqlQuery("INSERT INTO `assets`(`faculty_number`, `faculty_name`, `assets_number`, `asset_name`, `detail`, `feature`, `year_of_budget`, `value_asset`, 
        `seller_name`, `status`, `number_delivery`, `serial_number`, `date_admit`, `expiration_date`, `date_pickup`, `date_delivery`, `assets_types_id`, `unit_id`, 
        `department_id`, `money_source_id`,`image`, `place_id`, `importer_id`, `exporter_id`) 
        VALUES ('30800', 'คณะอุตสาหกรรมเกษตร', '$assets_number', '$name', '$detail', '$feature', '$year_of_budget', '$value_assets', '$seller', '$status', '$delivery_number', 
        '$serial_number','$newFormatDateAdmit','$newFormatExpirationDate', '$newFormatDatePickup', '$newFormatDateDelivery', '$assets_types_id','$unit_id','$department_id',
        '$money_source_id','$image', '$placeId', '$personnelId', '$staffId')");
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
    } else {
        $_id = $_POST['id'];
        $assets_number = $_POST['assetNumber'];
        $year_of_budget = $_POST['yearBudget'];
        $name = $_POST['assetName'];
        $detail = $_POST['assetDetail'];
        $date_admit = $_POST['dateAdmit'];
        $value_assets = $_POST['assetValue'];
        $delivery_number = $_POST['deliveryNumber'];
        $seller = $_POST['seller'];
        $serial_number = $_POST['serialNumber'];
        $expiration_date = $_POST['expirationDate'];
        $status = $_POST['status'];
        $department_id = $_POST['departmentId'];
        $money_source_id = $_POST['moneySourceId'];
        $assets_types_id = $_POST['assetTypeId'];
        $placeId = $_POST['placeId'];
        $unit_id = $_POST['unitId'];
        $personnelId = $_POST['personnelId'];
        $staffId = $_POST['staffId'];
        $date_pickup = $_POST['datePickup'];
        $date_delivery = $_POST['dateDelivery'];
        $feature = $_POST['assetFeature'];
        $dayAdmit = substr($date_admit, 0, 2);
        $monthAdmit = substr($date_admit, 3, 2);
        $yearAdmit = substr($date_admit, 6) - 543;
        $dayExpiration = substr($expiration_date, 0, 2);
        $monthExpiration = substr($expiration_date, 3, 2);
        $yearExpiration = substr($expiration_date, 6) - 543;
        $dayPickup = substr($date_pickup, 0, 2);
        $monthPickup = substr($date_pickup, 3, 2);
        $yearPickup = substr($date_pickup, 6) - 543;
        $dayDelivery = substr($date_delivery, 0, 2);
        $monthDelivery = substr($date_delivery, 3, 2);
        $yearDelivery = substr($date_delivery, 6) - 543;
        $newDateDelivery = "$dayDelivery-$monthDelivery-$yearDelivery";
        $newFormatDateDelivery = date("Y-m-d", strtotime($newDateDelivery));
        $newDatePickup = "$dayPickup-$monthPickup-$yearPickup";
        $newFormatDatePickup = date("Y-m-d", strtotime($newDatePickup));
        $newDateAdmit = "$dayAdmit-$monthAdmit-$yearAdmit";
        $newFormatDateAdmit = date("Y-m-d", strtotime($newDateAdmit));
        $newExpirationDate = "$dayExpiration-$monthExpiration-$yearExpiration";
        $newFormatExpirationDate = date("Y-m-d", strtotime($newExpirationDate));
        $image = null;

        if (isset($_FILES['image'])) {
            $target_dir = $_SERVER['DOCUMENT_ROOT'] . "/project/assets/uploads/";
            $target_file = $target_dir . basename($_FILES["image"]["name"]);
            $uploadOk = 1;
            $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));
            $check = @getimagesize($_FILES["image"]["tmp_name"]);
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
                $stmt = $db->sqlQuery("SELECT * FROM `assets` WHERE id = $_id");
                $stmt->execute();
                $res = $stmt->fetch(PDO::FETCH_ASSOC);
                $image = $res['image'];
            } else {
                if (@move_uploaded_file($_FILES["image"]["tmp_name"], $target_file)) {
                    $image = ($_FILES["image"]["name"]);
                    echo "The file " . htmlspecialchars(basename($_FILES["image"]["name"])) . " has been uploaded.";
                } else {
                    echo "Sorry, there was an error uploading your file.";
                }
            }
        } 

        $stmt = $db->sqlQuery("UPDATE `assets` SET `assets_number`='$assets_number',`asset_name`='$name',`detail`='$detail',`feature`='$feature',`year_of_budget`='$year_of_budget',
        `value_asset`='$value_assets',`seller_name`='$seller',`status`='$status',`number_delivery`='$delivery_number',`serial_number`='$serial_number',
        `date_admit`='$newFormatDateAdmit',`expiration_date`='$newFormatExpirationDate',`date_pickup`='$newFormatDatePickup',`date_delivery`='$newFormatDateDelivery',`place_id`='$placeId',`assets_types_id`='$assets_types_id',`unit_id`='$unit_id',
        `department_id`='$department_id',`money_source_id`='$money_source_id',`image` ='$image',`exporter_id`='$personnelId',`importer_id`='$staffId'  WHERE `id` = '$_id'");
        if ($stmt->execute()) {
            header("location: ../../../../../project/views/asset-detail/asset-management.php");
        }
    }

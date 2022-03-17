<?php
require "../../config/db.php";
$db = new db();
if (is_null($_POST['id'])) {
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
    $unit_id = $_POST['unitId'];

    if (isset($_FILES['image'])) {
        $target_dir = "../../../assets/uploads";
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
        if ($_FILES["fileToUpload"]["size"] > 500000) {
            echo "Sorry, your file is too large.";
            $uploadOk = 0;
        }
        if ($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg" && $imageFileType != "gif") {
            echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
            $uploadOk = 0;
        }
        if ($uploadOk == 0) {
            echo "Sorry, your file was not uploaded.";
        } else {
            if (move_uploaded_file($_FILES["image"]["tmp_name"], $target_file)) {
                $image = $target_file;
                echo "The file " . htmlspecialchars(basename($_FILES["image"]["name"])) . " has been uploaded.";
            } else {
                echo "Sorry, there was an error uploading your file.";
            }
        }
    }

    

    $stmt = $db->sqlQuery("INSERT INTO `assets`(`assets_number`, `asset_name`, `detail`, `year_of_budget`, `value_asset`, `seller_name`, `status`, `number_delivery`, `serial_number`, `date_admit`, `expiration_date`, `assets_types_id`, `unit_id`, `department_id`, `money_source_id`,`image`) 
    VALUES ('$assets_number','$name','$detail','$year_of_budget','$value_assets','$seller','$status','$delivery_number','$serial_number','$date_admit','$expiration_date','$assets_types_id','$unit_id','$department_id','$money_source_id','$image')");
    if ($stmt->execute()) {
      echo "<script type='text/javascript'>alert('$image');</script>";
       // header("location: ../../../../../project/views/asset-detail/asset-management.php");
    }
} else {
  $_id = $_POST['id'];
  $assets_number = $_POST['assets_number'];
  $year_of_budget = $_POST['year_of_budget'];
  $name = $_POST['name'];
  $detail = $_POST['detail'];
  $date_admit = $_POST['date_admit'];
  $value_assets = $_POST['value_assets'];
  $delivery_number = $_POST['delivery_number'];
  $seller = $_POST['seller'];
  $serial_number = $_POST['serial_number'];
  $expiration_date = $_POST['expiration_date'];
  $status = $_POST['status'];
  $department_id = $_POST['department_id'];
  $money_source_id = $_POST['money_source_id'];
  $assets_types_id = $_POST['assets_types_id'];
  $unit_id = $_POST['unit_id'];
  $image;

  if (isset($_FILES['image'])) {
      $target_dir = "../../../assets/uploads";
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
      if ($_FILES["fileToUpload"]["size"] > 500000) {
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
          if (move_uploaded_file($_FILES["image"]["tmp_name"], $target_file)) {
              $image = $target_file;
              echo "The file " . htmlspecialchars(basename($_FILES["image"]["name"])) . " has been uploaded.";
          } else {
              echo "Sorry, there was an error uploading your file.";
          }
      }
  }

  $stmt = $db->sqlQuery("UPDATE `assets` SET `assets_number`='$assets_number',`asset_name`='$name',`detail`='$detail',`year_of_budget`='$year_of_budget',`value_asset`='$value_assets',`seller_name`='$seller',`status`='$status',`number_delivery`='$delivery_number',`serial_number`='$serial_number',`date_admit`='$date_admit',`expiration_date`='$expiration_date',`assets_types_id`='$assets_types_id',`unit_id`='$unit_id',`department_id`='$department_id',`money_source_id`='$money_source_id',`image` ='$image'  WHERE `id` = '$_id'");
  if ($stmt->execute()) {
      header("location: ../../../../../project/views/asset-detail/asset-management.php");
  }
}

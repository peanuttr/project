<?php
include_once "../layout/masterpage.php";
require "../../assets/config/db.php";
$db = new db();
?>
<div class="home-section">
    <div class="home-content">
        <h1 style="padding-top: 1%;">เพิ่มข้อมูลสถานที่</h1>
        <a class='button-17' href="./place-add-csv.php"> <span>เพิ่่มข้อมูลจาก csv</span> </a>
        <form method="post" action="../../assets/db/place/add-place-and-edit.php">
            <div class='row flex justify-content-center'>
                <div class='col-6 width-50 flex justify-center'>
                    <label>ชื่อสถานที่</label>
                    <input type='text' name='placeName' class='form-control' placeholder='ชื่อสถานที่' required>
                </div>
            </div>
            <div class='row flex justify-content-center mt-2' style="padding-top: 20px">
                <div class='col-1 d-flex justify-content-start'>
                    <a class='btn btn-sm btn-danger' href="javascript:history.back()"> <span>กลับ</span> </a>
                </div>
                <div class='col-1 d-flex justity-content-end'>
                    <input type='submit' class='btn btn-sm btn-success' name='submit' value='บันทึก' required>
                </div>
            </div>
        </form>
    </div>
</div>
<?php
include_once "../layout/masterpage.php";
require "../../assets/config/db.php";
$db = new db();
?>
<div class="home-section">
    <div class="home-content">
        <h1 style="padding-top: 1%;">เพิ่มข้อมูลหน่วยนับ</h1>
        <a class='button-17'> <span>เพิ่่มข้อมูลจาก csv</span> </a>
        <form method="post" action="../../assets/db/unit/add-unit-and-edit.php" enctype="multipart/form-data">
            <div class='row flex justify-content-center'>
                <div class='col-6 width-50 flex justify-center'>
                    <label>ชื่อหน่วยนับ</label>
                    <input type='text' name='unitName' class='form-control' placeholder='ชื่อหน่วยนับ' required>
                </div>
            </div>
            <!-- <div class="row flex justify-content-center">
                <div class="col-5 width-50 flex justify-center">
                    <label for="">upload csv</label>
                    <input type="file" name="upload" id="upload">
                </div>
            </div> -->
            <div class='row flex justify-content-center mt-2' style="padding-top: 20px">
                <div class='col-1 d-flex justify-content-start'>
                    <a class='btn btn-sm btn-danger' href="javascript:history.back()"> <span>กลับ</span> </a>
                </div>
                <div class='col-1 d-flex justity-content-end'>
                    <input type='submit' class='btn btn-sm btn-success' name='submit' value='บันทึก' >
                </div>
            </div>
        </form>
    </div>
</div>
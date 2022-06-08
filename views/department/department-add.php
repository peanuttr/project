<?php
include_once "../layout/masterpage.php";
require "../../assets/config/db.php";
$db = new db();
?>
<div class="home-section">
    <div class="home-content">
        <h1 style="padding-top: 1%;">เพิ่มข้อมูลหน่วยงาน</h1>
        <form method="post" action="../../assets/db/department/add-department-and-edit.php">
            <div class='row flex justify-content-center'>
                <div class='col-6 width-50 flex justify-center'>
                    <label>รหัสหน่วยงาน</label>
                    <input type='text' name='departmentNumber' class='form-control' placeholder='รหัสหน่วยงาน' required>
                </div>
            </div>
            <div class='row flex justify-content-center'>
                <div class='col-6 width-50 flex justify-center'>
                    <label style="padding-top: 1%;">ชื่อหน่วยงาน</label>
                    <input type='text' name='departmentName' class='form-control' placeholder='ชื่อหน่วยงาน' required>
                </div>
            </div>
            <div class='row flex justify-content-center mt-2' style="padding-top: 20px">
                <div class='col-1 d-flex justify-content-start'>
                    <a class='btn btn-sm btn-danger' href="javascript:history.back()"> <span>กลับ</span> </a>
                </div>
                <div class='col-1 d-flex justity-content-end'>
                    <input type='submit' class='btn btn-sm btn-success' name='submit' value='บันทึก'>
                </div>
            </div>
        </form>
    </div>

</div>
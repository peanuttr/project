<?php
include_once "../layout/masterpage.php";
require "../../assets/config/db.php";
$db = new db();
?>
<div class="home-section">
    <div class="home-content">
    <h1>เพิ่มหน่วยงาน</h1>
    <form method="post" action="../../assets/db/department/add-department-and-edit.php">
        <div class='row' style='margin: 10px 0 10px 39rem; width:50%;'>
            <div class='col-md-6'>
                <label>ชื่อหน่วยงาน</label>
                <input type='text' name='departmentName' class='form-control' placeholder='ชื่อหน่วยงาน'>
            </div>
        </div>
        <div class='row flex justify-content-center mt-2'>
            <div class='col-1 d-flex justify-content-start' >
                <a class='btn btn-sm btn-danger' href="javascript:history.back()"> <span>กลับ</span> </a>
            </div>
            <div class='col-1 d-flex justity-content-end' >
                <input type='submit' class='btn btn-sm btn-success' name='submit' value='บันทึก'>
            </div>
        </div>
    </form>
    </div>
    
</div>
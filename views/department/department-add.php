<?php
include_once "../layout/masterpage.php";
require "../../assets/config/db.php";
$db = new db();
?>
<div class="home-section">
    <br>
    <h1>เพิ่มหน่วยงาน</h1>
    <form method="post" action="../../assets/db/department/add-department-and-edit.php">
        <div class='row' style='margin: 10px 0 10px 39rem; width:50%;'>
            <div class='col-md-6'>
                <label>ชื่อหน่วยงาน</label>
                <input type='text' name='departmentName' class='form-control' placeholder='ชื่อหน่วยงาน'>
            </div>
        </div>
        <div class='row' style='margin: 10px 0 10px 20rem; width:50%;'>
            <div class='col' style='margin-left: 42%;'>
                <input type='submit' class='btn btn-sm btn-success' name='submit' value='บันทึก'>
            </div>
            <div class='col' style='margin-right: 37%;'>
                <a class='btn btn-sm btn-danger' href="javascript:history.back()"> <span>กลับ</span> </a>
            </div>
        </div>
    </form>
</div>
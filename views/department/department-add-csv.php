<?php
include_once "../layout/masterpage.php";
require "../../assets/config/db.php";
$db = new db();
?>
<div class="home-section">
    <div class="home-content">
        <h1 style="padding-top: 1%;">เพิ่มข้อมูลหน่วยงาน</h1>
        <form method="post" action="../../assets/db/department/add-department-csv.php"  enctype="multipart/form-data">
        <div class="row flex justify-content-center">
                    <div class="col-5 width-50 d-flex justify-content-end">
                        <label for="">upload csv</label>
                    </div>
                    <div class="col-5 width-50 d-flex justify-content-start">

                        <input type="file" name="upload" id="upload">
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
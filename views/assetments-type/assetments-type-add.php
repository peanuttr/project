<?php
include_once "../layout/masterpage.php";
require "../../assets/config/db.php";
$db = new db();
?>
<div class="home-section">
    <div class="home-content">
        <h1>เพิ่มประเภทครุภัณฑ์</h1>
        <form method="post" action="../../assets/db/assetment-type/add-assetment-type-and-edit.php">
            <div class="container">
                <div class='row flex justify-content-center' style=''>
                    <div class='col-6 width-50 flex justify-center'>
                        <label>ชื่อประเภทครุภัณฑ์</label>
                        <input type='text' name='assetmentTypeName' class='form-control' placeholder='ชื่อประเภทครุภัณฑ์'>
                    </div>
                </div>
                <div class='row flex justify-content-center mt-2'>
                    <div class='col-1 d-flex justify-content-start'>
                        <a class='btn btn-sm btn-danger' href="javascript:history.back()"> <span>กลับ</span> </a>
                    </div>
                    <div class='col-1 d-flex justity-content-end'>
                        <input type='submit' class='btn btn-sm btn-success' name='submit' value='บันทึก'>
                    </div>
                </div>
            </div>
        </form>
    </div>

</div>
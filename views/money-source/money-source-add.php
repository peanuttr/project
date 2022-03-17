<?php
include_once "../layout/masterpage.php";
require "../../assets/config/db.php";
$db = new db();
?>
<div class="home-section">
    <div class="home-content">
        <h1>เพิ่มแหล่งเงิน</h1>
        <form method="post" action="../../assets/db/money-source/add-money-source-and-edit.php">
            <div class="container">
                <div class='row flex justify-content-center' style=''>
                    <div class='col-6 width-50 flex justify-center'>
                        <label>ชื่อแหล่งเงิน</label>
                        <input type='text' name='moneySourceName' class='form-control' placeholder='ชื่อแหล่งเงิน'>
                    </div>
                </div>
                <div class='row flex justify-content-center mt-2'>
                    <div class='col-1 d-flex justify-content-start' style=''>
                        <a class='btn btn-sm btn-danger' href="javascript:history.back()"> <span>กลับ</span> </a>
                    </div>
                    <div class='col-1 d-flex justity-content-end' style=''>
                        <input type='submit' class='btn btn-sm btn-success' name='submit' value='บันทึก'>
                    </div>
                </div>
            </div>
        </form>
    </div>

</div>
<?php
include_once "./masterpage.php";
?>
<div class="home-section">
    <h1>เพิ่มผู้ใช้งาน</h1>
    <form method="post" action="../assets/includes/adduser.php">
        <div class='row' style='margin: 10px 0 10px 39rem; width:50%;'>
            <div class='col-md-6'>
                <label>ชื่อผู้ใช้งาน</label>
                <input type='text' name='username' class='form-control' placeholder='ชื่อผู้ใช้งาน'>
            </div>
        </div>
        <div class='row' style='margin: 10px 0 10px 39rem; width:50%;'>
            <div class='col-md-6'>
                <label>รหัสผ่าน</label>
                <input type='password' name='password' class='form-control' placeholder='รหัสผ่าน'>
            </div>
        </div>
        <div class='row' style='margin: 10px 0 10px 39rem; width:50%;'>
            <div class='col-md-6'>
                <label>ชื่อ</label>
                <input type='text' name='fisrtname' class='form-control' placeholder='ชื่อ'>
            </div>
        </div>
        <div class='row' style='margin: 10px 0 10px 39rem; width:50%;'>
            <div class='col-md-6'>
                <label>นามสกุล</label>
                <input type='text' name='lastname' class='form-control' placeholder='นามสกุล'>
            </div>
        </div>
        <div class='row' style='margin: 10px 0 10px 39rem; width:50%;'>
            <div class='col-md-6'>
                <label>เบอร์มือถือ</label>
                <input type='text' name='telephone' class='form-control' placeholder='เบอร์มือถือ'>
            </div>

        </div>
        <div class='row' style='margin: 10px 0 10px 39rem; width:50%;'>
            <div class='col-md-6'>
                <label>อีเมล์</label>
                <input type='text' name='email' class='form-control' placeholder='E-Mail'>
            </div>
        </div>
        <div class='row' style='margin: 10px 0 10px 39rem; width:50%;'>
            <div class='col-md-6'>
                <label>สิทธิ์การใช้งาน</label>
                <select class='form-select' name='permission'>
                    <option selected>เลือก Role </option>
                    <option value='staff'>เจ้าหน้าที่</option>
                    <option value='ceo'>ผู้บริหาร</option>
                </select>
            </div>

        </div>
        <div class='row' style='margin: 10px 0 10px 39rem; width:50%;'>
            <div class='col-md-6'>
                <label>หน่วยงาน</label>
                <div id="dep">

                </div>
            </div>
        </div>
        <div class='row' style='margin: 10px 0 10px 20rem; width:50%;'>
            <div class='col' style='margin-left: 42%;'>
                <input type='submit' class='btn btn-sm btn-success' name='submit' value='บันทึก'>
            </div>
            <div class='col' style='margin-right: 37%;'>
                <a class='btn btn-sm btn-danger'> <span>กลับ</span> </a>
            </div>
        </div>
    </form>
</div>
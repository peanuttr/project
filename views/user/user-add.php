<?php
include_once "../layout/masterpage.php";
require "../../assets/config/db.php";
$db = new db();
?>
<div class="home-section">
    <div class="home-content">
        <h1 style="padding-top: 1%;">เพิ่มข้อมูลเจ้าหน้าที่</h1>
        <form method="post" action="../../assets/db/user/add-user-and-edit.php">
        <div class='row flex justify-content-center' style='margin-bottom: 5px'>
                <div class='col-6 width-50 flex justify-center'>
                    <label>ชื่อผู้ใช้งาน</label>
                    <input type='text' name='username' class='form-control' placeholder='ชื่อผู้ใช้งาน'>
                </div>
            </div>
            <div class='row flex justify-content-center' style='margin-bottom: 5px'>
                <div class='col-6 width-50 flex justify-center'>
                    <label>รหัสผ่าน</label>
                    <input type='password' name='password' class='form-control' placeholder='รหัสผ่าน'>
                </div>
            </div>
            <div class='row flex justify-content-center' style='margin-bottom: 5px'>
                <div class='col-6 width-50 flex justify-center'>
                    <label>ยืนยันรหัสผ่าน</label>
                    <input type='password' name='confirmPassword' class='form-control' placeholder='รหัสผ่าน'>
                </div>
            </div>
            <div class='row flex justify-content-center' style='margin-bottom: 5px'>
                <div class='col-6 width-50 flex justify-center'>
                    <label>ชื่อ</label>
                    <input type='text' name='fisrtname' class='form-control' placeholder='ชื่อ'>
                </div>
            </div>
            <div class='row flex justify-content-center' style='margin-bottom: 5px'>
                <div class='col-6 width-50 flex justify-center'>
                    <label>นามสกุล</label>
                    <input type='text' name='lastname' class='form-control' placeholder='นามสกุล'>
                </div>
            </div>
            <div class='row flex justify-content-center' style='margin-bottom: 5px'>
                <div class='col-6 width-50 flex justify-center'>
                    <label>เบอร์มือถือ</label>
                    <input type='text' name='telephone' class='form-control' placeholder='เบอร์มือถือ'>
                </div>

            </div>
            <div class='row flex justify-content-center' style='margin-bottom: 5px'>
                <div class='col-6 width-50 flex justify-center'>
                    <label>อีเมล์</label>
                    <input type='text' name='email' class='form-control' placeholder='E-Mail'>
                </div>
            </div>
            <div class='row flex justify-content-center' style='margin-bottom: 5px'>
                <div class='col-6 width-50 flex justify-center'>
                    <label>สิทธิ์การใช้งาน</label>
                    <select class='form-control' name='permission'>
                        <option selected>เลือก Role </option>
                        <option value='staff'>เจ้าหน้าที่</option>
                        <option value='ceo'>ผู้บริหาร</option>
                    </select>
                </div>

            </div>
            <div class='row flex justify-content-center' style='margin-bottom: 5px'>
                <div class='col-6 width-50 flex justify-center'>
                    <label>หน่วยงาน</label>
                    <?php
                    $stmt = $db->sqlQuery("SELECT * FROM department");
                    $stmt->execute();
                    $output = " ";
                    $output .= "<select class='form-control' name='department_id'>";
                    $output .= "<option selected>เลือก หน่วยงาน </option>";
                    while ($result = $stmt->fetch(PDO::FETCH_ASSOC)) {
                        $depId = $result['id'];
                        $depName = $result['department_name'];
                        $output .= "<option value='$depId'>$depName</option>";
                    }
                    $output .= "</select>";
                    echo $output;
                    ?>
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
        </form>
    </div>
</div>
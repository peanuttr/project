<?php
include_once "../layout/masterpage.php";
require "../../assets/config/db.php";
$db = new db();
?>
<div class="home-section">
    <h1>เพิ่มครุภัณฑ์</h1>
    <form method="post" action="../../assets/db/personnel/add-personnel-and-edit.php">
        <div class='row' style='margin: 10px 0 10px 39rem; width:50%;'>
            <div class='col-md-6'>
                <label>เลขครุภัณฑ์</label>
                <input type='text' name='assets_number' class='form-control' placeholder='ชื่อ'>
            </div>
        </div>
        <div class='row' style='margin: 10px 0 10px 39rem; width:50%;'>
            <div class='col-md-6'>
                <label>ชื่อครุภัณฑ์</label>
                <input type='text' name='lastname' class='form-control' placeholder='นามสกุล'>
            </div>
        </div>
        <div class='row' style='margin: 10px 0 10px 39rem; width:50%;'>
            <div class='col-md-6'>
                <label>รายละเอียด</label>
                <input type='text' name='telephone' class='form-control' placeholder='เบอร์มือถือ'>
            </div>

        </div>
        <div class='row' style='margin: 10px 0 10px 39rem; width:50%;'>
            <div class='col-md-6'>
                <label>ปีงบประมาณ</label>
                <input type='text' name='email' class='form-control' placeholder='E-Mail'>
            </div>
        </div>
        <div class='row' style='margin: 10px 0 10px 39rem; width:50%;'>
            <div class='col-md-6'>
                <label>สถานะ</label>
                <select class='form-select' name='status'>
                    <option selected>เลือก Role </option>
                    <option value='working'>ทำงานอยู่</option>
                    <option value='resign'>ลาออก</option>
                </select>
            </div>
        </div>
        <div class='row' style='margin: 10px 0 10px 39rem; width:50%;'>
            <div class='col-md-6'>
                <label>หน่วยงาน</label>
                <?php
                $stmt = $db->connect()->prepare("SELECT * FROM department");
                $stmt->execute();
                $output = " ";
                $output .= "<select class='form-select' name='department_id'>";
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
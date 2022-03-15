<?php
include_once "../layout/masterpage.php";
require "../../assets/config/db.php";
$db = new db();
?>
<div class="home-section">
    <div class="home-content">
        <h1>เพิ่มบุคลากร</h1>
        <form method="post" action="../../assets/db/personnel/add-personnel-and-edit.php">
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
                    <label>สถานะ</label>
                    <select class='form-select' name='status'>
                        <option selected>เลือก Role </option>
                        <option value='ทำงานอยู่'>ทำงานอยู่</option>
                        <option value='ลาออก'>ลาออก</option>
                    </select>
                </div>
            </div>
            <div class='row' style='margin: 10px 0 10px 39rem; width:50%;'>
                <div class='col-md-6'>
                    <label>หน่วยงาน</label>
                    <?php
                    $stmt = $db->sqlQuery("SELECT * FROM department");
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
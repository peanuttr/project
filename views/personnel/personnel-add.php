<?php
include_once "../layout/masterpage.php";
require "../../assets/config/db.php";
$db = new db();
?>
<div class="home-section">
    <div class="home-content">
        <h1 style="padding-top: 1%;">เพิ่มข้อมูลบุคลากร</h1>
        <a class='button-17' href="./personel-add-csv.php"> <span>เพิ่่มข้อมูลจาก csv</span> </a>

        <form method="post" action="../../assets/db/personnel/add-personnel-and-edit.php" enctype="multipart/form-data">
            <div class='row flex justify-content-center' style='margin-bottom: 5px'>
                <div class='col-6 width-50 flex justify-center'>
                    <label>ชื่อ</label>
                    <input type='text' name='fisrtname' class='form-control' placeholder='ชื่อ' required>
                </div>
            </div>
            <div class='row flex justify-content-center' style='margin-bottom: 5px'>
                <div class='col-6 width-50 flex justify-center'>
                    <label>นามสกุล</label>
                    <input type='text' name='lastname' class='form-control' placeholder='นามสกุล' required>
                </div>
            </div>
            <div class='row flex justify-content-center' style='margin-bottom: 5px'>
                <div class='col-6 width-50 flex justify-center'>
                    <label>ตำแหน่ง</label>
                    <input type='text' name='jobTitle' class='form-control' placeholder='ตำแหน่ง' required>
                </div>
            </div>
            <div class='row flex justify-content-center' style='margin-bottom: 5px'>
                <div class='col-6 width-50 flex justify-center'>
                    <label>เบอร์โทรศัพท์</label>
                    <input type='text' name='telephone' class='form-control' placeholder='เบอร์โทรศัพท์' required>
                </div>
            </div>
            <div class='row flex justify-content-center' style='margin-bottom: 5px'>
                <div class='col-6 width-50 flex justify-center'>
                    <label>เบอร์โทรติดต่อภายใน</label>
                    <input type='text' name='extensionNumber' class='form-control' placeholder='เบอร์โทรติดต่อภายใน' required>
                </div>
            </div>
            <div class='row flex justify-content-center' style='margin-bottom: 10px'>
                <div class='col-6 width-50 flex justify-center'>
                    <label>อีเมล์</label>
                    <input type='text' name='email' class='form-control' placeholder='E-Mail' required>
                </div>
            </div>
            <div class='row flex justify-content-center' style='margin-bottom: 10px'>
                <div class='col-6 width-50 flex justify-center'>
                    <label>สถานะ</label>
                    <select class='form-control' name='status'>
                        <option selected>เลือก Role </option>
                        <option value='ทำงานอยู่'>ทำงานอยู่</option>
                        <option value='ลาออก'>ลาออก</option>
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
                    $output .= "<select class='form-control' name='departmentId'>";
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
            <!-- <div class="row flex justify-content-center">
                <div class="col-5 width-50 flex justify-center">
                    <label for="">upload csv</label>
                    <input type="file" name="upload" id="upload">
                </div>
            </div> -->
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
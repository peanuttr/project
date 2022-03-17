<?php
include_once "../layout/masterpage.php";
require "../../assets/config/db.php";
$db = new db();
?>
<div class="home-section">
    <div class="home-content">
        <h1>เพิ่มครุภัณฑ์</h1>
        <form method="post" action="../../assets/db/asset-detail/add-asset-detail-and-edit.php">
            <div class="form-insert-asset">
                <div class='row flex justify-content-center'>
                    <div class='col-6 width-50 flex justify-center'>
                        <label>เลขครุภัณฑ์</label>
                        <input type='text' name='assetNumber' class='form-control' placeholder='เลขครุภัณฑ์'>
                    </div>
                    <div class='col-6 width-50 flex justify-center'>
                        <label>ชื่อครุภัณฑ์</label>
                        <input type='text' name='assetName' class='form-control' placeholder='ชื่อครุภัณฑ์'>
                    </div>
                </div>
                <div class='row flex justify-content-center'>
                    <div class='col-6 width-50 flex justify-center'>
                        <label>รายละเอียด</label>
                        <input type='text' name='assetDetail' class='form-control' placeholder='รายละเอียด'>
                    </div>
                    <div class='col-6 width-50 flex justify-center'>
                        <label>วันที่เข้ารับ</label>
                        <input type="date" name="dateAdmit" id="startdate" class="form-control" placeholder="dd-mm-yyyy">
                    </div>
                </div>
                <div class='row flex justify-content-center'>
                    <div class='col-6 width-50 flex justify-center'>
                        <label>มูลค่าครุภัณฑ์</label>
                        <input type="text" name="assetValue" class="form-control" placeholder="มูลค่าครุภัณฑ์">
                    </div>
                    <div class='col-6 width-50 flex justify-center'>
                        <label>เลขที่ใบส่งของ</label>
                        <input type="text" name="deliveryNumber" class="form-control" placeholder="เลขที่ใบส่งของ">
                    </div>
                </div>
                <div class='row flex justify-content-center'>
                    <div class='col-6 width-50 flex justify-center'>
                        <label>ผู้ขาย</label>
                        <input type="text" name="seller" class="form-control" placeholder="ผู้ขาย">
                    </div>
                    <div class='col-6 width-50 flex justify-center'>
                        <label>หมายเลขซีเรียล</label>
                        <input type="text" name="serialNumber" class="form-control" placeholder="หมายเลขซีเรียล">
                    </div>
                </div>
                <div class='row flex justify-content-center'>
                    <div class='col-6 width-50 flex justify-center'>
                        <label>วันหมดประกัน</label>
                        <input type="date" name="expirationDate" class="form-control" placeholder="วันหมดประกัน">
                    </div>
                    <div class='col-6 width-50 flex justify-center'>
                        <label>ที่อยู่</label>
                        <input type="text" name="address" class="form-control" placeholder="ที่อยู่">
                    </div>
                </div>
                <div class='row flex justify-content-center'>
                    <div class='col-6 width-50 flex justify-center'>
                        <label>แหล่งเงิน</label>
                        <?php
                        $stmt = $db->sqlQuery("SELECT * FROM money_source");
                        $stmt->execute();
                        $output = " ";
                        $output .= "<select class='form-control' name='moneySourceId'>";
                        $output .= "<option selected> เลือกแหล่งเงิน </option>";
                        while ($result = $stmt->fetch(PDO::FETCH_ASSOC)) {
                            $moneySourceId = $result['id'];
                            $moneySourceName = $result['money_source_name'];
                            $output .= "<option value='$moneySourceId'>$moneySourceName</option>";
                        }
                        $output .= "</select>";
                        echo $output;
                        ?>
                    </div>
                    <div class='col-6 width-50 flex justify-center'>
                        <label>หน่วยงาน</label>
                        <?php
                        $stmt = $db->sqlQuery("SELECT * FROM department");
                        $stmt->execute();
                        $output = " ";
                        $output .= "<select class='form-control' name='departmentId'>";
                        $output .= "<option selected>เลือกหน่วยงาน </option>";
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
                <div class='row flex justify-content-center'>
                    <div class='col-6 width-50 flex justify-center'>
                        <label>สถานะ</label>
                        <select class='form-control' name='yearBudget'>
                            <option selected>เลือกปีงบประมาณ </option>
                            <option value='2560'>2560</option>
                            <option value='2561'>2561</option>
                            <option value='2562'>2562</option>
                            <option value='2563'>2563</option>
                            <option value='2564'>2564</option>
                            <option value='2565'>2565</option>
                            <option value='2565'>2566</option>
                            <option value='2565'>2567</option>
                            <option value='2565'>2568</option>
                        </select>
                    </div>
                    <div class='col-6 width-50 flex justify-center'>
                        <label>ประเภทครุภัณฑ์</label>
                        <?php
                        $stmt = $db->sqlQuery("SELECT * FROM assets_types");
                        $stmt->execute();
                        $output = " ";
                        $output .= "<select class='form-control' name='assetTypeId'>";
                        $output .= "<option selected>เลือกประเภทครุภัณฑ์ </option>";
                        while ($result = $stmt->fetch(PDO::FETCH_ASSOC)) {
                            $assetTypeId = $result['id'];
                            $assetTypeName = $result['assets_types_name'];
                            $output .= "<option value='$assetTypeId'>$assetTypeName</option>";
                        }
                        $output .= "</select>";
                        echo $output;
                        ?>
                    </div>
                </div>
                <div class='row flex justify-content-center'>
                    <div class='col-6 width-50 flex justify-center'>
                        <label>หน่วยนับ</label>
                        <?php
                        $stmt = $db->sqlQuery("SELECT * FROM unit");
                        $stmt->execute();
                        $output = " ";
                        $output .= "<select class='form-control' name='unitId'>";
                        $output .= "<option selected>เลือกหน่วยนับ </option>";
                        while ($result = $stmt->fetch(PDO::FETCH_ASSOC)) {
                            $unitId = $result['id'];
                            $unitName = $result['unit_name'];
                            $output .= "<option value='$unitId'>$unitName</option>";
                        }
                        $output .= "</select>";
                        echo $output;
                        ?>
                    </div>
                    <div class='col-6 width-50 flex justify-center'>
                        <label>สถานะ</label>
                        <select class='form-control' name='status'>
                            <option selected>เลือก สถานะ </option>
                            <option value="อยู่ในคลัง">อยู่ในคลัง </option>
                            <option value="ถูกยืม">ถูกยืม</option>
                            <option value="อยู่ระหว่างซ่อม">อยู่ระหว่างซ่อม</option>
                            <option value="จำหน่าย">จำหน่าย</option>
                        </select>
                    </div>
                </div>
                <div class='row flex justify-content-center'>
                    <div class='col-12 width-50 flex justify-center'>
                        <div class="form-group">
                            <label for="exampleFormControlFile1">รูปภาพ</label>
                            <input type="file" class="form-control-file" name="image" onchange="readURL(this);">
                            <img id="preview" src=" " width="50px" height="auto">
                        </div>
                    </div>
                </div>
            </div>
            <div class='row flex justify-content-center mt-2' style="padding-top: 20px">
                <div class='col-1 d-flex justify-content-start' style=''>
                    <a class='btn btn-sm btn-danger' href="javascript:history.back()"> <span>กลับ</span> </a>
                </div>
                <div class='col-1 d-flex justity-content-end'>
                    <input type='submit' class='btn btn-sm btn-success' name='submit' value='บันทึก'>
                </div>
            </div>
        </form>
    </div>
</div>

<script>
    function readURL(input) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();
            reader.onload = function(e) {
                $('#preview').attr('src', e.target.result);
            }
            reader.readAsDataURL(input.files[0]);
        }
    }
</script>
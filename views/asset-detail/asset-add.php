<?php
include_once "../layout/masterpage.php";
require "../../assets/config/db.php";
$db = new db();

$stmt = $db->sqlQuery("SELECT * FROM place");
$stmt->execute();
$places = array();
foreach ($stmt->fetchAll() as $res) {
    array_push($places, $res);
}
?>
<div class="home-section">
    <div class="home-content">
        <h1 style="padding-top: 0.5%">เพิ่มข้อมูลครุภัณฑ์</h1>
        <form method="post" action="../../assets/db/asset-detail/add-asset-detail-and-edit.php" enctype="multipart/form-data">
            <div class="form-insert-asset">
                <div class='row flex justify-content-center'>
                    <div class='col-6 width-50 flex justify-center'>
                        <label>เลขครุภัณฑ์</label>
                        <input type='text' name='assetNumber' class='form-control' placeholder='เลขครุภัณฑ์' required>
                    </div>
                    <div class='col-6 width-50 flex justify-center'>
                        <label>ชื่อครุภัณฑ์</label>
                        <input type='text' name='assetName' class='form-control' placeholder='ชื่อครุภัณฑ์' required>
                    </div>
                </div>
                <div class='row flex justify-content-center'>
                    <div class='col-3 width-50 flex justify-center'>
                        <label>รายละเอียด</label>
                        <textarea name="assetDetail" class="form-control" rows="5"></textarea>
                    </div>
                    <div class='col-3 width-50 flex justify-center'>
                        <label>คุณสมบัติ</label>
                        <textarea name="assetFeature" class="form-control" rows="5"></textarea>
                    </div>
                    <div class='col-3 width-50 flex justify-center'>
                        <label>วันที่ส่งของ</label>
                        <input type="text" data-provide="datepicker" data-date-language="th-th" name="dateDelivery" class="form-control" placeholder="dd-mm-yyyy" required>
                        <label>วันหมดประกัน</label>
                        <input type="text" data-provide="datepicker" data-date-language="th-th" name="expirationDate" class="form-control" placeholder="dd-mm-yyyy" required>
                        <label>มูลค่าครุภัณฑ์</label>
                        <input type="text" name="assetValue" class="form-control" placeholder="มูลค่าครุภัณฑ์">
                    </div>
                    <div class='col-3 width-50 flex justify-center'>
                        <label>วันที่รับเข้าคลัง</label>
                        <input type="text" data-provide="datepicker" data-date-language="th-th" name="dateAdmit" class="form-control" placeholder="dd-mm-yyyy" required>
                        <label>วันที่เบิก</label>
                        <input type="text" data-provide="datepicker" data-date-language="th-th" name="datePickup" class="form-control" placeholder="dd-mm-yyyy" required>
                        <label>เลขที่ใบส่งของ</label>
                        <input type="text" name="deliveryNumber" class="form-control" placeholder="เลขที่ใบส่งของ" required>
                    </div>
                </div>
                <div class='row flex justify-content-center'>
                    <div class='col-4 width-50 flex justify-center'>
                        <label>ชื่อผู้ขาย</label>
                        <input type="text" name="seller" class="form-control" placeholder="ชื่อผู้ขาย" required>
                    </div>
                    <div class='col-4 width-50 flex justify-center'>
                        <label>หมายเลขซีเรียล</label>
                        <input type="text" name="serialNumber" class="form-control" placeholder="หมายเลขซีเรียล">
                    </div>
                    <div class='col-4 width-50 flex justify-center'>
                        <label>ปีงบประมาณ</label>
                        <input type="text" name="yearBudget" class="form-control" placeholder="ปีงบประมาณ" required>
                    </div>
                </div>
                <div class='row flex justify-content-center'>
                    <div class='col-4 width-50 flex justify-center'>
                        <label>ที่อยู่</label>
                        <?php
                        $stmt = $db->sqlQuery("SELECT * FROM place");
                        $stmt->execute();
                        $output = " ";
                        $output .= "<select class='form-control' name='placeId'>";
                        $output .= "<option selected> เลือกสถานที่ </option>";
                        while ($result = $stmt->fetch(PDO::FETCH_ASSOC)) {
                            $placeId = $result['id'];
                            $placeName = $result['placename'];
                            $output .= "<option value='$placeId'>$placeName</option>";
                        }
                        $output .= "</select>";
                        echo $output;
                        ?>
                    </div>
                    <div class='col-4 width-50 flex justify-center'>
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
                    <div class='col-4 width-50 flex justify-center'>
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
                    <div class='col-4 width-50 flex justify-center'>
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
                    <div class='col-4 width-50 flex justify-center'>
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
                    <div class='col-4 width-50 flex justify-center'>
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
                    <div class='col-4 width-50 flex justify-center'>
                        <label>ผู้นำเข้าคลัง</label>
                        <?php
                        $stmt = $db->sqlQuery("SELECT * FROM staffs");
                        $stmt->execute();
                        $output = " ";
                        $output .= "<select class='form-control' name='staffId'>";
                        $output .= "<option selected>เลือกผู้นำเข้าคลัง </option>";
                        while ($result = $stmt->fetch(PDO::FETCH_ASSOC)) {
                            $staffId = $result['id'];
                            $staffFirstName = $result['staff_firstname'];
                            $staffLastName = $result['staff_lastname'];
                            $output .= "<option value='$staffId'>$staffFirstName $staffLastName</option>";
                        }
                        $output .= "</select>";
                        echo $output;
                        ?>
                    </div>
                    <div class='col-4 width-50 flex justify-center'>
                        <label>ผู้เบิก</label>
                        <?php
                        $stmt = $db->sqlQuery("SELECT * FROM personnels");
                        $stmt->execute();
                        $output = " ";
                        $output .= "<select class='form-control' name='personnelId'>";
                        $output .= "<option selected>เลือกผู้เบิก </option>";
                        while ($result = $stmt->fetch(PDO::FETCH_ASSOC)) {
                            $personnelId = $result['id'];
                            $personnelFirstName = $result['personnel_firstname'];
                            $personnelLastName = $result['personnel_lastname'];
                            $output .= "<option value='$personnelId'>$personnelFirstName $personnelLastName</option>";
                        }
                        $output .= "</select>";
                        echo $output;
                        ?>
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
                <!-- <div class="row flex justify-content-center">
                    <div class="col-5 width-50 flex justify-center">
                        <label for="">upload csv</label>
                        <input type="file" name="upload" id="upload">
                    </div>
                </div> -->
                <div class='row flex justify-content-center mt-2' style="padding-top: 20px">
                    <div class='col-1 d-flex justify-content-start' style=''>
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

<script>
    $(function() {
        $('.selectpicker').selectpicker();
    });

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
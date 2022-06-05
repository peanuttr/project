<?php
include "../../assets/config/db.php";
include_once "../layout/masterpage.php";

if (isset($_GET['id'])) {
    $_id = $_GET['id'];
    $db = new db();
    $stmt = $db->sqlQuery("SELECT a.*,t.assets_types_name,u.unit_name,d.department_name,m.money_source_name,p.placename,pe.personnel_firstname,pe.personnel_lastname,s.staff_firstname,s.staff_lastname FROM `assets` AS a 
    JOIN `assets_types` as t ON a.assets_types_id = t.id 
    JOIN `unit` as u ON a.unit_id = u.id 
    JOIN `department` as d ON a.department_id = d.id 
    JOIN `money_source` as m ON a.money_source_id = m.id
    JOIN `place` as p ON a.place_id = p.id
    JOIN `personnels` as pe ON a.personnel_id = pe.id
    JOIN `staffs` as s ON a.staff_id = s.id
    WHERE a.id = $_id");
    $stmt->execute();

    $res = $stmt->fetch(PDO::FETCH_ASSOC);
}
?>
<div class="home-section">
    <div class="home-content">
        <h1>แก้ไขข้อมูลครุภัณฑ์</h1>
        <form action='../../assets/db/asset-detail/add-asset-detail-and-edit.php' method='post' enctype="multipart/form-data">
            <input type="hidden" name='id' value=<?php echo $_id; ?>>
            <div class="form-insert-asset">
                <div class='row flex justify-content-center'>
                    <div class='col-6 width-50 flex justify-center'>
                        <label>เลขครุภัณฑ์</label>
                        <input type='text' name='assetNumber' class='form-control' placeholder='เลขครุภัณฑ์' value=<?php echo $res['assets_number']; ?>>
                    </div>
                    <div class='col-6 width-50 flex justify-center'>
                        <label>ชื่อครุภัณฑ์</label>
                        <input type='text' name='assetName' class='form-control' placeholder='ชื่อครุภัณฑ์' value=<?php echo $res['asset_name']; ?>>
                    </div>
                </div>
                <div class='row flex justify-content-center'>
                    <div class='col-3 width-50 flex justify-center'>
                        <label>รายละเอียด</label>
                        <textarea name="assetDetail" class="form-control" rows="5"> <?php echo $res['detail']; ?></textarea>
                    </div>
                    <div class='col-3 width-50 flex justify-center'>
                        <label>คุณสมบัติ</label>
                        <textarea name="assetFeature" class="form-control" rows="5"> <?php echo $res['feature']; ?></textarea>
                    </div>
                    <div class='col-3 width-50 flex justify-center'>
                        <label>วันที่ส่งของ</label>
                        <input type="text" data-provide="datepicker" data-date-language="th-th" name="dateDelivery" class="form-control" placeholder="dd-mm-yyyy" value=<?php echo DateThai($res['date_delivery']); ?>>
                        <label>วันหมดประกัน</label>
                        <input type="text" data-provide="datepicker" data-date-language="th-th" name="expirationDate" class="form-control" placeholder="dd-mm-yyyy" value=<?php echo DateThai($res['expiration_date']); ?>>
                        <label>มูลค่าครุภัณฑ์</label>
                        <input type="text" name="assetValue" class="form-control" placeholder="มูลค่าครุภัณฑ์" value=<?php echo $res['value_asset']; ?>>
                    </div>
                    <div class='col-3 width-50 flex justify-center'>
                        <label>วันที่รับเข้าคลัง</label>
                        <input type="text" data-provide="datepicker" data-date-language="th-th" name="dateAdmit" class="form-control" placeholder="dd-mm-yyyy" value=<?php echo DateThai($res['date_admit']); ?>>
                        <label>วันที่เบิก</label>
                        <input type="text" data-provide="datepicker" data-date-language="th-th" name="datePickup" class="form-control" placeholder="dd-mm-yyyy" value=<?php echo DateThai($res['date_pickup']); ?>>
                        <label>เลขที่ใบส่งของ</label>
                        <input type="text" name="deliveryNumber" class="form-control" placeholder="เลขที่ใบส่งของ" value=<?php echo $res['number_delivery']; ?>>
                    </div>
                </div>
                <div class='row flex justify-content-center'>
                    <div class='col-4 width-50 flex justify-center'>
                        <label>ชื่อผู้ขาย</label>
                        <input type="text" name="seller" class="form-control" placeholder="ชื่อผู้ขาย" value=<?php echo $res['seller_name']; ?>>
                    </div>
                    <div class='col-4 width-50 flex justify-center'>
                        <label>หมายเลขซีเรียล</label>
                        <input type="text" name="serialNumber" class="form-control" placeholder="หมายเลขซีเรียล" value=<?php echo $res['serial_number']; ?>>
                    </div>
                    <div class='col-4 width-50 flex justify-center'>
                        <label>ปีงบประมาณ</label>
                        <input type="text" name="yearBudget" class="form-control" placeholder="ปีงบประมาณ" value=<?php echo $res['year_of_budget']; ?>>
                    </div>
                </div>
                <div class='row flex justify-content-center'>
                    <div class='col-4 width-50 flex justify-center'>
                        <label>ที่อยู่</label>
                        <?php
                        $stmt = $db->sqlQuery("SELECT * FROM place");
                        $stmt->execute();
                        echo "<select class='form-control' name='placeId'>";
                        echo "<option value=" . $res['place_id'] . " selected> " . $res['placename'] . "</option>";
                        while ($result = $stmt->fetch(PDO::FETCH_ASSOC)) {
                            $placeId = $result['id'];
                            $placeName = $result['placename'];
                            if (strcmp($res['placename'], $placeName) == 0) {
                            } else {
                                echo "<option value='$placeId'>$placeName</option>";
                            }
                        }
                        echo "</select>"
                        ?>
                    </div>
                    <div class='col-4 width-50 flex justify-center'>
                        <label>แหล่งเงิน</label>
                        <?php
                        $stmt = $db->sqlQuery("SELECT * FROM money_source");
                        $stmt->execute();
                        echo "<select class='form-control' name='moneySourceId'>";
                        echo "<option value=" . $res['money_source_id'] . " selected> " . $res['money_source_name'] . "</option>";
                        while ($result = $stmt->fetch(PDO::FETCH_ASSOC)) {
                            $moneySourceId = $result['id'];
                            $moneySourceName = $result['money_source_name'];
                            if (strcmp($res['money_source_name'], $moneySourceName) == 0) {
                            } else {
                                echo "<option value='$moneySourceId'>$moneySourceName</option>";
                            }
                        }
                        echo "</select>"
                        ?>
                    </div>
                    <div class='col-4 width-50 flex justify-center'>
                        <label>หน่วยงาน</label>
                        <?php
                        $stmt = $db->sqlQuery("SELECT * FROM department");
                        $stmt->execute();
                        echo "<select class='form-control' name='departmentId'>";
                        echo "<option value=" . $res['department_id'] . " selected> " . $res['department_name'] . "</option>";
                        while ($result = $stmt->fetch(PDO::FETCH_ASSOC)) {
                            $depId = $result['id'];
                            $depName = $result['department_name'];
                            if (strcmp($res['department_name'], $depName) == 0) {
                            } else {
                                echo "<option value='$depId'>$depName</option>";
                            }
                        }
                        echo "</select>"
                        ?>
                    </div>
                </div>
                <div class='row flex justify-content-center'>
                    <div class='col-4 width-50 flex justify-center'>
                        <label>ประเภทครุภัณฑ์</label>
                        <?php
                        $stmt = $db->sqlQuery("SELECT * FROM assets_types");
                        $stmt->execute();
                        echo "<select class='form-control' name='assetTypeId'>";
                        echo "<option value=" . $res['assets_types_id'] . " selected> " . $res['assets_types_name'] . "</option>";
                        while ($result = $stmt->fetch(PDO::FETCH_ASSOC)) {
                            $assetTypeId = $result['id'];
                            $assetTypeName = $result['assets_types_name'];
                            if (strcmp($res['assets_types_name'], $assetTypeName) == 0) {
                            } else {
                                echo "<option value='$assetTypeId'>$assetTypeName</option>";
                            }
                        }
                        echo "</select>"
                        ?>
                    </div>
                    <div class='col-4 width-50 flex justify-center'>
                        <label>หน่วยนับ</label>
                        <?php
                        $stmt = $db->sqlQuery("SELECT * FROM unit");
                        $stmt->execute();
                        echo "<select class='form-control' name='unitId'>";
                        echo "<option value=" . $res['unit_id'] . " selected> " . $res['unit_name'] . "</option>";
                        while ($result = $stmt->fetch(PDO::FETCH_ASSOC)) {
                            $unitId = $result['id'];
                            $unitName = $result['unit_name'];
                            if (strcmp($res['unit_name'], $unitName) == 0) {
                            } else {
                                echo "<option value='$unitId'>$unitName</option>";
                            }
                        }
                        echo "</select>"
                        ?>
                    </div>
                    <div class='col-4 width-50 flex justify-center'>
                        <label>สถานะ</label>
                        <?php
                        $status = ["อยู่ในคลัง", "ถูกยืม", "อยู่ระหว่างซ่อม", "จำหน่าย"];
                        echo " <select class='form-control' name='status'>";
                        echo " <option selected> " . $res['status'] . " </option> ";
                        for ($i = 0; $i < count($status); $i++) {
                            if (strcmp($res['status'], $status[$i]) == 0) {
                            } else {
                                echo "<option value='$status[$i]'>$status[$i]</option>";
                            }
                        }
                        echo "</select>";
                        ?>
                    </div>
                </div>
                <div class='row flex justify-content-center'>
                    <div class='col-4 width-50 flex justify-center'>
                        <label>ผู้นำเข้าคลัง</label>
                        <?php
                        $stmt = $db->sqlQuery("SELECT * FROM staffs");
                        $stmt->execute();
                        echo "<select class='form-control' name='staffId'>";
                        echo "<option value=" . $res['staff_id'] . " selected> " . $res['staff_firstname'] . " " . $res['staff_lastname'] . "</option>";
                        while ($result = $stmt->fetch(PDO::FETCH_ASSOC)) {
                            $staffId = $result['id'];
                            $staffName = $result['staff_firstname'];
                            $staffLastName = $result['staff_lastname'];
                            if (strcmp($res['staff_firstname'], $staffName) == 0) {
                            } else {
                                echo "<option value='$staffId'>$staffName $staffLastName</option>";
                            }
                        }
                        echo "</select>"
                        ?>
                    </div>
                    <div class='col-4 width-50 flex justify-center'>
                        <label>ผู้เบิก</label>
                        <?php
                        $stmt = $db->sqlQuery("SELECT * FROM personnels");
                        $stmt->execute();
                        echo "<select class='form-control' name='personnelId'>";
                        echo "<option value=" . $res['personnel_id'] . " selected> " . $res['personnel_firstname'] . " " . $res['personnel_lastname'] . "</option>";
                        while ($result = $stmt->fetch(PDO::FETCH_ASSOC)) {
                            $personnelId = $result['id'];
                            $personnelName = $result['personnel_firstname'];
                            $personnelLastName = $result['personnel_lastname'];
                            if (strcmp($res['personnel_firstname'], $personnelName) == 0) {
                            } else {
                                echo "<option value='$personnelId'>$personnelName $personnelLastName</option>";
                            }
                        }
                        echo "</select>"
                        ?>
                    </div>
                </div>
                <div class='row flex justify-content-center'>
                    <div class='col-12 width-50 flex justify-center'>
                        <div class="form-group">
                            <label for="exampleFormControlFile1">รูปภาพ</label>
                            <input type="file" class="form-control-file" name="image" onchange="readURL(this);">
                            <img id="preview" src="<?php echo "../../assets/uploads/", $res['image'] ?>" width="50px" height="auto">
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
            </div>
        </form>
    </div>
</div>

<?php
function DateThai($strDate)
{
    $strYear = date("Y", strtotime($strDate)) + 543;

    $strMonth = date("m", strtotime($strDate));

    $strDay = date("d", strtotime($strDate));

    $newdate = "$strDay-$strMonth-$strYear";

    return $newdate;
} ?>

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
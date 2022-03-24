<?php
include_once "../layout/masterpage.php";
require "../../assets/config/db.php";
$db = new db();

$stmt = $db->sqlQuery("SELECT a.*,t.assets_types_name,u.unit_name,d.department_name,m.money_source_name FROM `assets` AS a 
                        JOIN `assets_types` as t ON a.assets_types_id = t.id 
                        JOIN `unit` as u ON a.unit_id = u.id 
                        JOIN `department` as d ON a.department_id = d.id 
                        JOIN `money_source` as m ON a.money_source_id = m.id");
$stmt->execute();

$assets = array();

foreach ($stmt->fetchAll() as $res) {
    array_push($assets, ['id' => $res['id'], 'assets_number' => $res['assets_number'], 'assets_name' => $res['asset_name']]);
}
?>

<div class="home-section">
    <div class="home-content">
        <h1 style="padding-top: 10px;">เพิ่มการยืม-คืนครุภัณฑ์</h1>
        <form method="post" action="../../assets/db/borrow-return/add-borrow-return-and-edit.php">
            <div class="container">
                <div class='row flex justify-content-center'>
                    <div class='col-6 width-50 flex justify-center'>
                        <label>รหัสครุภัณฑ์</label>
                        <input type="hidden" name="assets-id" id="assets-id">
                        <input type="search" list="asset-number" id="assets-number" class="form-control" name="assets-number" />
                        <datalist id="asset-number">
                            <?php

                            for ($i = 0; $i < count($assets); $i++) {
                            
                            ?>
                                <option value="<?php echo $assets[$i]['assets_number']; ?>"> <?php echo $assets[$i]['assets_name'] ?> </option>
                            <?php
                            }
                            ?>
                        </datalist>
                    </div>
                    <div class='col-6 width-50 flex justify-center'>
                        <label>ชื่อครุภัณฑ์</label>
                        <input type="text" id="assets-name" class="form-control" name="assets-name" />
                    </div>
                </div>
                <div class='row flex justify-content-center'>
                <div class='col-6 width-50 flex justify-center'>
                    <label>สถานที่</label>
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
                    <div class='col-6 width-50 flex justify-center'>
                        <label>รายละเอียดการยืม</label>
                        <textarea name="detail" class="form-control" rows="5"></textarea>
                    </div>
                </div>
                <div class='row flex justify-content-center' style="padding-top: 5px;">
                    <div class='col-6 width-50 flex justify-center'>
                        <label>วันที่ยืมครุภัณฑ์</label>
                        <input type="text" id="borrowDate" name="borrowDate" class="form-control" placeholder="วว / ดด / ปป">
                    </div>
                    <div class='col-6 width-50 flex justify-center'>
                        <label>วันที่คืนครุภัณฑ์</label>
                        <input type="text" id="returnDate" name="returnDate" class="form-control" placeholder="วว / ดด / ปป">
                    </div>
                </div>
                <div class='row flex justify-content-center' style="padding-top: 5px;">
                    <div class='col-6 width-50 flex justify-center'>
                    <label>ชื่อผู้ยืม</label>
                    <?php
                        $stmt = $db->sqlQuery("SELECT * FROM personnels");
                        $stmt->execute();
                        $output = " ";
                        $output .= "<select class='form-control' name='personnelId'>";
                        $output .= "<option selected> เลือกผู้ยืม </option>";
                        while ($result = $stmt->fetch(PDO::FETCH_ASSOC)) {
                            $personnelId = $result['id'];
                            $personnelName = $result['personnel_firstname'];
                            $output .= "<option value='$personnelId'>$personnelName</option>";
                        }
                        $output .= "</select>";
                        echo $output;
                        ?>
                    </div>
                    <div class='col-6 width-50 flex justify-center'>
                        <label>ชื่อเจ้าหน้าที่</label>
                        <?php
                        $stmt = $db->sqlQuery("SELECT * FROM staffs");
                        $stmt->execute();
                        $output = " ";
                        $output .= "<select class='form-control' name='staffId'>";
                        $output .= "<option selected> เลือกเจ้าหน้าที่ </option>";
                        while ($result = $stmt->fetch(PDO::FETCH_ASSOC)) {
                            $staffId = $result['id'];
                            $staffName = $result['staff_firstname'];
                            $output .= "<option value='$staffId'>$staffName</option>";
                        }
                        $output .= "</select>";
                        echo $output;
                        ?>
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

<script type="text/javascript">
    $(document).ready(function() {
        var assetsData = <?php echo json_encode($assets); ?>;

        $("#assets-number").on('change', function() {
            assetsData.map((data) => {
                if ($("#assets-number").val() === data.assets_number) {
                    $("#assets-name").val(data.assets_name);
                    $("#assets-id").val(data.id);
                    return;
                }
            });
        });

        $("#borrowDate").datepicker({
            language: 'th-th',
            format: 'dd-mm-yyyy',
            autoclose: true,
        });

        $("#returnDate").datepicker({
            language: 'th-th',
            format: 'dd-mm-yyyy',
            autoclose: true,
        });
    });
</script>
<?php
include_once "../layout/masterpage.php";
require "../../assets/config/db.php";
$assets = array();

$db = new db;
$stmt = $db->sqlQuery("SELECT a.*,t.assets_types_name,u.unit_name,d.department_name,m.money_source_name FROM `assets` AS a 
                        JOIN `assets_types` as t ON a.assets_types_id = t.id 
                        JOIN `unit` as u ON a.unit_id = u.id 
                        JOIN `department` as d ON a.department_id = d.id 
                        JOIN `money_source` as m ON a.money_source_id = m.id");
$stmt->execute();

foreach ($stmt->fetchAll() as $res) {
    array_push($assets, ['id' => $res['id'], 'assets_number' => $res['assets_number'], 'assets_name' => $res['asset_name']]);
}
?>
<div class="home-section">
    <div class="home-content">
        <h1>การแจ้งซ่อมครุภัณฑ์</h1>
        <form action="../../assets/db/repair-assetments/add-repair-assetment.php" method="POST">
            <div class="row">
                <div class="col-6">
                    <label>รหัสครุภัณฑ์</label>
                    <input type="hidden" name="assets-id" id="assets-id">
                    <input type="search" list="asset-number" id="assets-number" class="form-control" name="assets-number" />
                    <datalist id="asset-number">
                        <?php

                        for ($i = 0; $i < count($assets); $i++) {

                        ?>
                            <option value="<?php echo $assets[$i]['assets_number']; ?>" />
                        <?php
                        }
                        ?>
                    </datalist>
                </div>
                <div class="col-6">
                    <label>ชื่อครุภัณฑ์</label>
                    <input type="text" id="assets-name" class="form-control" name="assets-name" />
                </div>
            </div>
            <div class="row">
                <div class="col-12">
                    <div>
                        <label>รายละเอียดการซ่อม/ปัญหา</label>
                    </div>
                    <textarea name="detail" class="form-control" rows="10"></textarea>
                </div>
            </div>
            <div class="row">
                <div class="col-6">
                    <label>วันที่แจ้ง</label>
                    <input type="date" name="date" class="form-control">
                </div>
                <div class="col-6">
                    <div>
                        <label>ชื่อผู้แจ้ง</label>
                    </div>
                    <select name="personnel_id" class="form-select">
                        <option selected>เลือกผูู้แจ้ง</option>
                        <?php
                        $stmt = $db->sqlQuery("SELECT * FROM `personnels`");
                        $stmt->execute();

                        foreach ($stmt->fetchAll() as $res) {

                        ?>
                            <option value="<?php echo $res['id']; ?>"><?php echo $res['personnel_firstname']; ?></option>
                        <?php
                        }
                        ?>
                    </select>
                </div>
            </div>
            <div class="row">
                <div class="col-12">
                    <!-- <input type="files" name="img"> -->
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
<script>
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

    });
</script>
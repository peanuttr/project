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
    array_push($assets, ['assets_number' => $res['assets_number'], 'assets_name' => $res['asset_name']]);
}
?>
<div class="home-section">
    <div class="home-content">
        <h1>การแจ้งซ่อมครุภัณฑ์</h1>
        <form action="">
            <div class="row">
                <div class="col-6">
                    <label>รหัสครุภัณฑ์</label>
                    <input type="search" list="asset-number" class="form-control" onchange="setAssetData(this.value)" />
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
                    <input type="text" id="assetsname" class="form-control" />
                </div>

            </div>
        </form>
    </div>
</div>
<script>
    function setAssetData(value) {
        console.log(value);
        console.log(<?php echo json_encode($assets); ?>);
        var assetsData = <?php echo json_encode($assets); ?>;
        console.log(assetsData);
    }
</script>
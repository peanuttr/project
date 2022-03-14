<?php
include_once "../layout/masterpage.php";
?>
<div class="home-section">
    <div class="home-content">
        <h1>การแจ้งซ่อมครุภัณฑ์</h1>
        <form action="">
            <div class="row">
                <div class="col-6">
                    <label>รหัสครุภัณฑ์</label>
                    <input list="asset-number" class="form-control" />
                    <datalist id="asset-number">
                        <?php
                        require "../../assets/config/db.php";
                        $db = new db;
                        $stmt = $db->sqlQuery("SELECT a.*,t.assets_types_name,u.unit_name,d.department_name,m.money_source_name FROM `assets` AS a 
                        JOIN `assets_types` as t ON a.assets_types_id = t.id 
                        JOIN `unit` as u ON a.unit_id = u.id 
                        JOIN `department` as d ON a.department_id = d.id 
                        JOIN `money_source` as m ON a.money_source_id = m.id");
                        $stmt->execute();
                        $asset_number = "";
                        foreach ($stmt->fetchAll() as $res) {
                        ?>
                            <option value="<?php echo $res['assets_number']; ?>" />
                        <?php
                        }
                        ?>
                    </datalist>
                </div>
                <div class="col-6">
                    <label>ชื่อครุภัณฑ์</label>
                    <input list="asset-name" class="form-control" />
                    <datalist id="asset-name">
                        <?php
                        $stmt = $db->sqlQuery("SELECT a.*,t.assets_types_name,u.unit_name,d.department_name,m.money_source_name FROM `assets` AS a 
                        JOIN `assets_types` as t ON a.assets_types_id = t.id 
                        JOIN `unit` as u ON a.unit_id = u.id 
                        JOIN `department` as d ON a.department_id = d.id 
                        JOIN `money_source` as m ON a.money_source_id = m.id WHERE a.assets_number = '$res[assets_number]'");
                        $stmt->execute();
                        foreach ($stmt->fetchAll() as $res) {
                        ?>
                            <option value="<?php echo $res['asset_name']; ?>" />
                        <?php
                        }
                        ?>
                    </datalist>
                </div>

            </div>
        </form>
    </div>
</div>
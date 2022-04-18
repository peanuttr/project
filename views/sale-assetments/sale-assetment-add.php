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
        <h1 style="padding-top: 10px;">เพิ่มการจำหน่าย</h1>
        <form action="" method="post">
            <div class="container">
                <div class="row flex justify-content-center">
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
            </div>
        </form>
    </div>
</div>
<script>
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
</script>
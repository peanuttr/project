<?php
include "../../assets/config/db.php";
include_once "../layout/masterpage.php";

$db = new db();
if (isset($_GET['id'])) {
    $_id = $_GET['id'];
    $stmt = $db->sqlQuery("SELECT a.id AS assets_id,a.assets_number,a.asset_name,se.selling_date,se.detail,se.status,st.staff_firstname,st.staff_lastname FROM `detail_sells` AS ds JOIN `assets` AS a ON ds.asset_id = a.id JOIN `sells` AS se ON ds.sell_id = se.id JOIN `staffs` AS st ON st.id = se.staff_id WHERE ds.sell_id =" . $_id);
    $stmt->execute();

    $assets = array();

    $response = $stmt->fetch(PDO::FETCH_ASSOC);
    if (!$response) {
?>
        <script>
            window.history.back();
        </script>
    <?php
    }
    ?>
    <div class="home-section">
        <div class="home-content">
            <h1>รายละเอียดการแจ้งซ่อม</h1>
            <?php
            $stmt->execute();
            while ($res = $stmt->fetch(PDO::FETCH_ASSOC)) {
                array_push($assets, ['id' => $res['assets_id']]);
            ?>
                <div class="row form-group">
                    <div class="col-md-5 d-flex justify-content-end">เลขครุภัณฑ์ : </div>
                    <div class="col-md-6"><?php echo $res['assets_number']; ?></div>
                </div>
                <div class="row form-group">
                    <div class="col-md-5 d-flex justify-content-end">ชื่อครุภัณฑ์ :</div>
                    <div class="col-md-6"><?php echo $res['asset_name']; ?></div>
                </div>
            <?php
            }
            ?>
            <div class="row form-group">
                <div class="col-md-5 d-flex justify-content-end">วันที่แจ้ง :</div>
                <div class="col-md-6"><?php echo $response['selling_date']; ?></div>
            </div>
            <div class="row form-group">
                <div class="col-md-5 d-flex justify-content-end">รายละเอียด :</div>
                <div class="col-md-6"><?php echo $response['detail']; ?></div>
            </div>
            <div class="row form-group">
                <div class="col-md-5 d-flex justify-content-end">สถานะ :</div>
                <div class="col-md-6"><?php
                                        if ($response['status'] == 1) {
                                            echo "แจ้งซ่อม";
                                        } else if ($response['status'] == 2) {
                                            echo "ดำเนินการซ่อม";
                                        } else if ($response['status'] == 3) {
                                            echo "ซ่อมสำเร็จ";
                                        }
                                        ?></div>
            </div>
            <div class="row form-group">
                <div class="col-md-5 d-flex justify-content-end">ชื่อ-นามสกุลผู้แจ้ง :</div>
                <div class="col-md-6"><?php echo $response['staff_firstname'] . " " . $response['staff_lastname']; ?></div>
            </div>
            <div class='row flex justify-content-center mt-2' style="padding-top: 20px">
                <div class='col-1 d-flex justify-content-start'>
                    <a class='btn btn-sm btn-danger' href="javascript:history.back()"> <span>กลับ</span> </a>
                </div>
                <?php
                if ($response['status'] == 1) {
                ?>
                    <div class='col-1 d-flex justity-content-end'>
                        <a class='btn btn-sm btn-success' onclick='updateStatus("<?php echo $_id ?>",2,<?php echo json_encode($assets) ?>)'><span>approve</span><a>
                    </div>
                    <div class='col-1 d-flex justity-content-end'>
                        <a class='btn btn-sm btn-success' onclick='updateStatus("<?php echo $_id ?>",0,<?php echo json_encode($assets) ?>)'><span>reject</span><a>
                    </div>
                <?php
                }
                ?>
                <?php
                if ($response['status'] == 2) {
                ?>
                    <div class='col-1 d-flex justity-content-end'>
                        <a class='btn btn-sm btn-success' onclick='updateStatus("<?php echo $_id ?>",3,<?php echo json_encode($assets) ?>)'><span>success</span><a>
                    </div>
                <?php
                }
                ?>
            </div>
        </div>
    </div>
<?php
}
?>
<script>
    function updateStatus(repair_id, status, assets) {
        console.log(assets);
        // window.location.href = '../../assets/db/repair-assetments/edit-repair-assetment.php?assets='+JSON.stringify(assets)
        $.ajax({
            url: '../../assets/db/selling/edit-sell-assetment.php',
            type: 'POST',
            data: {
                id: repair_id,
                status: status,
                assets: JSON.stringify(assets)
            },
            success: function(data) {
                window.location.href = "./sale-assetment-manage.php"
            }
        })
    }
</script>
<?php
include "../../assets/config/db.php";
include_once "../layout/masterpage.php";

$db = new db();
if (isset($_GET['id'])) {
    $_id = $_GET['id'];
    $stmt = $db->sqlQuery("SELECT a.id AS assets_id,a.assets_number,a.asset_name,r.date_notice,r.detail,r.status,p.personnel_firstname,p.personnel_lastname 
    FROM `detail_repair_notice` AS dr 
    JOIN `assets` AS a ON dr.asset_id = a.id 
    JOIN `repair_notice` AS r ON dr.repair_id = r.id 
    JOIN `personnels` AS p ON r.personel_id = p.id 
    WHERE dr.repair_id = " . $_id);
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
            <h1 style="padding-left: 10%;">รายละเอียดการแจ้งซ่อม</h1>
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
                <div class="col-md-5 d-flex justify-content-end">วันที่แจ้งซ่อม :</div>
                <div class="col-md-6"><?php echo DateThai($response['date_notice']); ?></div>
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
                <div class="col-md-5 d-flex justify-content-end">ชื่อ-นามสกุลผู้แจ้งซ่อม :</div>
                <div class="col-md-6"><?php echo $response['personnel_firstname'] . " " . $response['personnel_lastname']; ?></div>
            </div>
            <div class='row flex justify-content-center mt-2' style="padding-top: 20px">
                <div class='col-1 d-flex justify-content-start'>
                    <a class='btn btn-sm btn-danger' href="javascript:history.back()"> <span>กลับ</span> </a>
                </div>
                <?php
                if ($response['status'] == 1) {
                ?>
                    <div class='col-1 d-flex justity-content-end'>
                        <a class='btn btn-sm btn-success' onclick='updateStatus("<?php echo $_id ?>",2,<?php echo json_encode($assets) ?>)'><span>อนุมัติ</span><a>
                    </div>
                    <div class='col-1 d-flex justity-content-end'>
                        <a class='btn btn-sm btn-danger' onclick='updateStatus("<?php echo $_id ?>",0,<?php echo json_encode($assets) ?>)'><span>ไม่อนุมัติ</span><a>
                    </div>
                <?php
                }
                ?>
                <?php
                if ($response['status'] == 2) {
                ?>
                    <div class='col-1 d-flex justity-content-end'>
                        <a class='btn btn-sm btn-success' onclick='updateStatus("<?php echo $_id ?>",3,<?php echo json_encode($assets) ?>)'><span>ซ่อมสำเร็จ</span><a>
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
<?php
function DateThai($strDate)
{
    $strYear = date("Y", strtotime($strDate)) + 543;

    $strMonth = date("n", strtotime($strDate));

    $strDay = date("j", strtotime($strDate));

    $strMonthCut = array("", "ม.ค.", "ก.พ.", "มี.ค.", "เม.ย.", "พ.ค.", "มิ.ย.", "ก.ค.", "ส.ค.", "ก.ย.", "ต.ค.", "พ.ย.", "ธ.ค.");

    $strMonthThai = $strMonthCut[$strMonth];

    return "$strDay $strMonthThai $strYear";
}

?>
<script>
    function updateStatus(repair_id, status, assets) {
        console.log(assets);
        // window.location.href = '../../assets/db/repair-assetments/edit-repair-assetment.php?assets='+JSON.stringify(assets)
        $.ajax({
            url: '../../assets/db/repair-assetments/edit-repair-assetment.php',
            type: 'POST',
            data: {
                id: repair_id,
                status: status,
                assets: JSON.stringify(assets)
            },
            success: function(data) {
                window.location.href = "./repair-assetments-manage.php"
            }
        })
    }
</script>
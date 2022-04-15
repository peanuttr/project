<?php
include "../../assets/config/db.php";
include_once "../layout/masterpage.php";

$db = new db();
if (isset($_GET['id'])) {
    $_id = $_GET['id'];
    $stmt = $db->sqlQuery("SELECT a.assets_number,a.asset_name,r.date_notice,r.detail,r.status,p.personnel_firstname,p.personnel_lastname 
    FROM `detail_repair_notice` AS dr 
    JOIN `assets` AS a ON dr.asset_id = a.id 
    JOIN `repair_notice` AS r ON dr.repair_id = r.id 
    JOIN `personnels` AS p ON r.personel_id = p.id 
    WHERE dr.repair_id = " . $_id);
    $stmt->execute();
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
            while ($res = $stmt->fetch(PDO::FETCH_ASSOC)) {
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
                <div class="col-md-6"><?php echo $response['date_notice']; ?></div>
            </div>
            <div class="row form-group">
                <div class="col-md-5 d-flex justify-content-end">รายละเอียด :</div>
                <div class="col-md-6"><?php echo $response['detail']; ?></div>
            </div>
            <div class="row form-group">
                <div class="col-md-5 d-flex justify-content-end">สถานะ :</div>
                <div class="col-md-6"><?php echo $response['status']; ?></div>
            </div>
            <div class="row form-group">
                <div class="col-md-5 d-flex justify-content-end">ชื่อ-นามสกุลผู้แจ้ง :</div>
                <div class="col-md-6"><?php echo $response['personnel_firstname']." ".$response['personnel_lastname']; ?></div>
            </div>
            <div class='row flex justify-content-center mt-2' style="padding-top: 20px">
                <div class='col-1 d-flex justify-content-start'>
                    <a class='btn btn-sm btn-danger' href="javascript:history.back()"> <span>กลับ</span> </a>
                </div>
                <!-- <div class='col-1 d-flex justity-content-end'>
                    <input type='submit' class='btn btn-sm btn-success' name='submit' value='บันทึก'>
                </div> -->
            </div>
        </div>
    </div>
<?php
}
?>
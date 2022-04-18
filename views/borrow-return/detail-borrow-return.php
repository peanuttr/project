<?php
include "../../assets/config/db.php";
include_once "../layout/masterpage.php";

$db = new db();
if (isset($_GET['id'])) {
    $_id = $_GET['id'];
    $stmt = $db->sqlQuery("SELECT brd.*,s.staff_firstname,s.staff_lastname,p.personnel_firstname,p.personnel_lastname,pl.placename,a.asset_name,a.assets_number,br.borrow_date,br.return_date,br.detail,br.status
                FROM `detail_borrow_and_return` AS brd
                            JOIN `borrow_and_return` as br ON brd.borrow_and_return_id = br.id
                            JOIN `staffs` as s ON br.staff_id = s.id 
                            JOIN `personnels` as p ON br.personel_id = p.id 
                            JOIN `place` as pl ON brd.place_id = pl.id 
                            JOIN `assets` as a ON brd.asset_id = a.id");
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
                <div class="col-md-5 d-flex justify-content-end">วันที่ยืม :</div>
                <div class="col-md-6"><?php echo $response['borrow_date']; ?></div>
            </div>
            <div class="row form-group">
                <div class="col-md-5 d-flex justify-content-end">วันที่คืน :</div>
                <div class="col-md-6"><?php echo $response['return_date']; ?></div>
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
                <div class="col-md-5 d-flex justify-content-end">ชื่อ-นามสกุลผู้ยืม :</div>
                <div class="col-md-6"><?php echo $response['personnel_firstname'] . " " . $response['personnel_lastname']; ?></div>
            </div>
            <div class="row form-group">
                <div class="col-md-5 d-flex justify-content-end">ชื่อ-นามสกุลผเจ้าหน้าที่ :</div>
                <div class="col-md-6"><?php echo $response['staff_firstname'] . " " . $response['staff_lastname']; ?></div>
            </div>
            <div class='row flex justify-content-center mt-2' style="padding-top: 20px">
                <div class='col-1 d-flex justify-content-start'>
                    <a class='btn btn-sm btn-danger' href="javascript:history.back()"> <span>กลับ</span> </a>
                </div>
                <div class='col-1 d-flex justity-content-end'>
                    <a class='btn btn-sm btn-success'><span>approve</span><a>
                </div>
            </div>
        </div>
    </div>
<?php
}
?>
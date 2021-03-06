<?php
include "../../assets/config/db.php";
include_once "../layout/masterpage.php";

$db = new db();
if (isset($_GET['id'])) {
    $_id = $_GET['id'];
    // $stmt = $db->sqlQuery("SELECT a.*,t.assets_types_name,u.unit_name,d.department_name,d.department_number,m.money_source_name,m.money_source_number,
    //             p.placename FROM `assets` AS a 
    //             JOIN `assets_types` as t ON a.assets_types_id = t.id 
    //             JOIN `unit` as u ON a.unit_id = u.id 
    //             JOIN `department` as d ON a.department_id = d.id 
    //             JOIN `money_source` as m ON a.money_source_id = m.id
    //             JOIN `place` as p ON a.place_id = p.id
    //             WHERE a.id = "  . $_id);
    // $sql = "SELECT a.*,t.assets_types_name,u.unit_name,d.department_name,m.money_source_name,p.placename,pe.personnel_firstname,pe.personnel_lastname,s.personnel_firstname,s.personnel_lastname FROM `assets` AS a 
    // JOIN `assets_types` as t ON a.assets_types_id = t.id 
    // JOIN `unit` as u ON a.unit_id = u.id 
    // JOIN `department` as d ON a.department_id = d.id 
    // JOIN `money_source` as m ON a.money_source_id = m.id
    // JOIN `place` as p ON a.place_id = p.id
    // JOIN `personnels` as pe ON a.importer_id = pe.id
    // JOIN `personnels` as s ON a.exporter_id = s.id
    // WHERE a.id = $_id";
    // $sql = "SELECT a.*,t.assets_types_name,u.unit_name,d.department_number,d.department_name,m.money_source_number,m.money_source_name,p.placename FROM `assets` AS a 
    // JOIN `assets_types` as t ON a.assets_types_id = t.id 
    // JOIN `unit` as u ON a.unit_id = u.id 
    // JOIN `department` as d ON a.department_id = d.id 
    // JOIN `money_source` as m ON a.money_source_id = m.id
    // JOIN `place` as p ON a.place_id = p.id
    // WHERE a.id = $_id";
    $sql = "SELECT a.* FROM `assets` AS a 
    WHERE a.id = $_id";
    $stmt = $db->sqlQuery($sql);
    $stmt->execute();
?>
    <div class="home-section">
        <div class="home-content" style="overflow-y: auto; overflow-x: hidden; height:93%; width:auto">
            <h1 style="padding-left: 10%;">??????????????????????????????????????????????????????</h1>
            <?php
            $resp = $stmt->fetch(PDO::FETCH_ASSOC);
            $sql = "SELECT a.*,t.assets_types_name,u.unit_name,d.department_number,d.department_name,m.money_source_number,m.money_source_name,p.placename ";
            $from = " FROM `assets` AS a 
    JOIN `assets_types` as t ON a.assets_types_id = t.id 
    JOIN `unit` as u ON a.unit_id = u.id 
    JOIN `department` as d ON a.department_id = d.id 
    JOIN `money_source` as m ON a.money_source_id = m.id
    JOIN `place` as p ON a.place_id = p.id";
            $where = " WHERE a.id = $_id";
            $haveIm = false;
            $haveEx = false;
            if ($resp['importer_id']){
                // $sql .= ",im.personnel_firstname AS importer_fname,im.personnel_lastname AS importer_lname ";
                $sql .= ",CONCAT(im.personnel_firstname,' ',im.personnel_lastname) AS importer_name";
                $from .= " JOIN `personnels` as im ON im.id = a.importer_id ";
                $haveIm = true;
            }
            if ($resp['exporter_id']){
                // $sql .= ",ex.personnel_firstname AS exporter_fname,ex.personnel_lastname AS exporter_lname";
                $sql .=",CONCAT(ex.personnel_firstname,' ',ex.personnel_lastname) AS exporter_name";
                $from .= " JOIN `personnels` as ex ON ex.id = a.exporter_id ";
                $haveEx = true;
            }
            // echo $sql.$from.$where;
            $stmt = $db->sqlQuery($sql.$from.$where);
            $stmt->execute();
                while ($res = $stmt->fetch(PDO::FETCH_ASSOC)) {
            ?>
                <div class="row form-group">
                    <div class="col-md-5 d-flex justify-content-end font-weight-bold">????????????????????? : </div>
                    <div class="col-md-6"><?php echo $res['faculty_number']; ?></div>
                </div>
                <div class="row form-group">
                    <div class="col-md-5 d-flex justify-content-end font-weight-bold">????????????????????? : </div>
                    <div class="col-md-6"><?php echo $res['faculty_name']; ?></div>
                </div>
                <div class="row form-group">
                    <div class="col-md-5 d-flex justify-content-end font-weight-bold">????????????????????????????????? : </div>
                    <div class="col-md-6"><?php echo $res['assets_number']; ?></div>
                </div>
                <div class="row form-group">
                    <div class="col-md-5 d-flex justify-content-end font-weight-bold">???????????????????????????????????? :</div>
                    <div class="col-md-6"><?php echo $res['asset_name']; ?></div>
                </div>
                <div class="row form-group">
                    <div class="col-md-5 d-flex justify-content-end font-weight-bold">?????????????????????????????????????????? :</div>
                    <div class="col-md-6"><?php echo $res['serial_number']; ?></div>
                </div>
                <div class="row form-group">
                    <div class="col-md-5 d-flex justify-content-end font-weight-bold">?????????????????????????????? :</div>
                    <div class="col-md-6"><?php echo $res['detail']; ?></div>
                </div>
                <div class="row form-group">
                    <div class="col-md-5 d-flex justify-content-end font-weight-bold">?????????????????????????????????????????? :</div>
                    <div class="col-md-6"><?php echo $res['assets_types_name']; ?></div>
                </div>
                <div class="row form-group">
                    <div class="col-md-5 d-flex justify-content-end font-weight-bold">???????????????????????? :</div>
                    <div class="col-md-6"><?php echo $res['unit_name']; ?></div>
                </div>
                <div class="row form-group">
                    <div class="col-md-5 d-flex justify-content-end font-weight-bold">???????????????????????????????????? :</div>
                    <div class="col-md-6"><?php echo $res['department_number']; ?></div>
                </div>
                <div class="row form-group">
                    <div class="col-md-5 d-flex justify-content-end font-weight-bold">???????????????????????? :</div>
                    <div class="col-md-6"><?php echo $res['department_name']; ?></div>
                </div>
                <div class="row form-group">
                    <div class="col-md-5 d-flex justify-content-end font-weight-bold">??????????????????????????????????????? :</div>
                    <div class="col-md-6"><?php echo $res['money_source_number']; ?></div>
                </div>
                <div class="row form-group">
                    <div class="col-md-5 d-flex justify-content-end font-weight-bold">??????????????????????????? :</div>
                    <div class="col-md-6"><?php echo $res['money_source_name']; ?></div>
                </div>
                <div class="row form-group">
                    <div class="col-md-5 d-flex justify-content-end font-weight-bold">????????????????????? :</div>
                    <div class="col-md-6"><?php echo $res['placename']; ?></div>
                </div>
                <div class="row form-group">
                    <div class="col-md-5 d-flex justify-content-end font-weight-bold">?????????????????????????????? :</div>
                    <div class="col-md-6"><?php echo $res['year_of_budget']; ?></div>
                </div>
                <div class="row form-group">
                    <div class="col-md-5 d-flex justify-content-end font-weight-bold">?????????????????????????????????????????? :</div>
                    <div class="col-md-6"><?php echo number_format($res['value_asset'], 2), " ?????????"; ?></div>
                </div>
                <div class="row form-group">
                    <div class="col-md-5 d-flex justify-content-end font-weight-bold">?????????????????????????????? :</div>
                    <div class="col-md-6"><?php echo $res['seller_name']; ?></div>
                </div>
                <div class="row form-group">
                    <div class="col-md-5 d-flex justify-content-end font-weight-bold">???????????????????????????????????????????????? :</div>
                    <div class="col-md-6"><?php echo $res['number_delivery']; ?></div>
                </div>
                <div class="row form-group">
                    <div class="col-md-5 d-flex justify-content-end font-weight-bold">????????????????????? :</div>
                    <div class="col-md-6"><?php echo $haveEx ? $res['exporter_name'] : "-" ?></div>
                </div>
                <div class="row form-group">
                    <div class="col-md-5 d-flex justify-content-end font-weight-bold">??????????????????????????????????????? :</div>
                    <div class="col-md-6"><?php echo $haveIm ? $res['importer_name'] : "-" ?></div>
                </div>
                <div class="row form-group">
                    <div class="col-md-5 d-flex justify-content-end font-weight-bold">?????????????????????????????? :</div>
                    <div class="col-md-6"><?php echo DateThai($res['date_pickup']); ?></div>
                </div>
                <div class="row form-group">
                    <div class="col-md-5 d-flex justify-content-end font-weight-bold">??????????????????????????????????????? :</div>
                    <div class="col-md-6"><?php echo DateThai($res['date_admit']); ?></div>
                </div>
                <div class="row form-group">
                    <div class="col-md-5 d-flex justify-content-end font-weight-bold">???????????????????????????????????? :</div>
                    <div class="col-md-6"><?php echo DateThai($res['expiration_date']); ?></div>
                </div>
                <div class="row form-group">
                    <div class="col-md-5 d-flex justify-content-end font-weight-bold">??????????????? :</div>
                    <div class="col-md-6"><?php echo $res['status']; ?></div>
                </div>
                <div class="row form-group">
                    <div class="col-md-5 d-flex justify-content-end font-weight-bold">?????????????????? :</div>
                    <div class="col-md-6"><img src="<?php echo "../../assets/uploads/", $res['image']; ?>" width="50px" alt=""></div>
                </div>
                <div class="row form-group">
                    <div class="col-md-5 d-flex justify-content-end font-weight-bold">QR-CODE :</div>
                    <?php
                    if ($res['qr-code'] == "") {
                    ?>
                        <a href="../../assets/db/asset-detail/generateqrcode.php?id=<?php echo $_id; ?>" class="btn btn-sm btn-primary text-white">??????????????? QR - code</a>
                    <?php
                    } else {
                    ?>
                        <div class="col-md-6"><img src="<?php echo "../../assets/qrcode/" . $res['qr-code']; ?>" width="140px" alt=""></div>
                    <?php
                    }
                    ?>
                </div>
            <?php
                }
            ?>
            <div class='row flex justify-content-center mt-2' style="padding-top: 20px">
                <div class='col-1 d-flex justify-content-center'>
                    <a class='btn btn-sm btn-danger' href="javascript:history.back()"> <span>????????????</span> </a>
                </div>
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

    $strMonthCut = array("", "???.???.", "???.???.", "??????.???.", "??????.???.", "???.???.", "??????.???.", "???.???.", "???.???.", "???.???.", "???.???.", "???.???.", "???.???.");

    $strMonthThai = $strMonthCut[$strMonth];

    return "$strDay $strMonthThai $strYear";
}
?>

<script>
    function approveBorrow(id) {
        $.ajax({
            url: '../../assets/db/borrow-return/approve-borrow-return.php',
            type: 'POST',
            data: {
                id: id
            },
            success: function(data) {
                window.location.href = "./borrow-return-management.php";
            }
        })
    }

    function returnAsset(id) {
        $.ajax({
            url: '../../assets/db/borrow-return/return-asset.php',
            type: 'POST',
            data: {
                id: id
            },
            success: function(data) {
                window.location.href = "./borrow-return-management.php";
            }
        })
    }
</script>
<?php
include "../../assets/config/db.php";
include_once "../layout/masterpage.php";

if (isset($_GET['id'])) {
    $_id = $_GET['id'];
    $db = new db();
    // $stmt = $db->sqlQuery("SELECT a.*,t.assets_types_name,u.unit_name,d.department_name,m.money_source_name,p.placename,pe.personnel_firstname,pe.personnel_lastname,s.staff_firstname,s.staff_lastname FROM `assets` AS a 
    // JOIN `assets_types` as t ON a.assets_types_id = t.id 
    // JOIN `unit` as u ON a.unit_id = u.id 
    // JOIN `department` as d ON a.department_id = d.id 
    // JOIN `money_source` as m ON a.money_source_id = m.id
    // JOIN `place` as p ON a.place_id = p.id
    // JOIN `personnels` as pe ON a.personnel_id = pe.id
    // JOIN `staffs` as s ON a.staff_id = s.id
    // WHERE a.id = $_id");
    // $stmt = $db->sqlQuery("SELECT a.*,t.assets_types_name,u.unit_name,d.department_name,m.money_source_name,p.placename,pe.personnel_firstname,pe.personnel_lastname,s.personnel_firstname,s.personnel_lastname FROM `assets` AS a 
    // JOIN `assets_types` as t ON a.assets_types_id = t.id 
    // JOIN `unit` as u ON a.unit_id = u.id 
    // JOIN `department` as d ON a.department_id = d.id 
    // JOIN `money_source` as m ON a.money_source_id = m.id
    // JOIN `place` as p ON a.place_id = p.id
    // JOIN `personnels` as pe ON a.importer_id = pe.id
    // JOIN `personnels` as s ON a.exporter_id = s.id
    // WHERE a.id = $_id");
    $sql = "SELECT a.* FROM `assets` AS a 
    WHERE a.id = $_id";
    $stmt = $db->sqlQuery($sql);
    $stmt->execute();
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
                $sql .= " ,im.id AS im_id,CONCAT(im.personnel_firstname,' ',im.personnel_lastname) AS importer_name";
                $from .= " JOIN `personnels` as im ON im.id = a.importer_id ";
                $haveIm = true;
            }
            if ($resp['exporter_id']){
                // $sql .= ",ex.personnel_firstname AS exporter_fname,ex.personnel_lastname AS exporter_lname";
                $sql .=" ,ex.id AS ex_id,CONCAT(ex.personnel_firstname,' ',ex.personnel_lastname) AS exporter_name";
                $from .= " JOIN `personnels` as ex ON ex.id = a.exporter_id ";
                $haveEx = true;
            }
            // echo $sql.$from.$where;
            $stmt = $db->sqlQuery($sql.$from.$where);
            $stmt->execute();
            $res = $stmt->fetch(PDO::FETCH_ASSOC);
}
?>
<div class="home-section">
    <div class="home-content">
        <h1>?????????????????????????????????????????????????????????</h1>
        <form action='../../assets/db/asset-detail/add-asset-detail-and-edit.php' method='post' enctype="multipart/form-data">
            <input type="hidden" name='id' value=<?php echo $_id; ?>>
            <div class="form-insert-asset">
                <div class='row flex justify-content-center'>
                    <div class='col-6 width-50 flex justify-center'>
                        <label>?????????????????????????????????</label>
                        <input type='text' name='assetNumber' class='form-control' placeholder='?????????????????????????????????' value=<?php echo $res['assets_number']; ?>>
                    </div>
                    <div class='col-6 width-50 flex justify-center'>
                        <label>????????????????????????????????????</label>
                        <input type='text' name='assetName' class='form-control' placeholder='????????????????????????????????????' value=<?php echo $res['asset_name']; ?>>
                    </div>
                </div>
                <div class='row flex justify-content-center'>
                    <div class='col-3 width-50 flex justify-center'>
                        <label>??????????????????????????????</label>
                        <textarea name="assetDetail" class="form-control" rows="5"> <?php echo $res['detail']; ?></textarea>
                    </div>
                    <div class='col-3 width-50 flex justify-center'>
                        <label>???????????????????????????</label>
                        <textarea name="assetFeature" class="form-control" rows="5"> <?php echo $res['feature']; ?></textarea>
                    </div>
                    <div class='col-3 width-50 flex justify-center'>
                        <label>????????????????????????????????????</label>
                        <input type="text" data-provide="datepicker" data-date-language="th-th" name="dateDelivery" class="form-control" placeholder="dd-mm-yyyy" value=<?php echo $res['date_delivery'] ? DateThai($res['date_delivery']) : null; ?>>
                        <label>????????????????????????????????????</label>
                        <input type="text" data-provide="datepicker" data-date-language="th-th" name="expirationDate" class="form-control" placeholder="dd-mm-yyyy" value=<?php echo $res['expiration_date'] ? DateThai($res['expiration_date']) : null; ?>>
                        <label>??????????????????????????????????????????</label>
                        <input type="text" name="assetValue" class="form-control" placeholder="??????????????????????????????????????????" value=<?php echo $res['value_asset']; ?>>
                    </div>
                    <div class='col-3 width-50 flex justify-center'>
                        <label>???????????????????????????????????????????????????</label>
                        <input type="text" data-provide="datepicker" data-date-language="th-th" name="dateAdmit" class="form-control" placeholder="dd-mm-yyyy" value=<?php echo $res['date_admit'] ? DateThai($res['date_admit']) : null; ?>>
                        <label>??????????????????????????????</label>
                        <input type="text" data-provide="datepicker" data-date-language="th-th" name="datePickup" class="form-control" placeholder="dd-mm-yyyy" value=<?php echo $res['date_pickup'] ? DateThai($res['date_pickup']) : null; ?>>
                        <label>??????????????????????????????????????????</label>
                        <input type="text" name="deliveryNumber" class="form-control" placeholder="??????????????????????????????????????????" value=<?php echo $res['number_delivery']; ?>>
                    </div>
                </div>
                <div class='row flex justify-content-center'>
                    <div class='col-4 width-50 flex justify-center'>
                        <label>??????????????????????????????</label>
                        <input type="text" name="seller" class="form-control" placeholder="??????????????????????????????" value=<?php echo $res['seller_name']; ?>>
                    </div>
                    <div class='col-4 width-50 flex justify-center'>
                        <label>??????????????????????????????????????????</label>
                        <input type="text" name="serialNumber" class="form-control" placeholder="??????????????????????????????????????????" value=<?php echo $res['serial_number']; ?>>
                    </div>
                    <div class='col-4 width-50 flex justify-center'>
                        <label>??????????????????????????????</label>
                        <input type="text" name="yearBudget" class="form-control" placeholder="??????????????????????????????" value=<?php echo $res['year_of_budget']; ?>>
                    </div>
                </div>
                <div class='row flex justify-content-center'>
                    <div class='col-4 width-50 flex justify-center'>
                        <label>?????????????????????</label>
                        <?php
                        $stmt = $db->sqlQuery("SELECT * FROM place");
                        $stmt->execute();
                        echo "<select class='form-control' name='placeId'>";
                        echo "<option value=" . $res['place_id'] . " selected> " . $res['placename'] . "</option>";
                        while ($result = $stmt->fetch(PDO::FETCH_ASSOC)) {
                            $placeId = $result['id'];
                            $placeName = $result['placename'];
                            if (strcmp($res['placename'], $placeName) == 0) {
                            } else {
                                echo "<option value='$placeId'>$placeName</option>";
                            }
                        }
                        echo "</select>"
                        ?>
                    </div>
                    <div class='col-4 width-50 flex justify-center'>
                        <label>???????????????????????????</label>
                        <?php
                        $stmt = $db->sqlQuery("SELECT * FROM money_source");
                        $stmt->execute();
                        echo "<select class='form-control' name='moneySourceId'>";
                        echo "<option value=" . $res['money_source_id'] . " selected> " . $res['money_source_name'] . "</option>";
                        while ($result = $stmt->fetch(PDO::FETCH_ASSOC)) {
                            $moneySourceId = $result['id'];
                            $moneySourceName = $result['money_source_name'];
                            if (strcmp($res['money_source_name'], $moneySourceName) == 0) {
                            } else {
                                echo "<option value='$moneySourceId'>$moneySourceName</option>";
                            }
                        }
                        echo "</select>"
                        ?>
                    </div>
                    <div class='col-4 width-50 flex justify-center'>
                        <label>????????????????????????</label>
                        <?php
                        $stmt = $db->sqlQuery("SELECT * FROM department");
                        $stmt->execute();
                        echo "<select class='form-control' name='departmentId'>";
                        echo "<option value=" . $res['department_id'] . " selected> " . $res['department_name'] . "</option>";
                        while ($result = $stmt->fetch(PDO::FETCH_ASSOC)) {
                            $depId = $result['id'];
                            $depName = $result['department_name'];
                            if (strcmp($res['department_name'], $depName) == 0) {
                            } else {
                                echo "<option value='$depId'>$depName</option>";
                            }
                        }
                        echo "</select>"
                        ?>
                    </div>
                </div>
                <div class='row flex justify-content-center'>
                    <div class='col-4 width-50 flex justify-center'>
                        <label>??????????????????????????????????????????</label>
                        <?php
                        $stmt = $db->sqlQuery("SELECT * FROM assets_types");
                        $stmt->execute();
                        echo "<select class='form-control' name='assetTypeId'>";
                        echo "<option value=" . $res['assets_types_id'] . " selected> " . $res['assets_types_name'] . "</option>";
                        while ($result = $stmt->fetch(PDO::FETCH_ASSOC)) {
                            $assetTypeId = $result['id'];
                            $assetTypeName = $result['assets_types_name'];
                            if (strcmp($res['assets_types_name'], $assetTypeName) == 0) {
                            } else {
                                echo "<option value='$assetTypeId'>$assetTypeName</option>";
                            }
                        }
                        echo "</select>"
                        ?>
                    </div>
                    <div class='col-4 width-50 flex justify-center'>
                        <label>????????????????????????</label>
                        <?php
                        $stmt = $db->sqlQuery("SELECT * FROM unit");
                        $stmt->execute();
                        echo "<select class='form-control' name='unitId'>";
                        echo "<option value=" . $res['unit_id'] . " selected> " . $res['unit_name'] . "</option>";
                        while ($result = $stmt->fetch(PDO::FETCH_ASSOC)) {
                            $unitId = $result['id'];
                            $unitName = $result['unit_name'];
                            if (strcmp($res['unit_name'], $unitName) == 0) {
                            } else {
                                echo "<option value='$unitId'>$unitName</option>";
                            }
                        }
                        echo "</select>"
                        ?>
                    </div>
                    <div class='col-4 width-50 flex justify-center'>
                        <label>???????????????</label>
                        <?php
                        $status = ["??????????????????????????????????????????", "??????????????????????????????", "??????????????????", "?????????????????????????????????????????????", "?????????????????????"];
                        echo " <select class='form-control' name='status'>";
                        echo " <option selected> " . $res['status'] . " </option> ";
                        for ($i = 0; $i < count($status); $i++) {
                            if (strcmp($res['status'], $status[$i]) == 0) {
                            } else {
                                echo "<option value='$status[$i]'>$status[$i]</option>";
                            }
                        }
                        echo "</select>";
                        ?>
                    </div>
                </div>
                <div class='row flex justify-content-center'>
                    <div class='col-4 width-50 flex justify-center'>
                        <label>???????????????????????????????????????</label>
                        <?php
                        $stmt = $db->sqlQuery("SELECT * FROM personnels");
                        $stmt->execute();
                        echo "<select class='form-control' name='staffId'>";
                        if($haveIm){
                            echo "<option value=" . $res['im_id'] . " selected> " . $res['importer_name']."</option>";
                        }
                        else{
                            echo "<option selected>?????????????????????????????????????????????????????? </option>";
                        }
                        while ($result = $stmt->fetch(PDO::FETCH_ASSOC)) {
                            $staffId = $result['id'];
                            $staffName = $result['personnel_firstname'];
                            $staffLastName = $result['personnel_lastname'];
                            if (strcmp($res['importer_name'], $staffName." ".$staffLastName) == 0) {
                            } else {
                                echo "<option value='$staffId'>$staffName $staffLastName</option>";
                            }
                        }
                        echo "</select>"
                        ?>
                    </div>
                    <div class='col-4 width-50 flex justify-center'>
                        <label>?????????????????????</label>
                        <?php
                        $stmt = $db->sqlQuery("SELECT * FROM personnels");
                        $stmt->execute();
                        echo "<select class='form-control' name='personnelId'>";
                        if($haveEx){
                            echo "<option value=" . $res['ex_id'] . " selected> " . $res['exporter_name']. "</option>";
                        }
                        else{
                            echo "<option selected>???????????????????????????????????? </option>";
                        }
                        while ($result = $stmt->fetch(PDO::FETCH_ASSOC)) {
                            $personnelId = $result['id'];
                            $personnelName = $result['personnel_firstname'];
                            $personnelLastName = $result['personnel_lastname'];
                            if (strcmp($res['exporter_name'], $personnelName." ".$personnelLastName) == 0) {
                            } else {
                                echo "<option value='$personnelId'>$personnelName $personnelLastName</option>";
                            }
                        }
                        echo "</select>"
                        ?>
                    </div>
                </div>
                <div class='row flex justify-content-center'>
                    <div class='col-12 width-50 flex justify-center'>
                        <div class="form-group">
                            <label for="exampleFormControlFile1">??????????????????</label>
                            <input type="file" class="form-control-file" name="image" onchange="readURL(this);">
                            <img id="preview" src="<?php echo "../../assets/uploads/". $res['image'] ?>" width="50px" height="auto">
                        </div>
                    </div>
                </div>
                <div class='row flex justify-content-center mt-2' style="padding-top: 20px">
                    <div class='col-1 d-flex justify-content-start' style=''>
                        <a class='btn btn-sm btn-danger' href="javascript:history.back()"> <span>????????????</span> </a>
                    </div>
                    <div class='col-1 d-flex justity-content-end'>
                        <input type='submit' class='btn btn-sm btn-success' name='submit' value='??????????????????'>
                    </div>
                </div>
            </div>
        </form>
    </div>
</div>

<?php
function DateThai($strDate)
{
    $strYear = date("Y", strtotime($strDate)) + 543;

    $strMonth = date("m", strtotime($strDate));

    $strDay = date("d", strtotime($strDate));

    $newdate = "$strDay-$strMonth-$strYear";

    return $newdate;
} ?>

<script>
    $(function() {
        $('.selectpicker').selectpicker();
    });

    function readURL(input) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();
            reader.onload = function(e) {
                $('#preview').attr('src', e.target.result);
            }
            reader.readAsDataURL(input.files[0]);
        }
    }
</script>
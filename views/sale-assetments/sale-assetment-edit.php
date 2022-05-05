<?php
include_once "../layout/masterpage.php";
require "../../assets/config/db.php";
$assets = array();

$db = new db;

if(isset($_GET['id'])){
    $_id = $_GET['id'];
    $stmt = $db->sqlQuery("SELECT a.id AS assets_id,a.assets_number,a.asset_name,se.selling_date,se.detail,se.status,se.staff_id,st.staff_firstname,st.staff_lastname 
    FROM `detail_sells` AS ds JOIN `assets` AS a ON ds.asset_id = a.id 
    JOIN `sells` AS se ON ds.sell_id = se.id 
    JOIN `staffs` AS st ON st.id = se.staff_id 
    WHERE ds.sell_id =" . $_id);
    $stmt->execute();
    $response = $stmt->fetch(PDO::FETCH_ASSOC);
}

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
    <div class="home-content" style="overflow-y: auto; overflow-x: hidden; height:90%;">
        <h1>เพิ่มการจำหน่ายครุภัณฑ์</h1>
        <form action="../../assets/db/selling/add-sell-assetment.php" method="POST">
        <input type="hidden" name='id' value=<?php echo $_id; ?>>
            <table width="100%" id="dynamic_field">
                <tr>
                    <td>
                        <div class="col-12">
                            <label>รหัสครุภัณฑ์</label>
                            <input type="hidden" name="assets_id[]" id="assets-id" value="<?php echo $response['assets_id']; ?>">
                            <input type="search" list="asset-number" id="assets-number" class="form-control" name="assets_number[]" value="<?php echo $response['assets_number']; ?>"/>
                            <datalist id="asset-number">
                                <?php
                                for ($i = 0; $i < count($assets); $i++) {
                                ?>
                                    <option value="<?php echo $assets[$i]['assets_number']; ?>" ><?php echo $assets[$i]['assets_name'] ?></option>
                                <?php
                                }
                                ?>
                            </datalist>
                        </div>
                    </td>
                    <td>
                        <div class="col-12">
                            <label>ชื่อครุภัณฑ์</label>
                            <input type="text" id="assets-name" class="form-control" name="assets_name[]" value="<?php echo $response['asset_name']; ?>" />
                        </div>
                    </td>
                    <td>
                        <div class="col-12 d-flex mt-5 mb-3">
                            <a class="btn btn-primary btn-sm" id="addMore"><i class="bi bi-plus-circle" style="color: #fff;"></i></a>
                        </div>
                    </td>
                </tr>
            </table>
            <div class="row">
                <div class="col-12">
                    <div>
                        <label>รายละเอียดการจำหน่าย/ปัญหา</label>
                    </div>
                    <textarea name="detail" class="form-control" rows="10"><?php echo $response['detail']; ?></textarea>
                </div>
            </div>
            <div class="row">
                <div class="col-6">
                    <label>วันที่แจ้ง</label>
                    <input type="text" data-provide="datepicker" data-date-language="th-th"  id="reportDate" name="date" class="form-control" placeholder="dd-mm-yyyy" value="<?php echo $response['selling_date']; ?>">
                </div>
                <div class="col-6">
                    <div>
                        <label>ชื่อผู้แจ้ง</label>
                    </div>
                    <select name="staff_id" class="form-control">
                        <option selected value="<?php echo $response['staff_id']; ?>"> <?php echo $response['staff_firstname']; ?> </option>
                        <?php
                        $stmt = $db->sqlQuery("SELECT * FROM `staffs`");
                        $stmt->execute();

                        foreach ($stmt->fetchAll() as $res) {
                            if($res['id'] != $response['staff_id']){
                        ?>
                            <option value="<?php echo $res['id']; ?>"><?php echo $res['staff_firstname']; ?></option>
                        <?php
                            }
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
                <!-- <div class='col-1 d-flex justify-content-start'>
                    <button class='btn btn-sm btn-danger' href="javascript:history.back()">กลับ </button>
                </div> -->
                <div class='col-1 d-flex justity-content-center'>
                    <input type='submit' class='btn btn-sm btn-success' name='submit' value='บันทึก'>
                </div>
            </div>
        </form>
    </div>
</div>
<script>
    $(document).ready(function() {
        var i = 0;
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

        $(document).on('change','.searchbox',function (){
            let box_id = $(this).attr('id');
            let result_id = $(".resultbox").attr('id');
            let hide_id = $(".hiddenbox").attr('id');
            assetsData.map((data)=>{
                if($("#"+box_id).val() === data.assets_number){
                    $("#"+result_id.substr(0,result_id.length-1)+box_id.substr(box_id.length-1)).val(data.assets_name);
                    $("#"+hide_id.substr(0,hide_id.length-1)+box_id.substr(box_id.length-1)).val(data.id);
                    return;
                }
            })
        })
        
        $("#addMore").click(function() {
            i++;
            $("#dynamic_field").append('<tr id="row' + i + '"><td><div class="col-12"><input type="hidden" name="assets_id[]" id="assets-id'+i+'" class="hiddenbox"><input type="search" list="asset-number" id="assets-number'+i+'" name="assets_number[]" class="form-control mt-2 mb-2 searchbox"></div></td><td><div class="col-12"><input type="text" id="assets-name'+i+'" name="assets_name[]" class="form-control mt-2 mb-2 resultbox"></div></td><td><div class="col-12"><a class="btn btn-danger btn-sm mt-2 mb-2 btn_remove" style="color:#fff;" id="' + i + '"><i class="bi bi-x-circle"></i></a></div></td>');
        })

        $(document).on('click','.btn_remove', function (){
            let btn_id = $(this).attr('id');
            $('#row'+btn_id+'').remove();
        })

    });
</script>
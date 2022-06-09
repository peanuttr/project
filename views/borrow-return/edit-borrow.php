<?php
include_once "../layout/masterpage.php";
require "../../assets/config/db.php";
$assets = array();

$db = new db;

if (isset($_GET['id'])) {
    $_id = $_GET['id'];
    $stmt = $db->sqlQuery("SELECT a.id AS assets_id,a.assets_number,a.asset_name,dbr.borrow_and_return_id,dbr.place_id,br.borrow_date,br.return_date,br.detail,br.personel_id,br.staff_id,p.personnel_firstname,p.personnel_lastname,s.staff_firstname,s.staff_lastname,pl.placename,dbr.place_id,br.staff_id,br.personel_id 
    FROM `detail_borrow_and_return` AS dbr 
    JOIN `assets` AS a ON dbr.asset_id = a.id 
    JOIN `borrow_and_return` AS br ON dbr.borrow_and_return_id = br.id 
    JOIN `personnels` AS p ON br.personel_id = p.id 
    JOIN `staffs` AS s ON br.staff_id = s.id
    JOIN `place` AS pl ON dbr.place_id = pl.id
    WHERE dbr.borrow_and_return_id = " . $_id);
    $stmt->execute();
    $response = $stmt->fetchAll();

    // print_r($response);

    // $countId = count($response['assets_id']);

    // echo "จำนวน ".count($response['assets_id']);
}

$stmt = $db->sqlQuery("SELECT a.*,t.assets_types_name,u.unit_name,d.department_name,m.money_source_name FROM `assets` AS a 
                        JOIN `assets_types` as t ON a.assets_types_id = t.id 
                        JOIN `unit` as u ON a.unit_id = u.id 
                        JOIN `department` as d ON a.department_id = d.id 
                        JOIN `money_source` as m ON a.money_source_id = m.id
                        WHERE a.status = 'รออนุมัติการยืม'");
$stmt->execute();

foreach ($stmt->fetchAll() as $res) {
    array_push($assets, ['id' => $res['id'], 'assets_number' => $res['assets_number'], 'assets_name' => $res['asset_name']]);
}
?>
<div class="home-section">
    <div class="home-content" style="overflow-y: auto; height:90%; overflow-x: hidden;">
        <h1>แก้ไขข้อมูลการยืมครุภัณฑ์</h1>
        <form action="../../assets/db/borrow-return/edit-borrow.php" method="POST" enctype="multipart/form-data">
            <input type="hidden" name='id' value=<?php echo $_id; ?>>
            <div class="row">
                <div class="col-3">
                    <div>
                        <label>ชื่อผู้ยืม</label>
                    </div>
                    <select name="personnel_id" class="form-control">
                        <option selected value="<?php echo $response[0]['personel_id']; ?>"> <?php echo $response[0]['personnel_firstname']; ?> </option>
                        <?php
                        $stmt = $db->sqlQuery("SELECT * FROM `personnels`");
                        $stmt->execute();

                        foreach ($stmt->fetchAll() as $res) {
                            if ($res['id'] !=  $response[0]['personel_id']) {
                        ?>
                                <option value="<?php echo $res['id']; ?>"><?php echo $res['personnel_firstname']; ?></option>
                        <?php
                            }
                        }
                        ?>
                    </select>
                </div>
                <table width="100%" id="dynamic_field">
                    <tr>
                        <td>
                            <div class="col-12">
                                <label>รหัสครุภัณฑ์</label>
                                <input type="hidden" name="assets_id[]" id="assets-id" value="<?php echo $response[0]['assets_id']; ?>">
                                <input type="search" list="asset-number" id="assets-number" class="form-control" name="assets_number[]" value="<?php echo $response[0]['assets_number']; ?>" disabled />
                                <datalist id="asset-number">
                                    <?php
                                    for ($i = 0; $i < count($assets); $i++) {
                                    ?>
                                        <option value="<?php echo $assets[$i]['assets_number']; ?>"><?php echo $assets[$i]['assets_name'] ?></option>
                                    <?php
                                    }
                                    ?>
                                </datalist>
                            </div>
                        </td>
                        <td>
                            <div class="col-12">
                                <label>ชื่อครุภัณฑ์</label>
                                <input type="text" id="assets-name" class="form-control" name="assets_name[]" value="<?php echo $response[0]['asset_name']; ?>" disabled />
                            </div>
                        </td>
                        <td>
                            <div class="col-12 d-flex mt-5 mb-3">
                                <a class="btn btn-primary btn-sm" id="addMore"><i class="bi bi-plus-circle" style="color: #fff;"></i></a>
                            </div>
                        </td>
                    </tr>
                </table>
            </div>
            <div class="row">
                <div class="col-3">
                    <label>วันที่ยืม</label>
                    <input type="text" data-provide="datepicker" data-date-language="th-th" id="borrowDate" name="borrowDate" class="form-control" placeholder="dd-mm-yyyy" value="<?php echo DateThai($response[0]['borrow_date']); ?>">
                </div>
                <div class="col-3">
                    <label>วันที่คืน</label>
                    <input type="text" data-provide="datepicker" data-date-language="th-th" id="returnDate" name="returnDate" class="form-control" placeholder="dd-mm-yyyy" value="<?php echo DateThai($response[0]['return_date']); ?>">
                </div>
                <div class="col-3">
                    <div>
                        <label>ชื่อเจ้าหน้าที่</label>
                    </div>
                    <select name="staff_id" class="form-control">
                        <option selected value="<?php echo $response[0]['staff_id']; ?>"> <?php echo $response[0]['staff_firstname']; ?> </option>
                        <?php
                        $stmt = $db->sqlQuery("SELECT * FROM `staffs`");
                        $stmt->execute();

                        foreach ($stmt->fetchAll() as $res) {
                            if ($res['id'] !=  $response[0]['staff_id']) {
                        ?>
                                <option value="<?php echo $res['id']; ?>"><?php echo $res['staff_firstname']; ?></option>
                        <?php
                            }
                        }
                        ?>
                    </select>
                </div>
                <div class="col-3">
                    <div>
                        <label>สถานที่</label>
                    </div>
                    <select name="place_id" class="form-control">
                        <option selected value="<?php echo $response[0]['place_id']; ?>"> <?php echo $response[0]['placename']; ?> </option>
                        <?php
                        $stmt = $db->sqlQuery("SELECT * FROM `place`");
                        $stmt->execute();

                        foreach ($stmt->fetchAll() as $res) {
                            if ($res['id'] !=  $response[0]['place_id']) {
                        ?>
                                <option value="<?php echo $res['id']; ?>"><?php echo $res['placename']; ?></option>
                        <?php
                            }
                        }
                        ?>
                    </select>
                </div>
            </div>
            <div class="row">
                <div class="col-12">
                    <div>
                        <label>รายละเอียดการยืม</label>
                    </div>
                    <textarea name="detail" class="form-control" rows="10"><?php echo $response[0]['detail']; ?></textarea>
                </div>
            </div>
            <div class='row flex justify-content-center mt-2'>
                <div class='col-1 d-flex justify-content-start'>
                    <a class='btn btn-sm btn-danger' href="javascript:history.back()"> <span>กลับ</span> </a>
                </div>
                <div class='col-1 d-flex justity-content-center'>
                    <input type='submit' class='btn btn-sm btn-success' name='submit' value='บันทึก'>
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

        $(document).on('change', '.searchbox', function() {
            let box_id = $(this).attr('id');
            let result_id = $(".resultbox").attr('id');
            let hide_id = $(".hiddenbox").attr('id');
            assetsData.map((data) => {
                if ($("#" + box_id).val() === data.assets_number) {
                    $("#" + result_id.substr(0, result_id.length - 1) + box_id.substr(box_id.length - 1)).val(data.assets_name);
                    $("#" + hide_id.substr(0, hide_id.length - 1) + box_id.substr(box_id.length - 1)).val(data.id);
                    return;
                }
            })
        })

        var countId = <?php echo count($response); ?>;
        console.log(<?php echo $response[1]['assets_number']; ?>);
        console.log(<?php echo $response[0]['assets_number']; ?>);
        for (var i = 0; i < countId - 1; i++) {
            <?php
            $i = 0;
            ?>
            $("#dynamic_field").append('<tr id="row' + (i + 1) + '"><td><div class="col-12"><input type="hidden" name="assets_id[]" id="assets-id' + (i + 1) + '" class="hiddenbox" value="<?php echo $response[($i + 1)]['assets_id']; ?>"><input type="search" list="asset-number" id="assets-number' + (i + 1) + '" name="assets_number[]" class="form-control mt-2 mb-2 searchbox" value="<?php echo $response[($i + 1)]['assets_number']; ?>" disabled></div></td><td><div class="col-12"><input type="text" id="assets-name' + (i + 1) + '" name="assets_name[]" class="form-control mt-2 mb-2 resultbox" value="<?php echo $response[($i + 1)]['asset_name']; ?>" disabled></div></td><td><div class="col-12"><a class="btn btn-danger btn-sm mt-2 mb-2 btn_remove" style="color:#fff;" id="' + (i + 1) + '"><i class="bi bi-x-circle"></i></a></div></td>');
            <?php
            $i++;
            ?>
        }

        $("#addMore").click(function() {
            i++;
            $("#dynamic_field").append('<tr id="row' + i + '"><td><div class="col-12"><input type="hidden" name="assets_id[]" id="assets-id' + i + '" class="hiddenbox"><input type="search" list="asset-number" id="assets-number' + i + '" name="assets_number[]" class="form-control mt-2 mb-2 searchbox"></div></td><td><div class="col-12"><input type="text" id="assets-name' + i + '" name="assets_name[]" class="form-control mt-2 mb-2 resultbox"></div></td><td><div class="col-12"><a class="btn btn-danger btn-sm mt-2 mb-2 btn_remove" style="color:#fff;" id="' + i + '"><i class="bi bi-x-circle"></i></a></div></td>');
        })

        $(document).on('click', '.btn_remove', function() {
            let btn_id = $(this).attr('id');
            $('#row' + btn_id + '').remove();
        })

        $("#borrowDate").datepicker({
            language: 'th-th',
            format: 'dd-mm-yyyy',
            autoclose: true,
        });

        $("#returnDate").datepicker({
            language: 'th-th',
            format: 'dd-mm-yyyy',
            autoclose: true,
        });

    });
</script>
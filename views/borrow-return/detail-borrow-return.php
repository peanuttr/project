<?php
include "../../assets/config/db.php";
include_once "../layout/masterpage.php";

$db = new db();
if (isset($_GET['id'])) {
    $_id = $_GET['id'];
    $stmt = $db->sqlQuery("SELECT brd.*,s.staff_firstname,s.staff_lastname,p.personnel_firstname,p.personnel_lastname,pl.placename,a.asset_name,a.assets_number,br.borrow_date,br.return_date,br.detail
                FROM `detail_borrow_and_return` AS brd
                            JOIN `borrow_and_return` as br ON brd.borrow_and_return_id = br.id
                            JOIN `staffs` as s ON br.staff_id = s.id 
                            JOIN `personnels` as p ON br.personel_id = p.id 
                            JOIN `place` as pl ON brd.place_id = pl.id 
                            JOIN `assets` as a ON brd.asset_id = a.id 
                            WHERE brd.borrow_and_return_id = " . $_id);
    $stmt->execute();
    $response = $stmt->fetch(PDO::FETCH_ASSOC);
    $_SESSION['asset_id'] = array();
    $assetId = [];
    $index = 0;
    if (!$response) {
?>
        <script>
            window.history.back();
        </script>
    <?php
    }
    ?>
    <div class="home-section">
        <div class="home-content" style="overflow-y: auto; overflow-x: hidden; height:95%; width:auto">
            <h1 style="padding-left: 10%; padding-bottom: 2%">รายละเอียดการยืม - คืนครุภัณฑ์</h1>
            <div class="row form-group d-flex justify-content-center">
                <table id="myTable">
                    <thead>
                        <th>เลขครุภัณฑ์</th>
                        <th>ชื่อครุภัณฑ์</th>
                        <th>สถานะ</th>
                    </thead>
                    <tbody>
                        <?php
                        $stmt->execute();
                        while ($res = $stmt->fetch(PDO::FETCH_ASSOC)) {
                        ?>
                            <!-- <div class="row form-group">
                    <div class="col-md-5 d-flex justify-content-end">เลขครุภัณฑ์ : </div>
                    <div class="col-md-6"><?php echo $res['assets_number']; ?></div>
                </div>
                <div class="row form-group">
                    <div class="col-md-5 d-flex justify-content-end">ชื่อครุภัณฑ์ :</div>
                    <div class="col-md-6"><?php echo $res['asset_name']; ?></div>
                </div>
                <div class="row form-group">
                    <div class="col-md-5 d-flex justify-content-end">สถานะ :</div>
                    <div class="col-md-6"><?php echo $res['status']; ?></div>
                </div> -->
                            <tr>
                                <td><?php echo $res['assets_number']; ?></td>
                                <td><?php echo $res['asset_name']; ?></< /td>
                                <td><?php echo $res['status']; ?></< /td>
                            </tr>
                        <?php
                            $assetId[$index] = $res['asset_id'];
                            array_push($_SESSION['asset_id'], $assetId[$index]);
                            $index += 1;
                        }
                        ?>
                    </tbody>
                </table>
            </div>
            <div class="row form-group">
                <div class="col-md-5 d-flex justify-content-end">วันที่ยืม :</div>
                <div class="col-md-6"><?php echo DateThai($response['borrow_date']) ?></div>
            </div>
            <div class="row form-group">
                <div class="col-md-5 d-flex justify-content-end">วันที่คืน :</div>
                <div class="col-md-6"><?php echo DateThai($response['return_date']) ?></div>
            </div>
            <div class="row form-group">
                <div class="col-md-5 d-flex justify-content-end">สถานที่ :</div>
                <div class="col-md-6"><?php echo $response['placename']; ?></div>
            </div>
            <div class="row form-group">
                <div class="col-md-5 d-flex justify-content-end">รายละเอียด :</div>
                <div class="col-md-6"><?php echo $response['detail']; ?></div>
            </div>
            <div class="row form-group">
                <div class="col-md-5 d-flex justify-content-end">ชื่อ-นามสกุลผู้ยืม :</div>
                <div class="col-md-6"><?php echo $response['personnel_firstname'] . " " . $response['personnel_lastname']; ?></div>
            </div>
            <div class="row form-group">
                <div class="col-md-5 d-flex justify-content-end">ชื่อ-นามสกุลเจ้าหน้าที่ :</div>
                <div class="col-md-6"><?php echo $response['staff_firstname'] . " " . $response['staff_lastname']; ?></div>
            </div>
            <div class='row flex justify-content-center mt-2' style="padding-top: 20px">
                <div class='col-1 d-flex justify-content-start'>
                    <a class='btn btn-sm btn-danger' href="javascript:history.back()"> <span>กลับ</span> </a>
                </div>
                <?php
                if ($response['status'] == "รออนุมัติ") {
                    echo "<div class='col-1 d-flex justity-content-end'>";
                    echo "<a class='btn btn-sm btn-success' onclick='approveBorrow($response[borrow_and_return_id])'><span>อนุมัติ</span></a>";
                    echo "</div>";
                    echo "<div class='col-1 d-flex justity-content-end'>";
                    echo "<a class='btn btn-sm btn-danger text-white' onclick='rejectBorrow($response[borrow_and_return_id])'>ไม่อนุมัติ</a>";
                    echo "</div>";
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
    // $(document).ready(function() {
    //     var table = $('#myTable').DataTable({
    //         "lengthMenu": [5, 10]
    //     });
    //     //     $('#myTable tbody').on('click', 'tr', function () {
    //     //     var data = table.row( this ).data();
    //     //     alert( 'You clicked on '+data[1]+'\'s row' );
    //     // } );
    // });
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

    function rejectBorrow(id) {
        $.ajax({
            url: '../../assets/db/borrow-return/reject-borrow-return.php',
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
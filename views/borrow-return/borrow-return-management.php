<?php
include_once "../layout/masterpage.php";
require "../../assets/config/db.php";
$db = new db();
$stmt = $db->sqlQuery("SELECT id  FROM borrow_and_return ORDER BY id ASC" );
$stmt->execute();
$idBorrow = $stmt->fetchAll();
// print_r($idBorrow);
$countAll = array();
$countReturn = array();
$status = array();
for($i = 0 ; $i < count($idBorrow); $i++){
    // echo $idBorrow[$i]['id']."<br>";

    $stmt = $db->sqlQuery("SELECT COUNT(*) AS countById FROM `detail_borrow_and_return` WHERE `borrow_and_return_id` = ".$idBorrow[$i]['id']);
    $stmt->execute();
    while($res = $stmt->fetch(PDO::FETCH_ASSOC)){
        array_push($countAll,$res['countById']);
    }
    $stmt = $db->sqlQuery("SELECT COUNT(*) AS countByStatus FROM `detail_borrow_and_return` WHERE `borrow_and_return_id` = ".$idBorrow[$i]['id']." AND `status` LIKE '%คืนแล้ว%' ");
    $stmt->execute();
    while($res = $stmt->fetch(PDO::FETCH_ASSOC)){
        array_push($countReturn,$res['countByStatus']);
    }

    if($countAll[$i] == $countReturn[$i]){
        array_push($status,'คืนครุภัณฑ์ครบแล้ว');
    }
    else if($countAll[$i] > $countReturn[$i]){
        array_push($status,'คืนครุภัณฑ์ไม่ครบ');
    }
}
// print_r($countAll);
// echo "<br>";
// print_r($countReturn);
// echo "<br>";
// print_r($status);
?>
<div class="home-section">
    <div class="home-content">
        <h1> จัดการข้อมูลการยืม - คืนครุภัณฑ์ </h1>
        <table id="myTable" style='font-size:14px; width: 100%; text-align:center; border:1px;' class='table table-striped '>
            <thead>
                <tr>
                    <th>เลขที่การยืม</th>
                    <th>ครุภัณฑ์ที่ยืม</th>
                    <th>ผู้ยืม</th>
                    <th>เจ้าหน้าที่</th>
                    <th>รายละเอียด</th>
                    <th>วันที่ยืม</th>
                    <th>วันที่คืน</th>
                    <th>สถานะ</th>
                    <th>การดำเนินการ</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $stmt = $db->sqlQuery("SELECT br.*,p.personnel_firstname, s.staff_firstname FROM borrow_and_return as br
                JOIN personnels as p ON p.id = br.personel_id
                JOIN staffs as s ON s.id = br.staff_id ORDER BY br.id ASC");
                $stmt->execute();
                $i = 0;
                while ($result = $stmt->fetch(PDO::FETCH_ASSOC)) {
                    // $stmt = $db->sqlQuery("SELECT COUNT(borrow_and_return_id) as countBorrow FROM `detail_borrow_and_return` WHERE borrow_and_return_id = ".$result['id']." AND status LIKE '%คืนแล้ว%'");
                    // $stmt->execute();
                    // $contBorrow = $stmt->fetch(PDO::FETCH_ASSOC);
                    // echo $contBorrow;
                ?>
                    <tr>
                        <td><?php echo  'BORROW_'.$result['number_borrow']; ?></td>
                        <td>
                            <?php
                            $stmt2 = $db->sqlQuery("SELECT dbr.*,a.asset_name FROM detail_borrow_and_return as dbr
                                                    JOIN assets as a ON a.id = dbr.asset_id
                                                    WHERE dbr.borrow_and_return_id = " . $result['id']);
                            $stmt2->execute();
                            while ($res = $stmt2->fetch(PDO::FETCH_ASSOC)) {
                                echo $res['asset_name'];
                                echo "</br>";
                            ?>
                            <?php
                            }
                            ?>
                        </td>
                        <td><?php echo $result['personnel_firstname']; ?></td>
                        <td><?php echo $result['staff_firstname']; ?></td>
                        <td><?php echo $result['detail']; ?></td>
                        <td><?php echo DateThai($result['borrow_date']) ?></td>
                        <td><?php echo DateThai($result['return_date']) ?></td>
                        <!-- <td><?php echo $result['status'] ?></td> -->
                        <td><?php if($result['status'] == 'อนุมัติ'){
                            echo $status[$i];
                        }
                        else{
                            echo  $result['status'];
                        }
                        ?></td>
                        <td>
                            <?php
                            if ($result['status'] == 'รออนุมัติ' && $_SESSION['status'] == "staff") {
                            ?>
                                <!-- <a class='btn btn-sm btn-warning text-white' href='./edit-borrow.php?id=<?php echo $result['id'] ?>'>
                                    <i class='bx bx-edit'></i>
                                </a> -->
                                <a class='del btn btn-sm btn-danger' onclick="removeBorrow('<?php echo $result['id']; ?>')">
                                    <i class='bx bx-trash'></i>
                                </a>

                            <?php
                            }
                            if ($result['status'] == 'รออนุมัติ' && $_SESSION['status'] == "staff") {
                            ?>
                                <a class="btn btn-primary btn-sm text-white" href="../../assets/db/report/report-pdf-borrow.php?id=<?php echo $result['id']; ?>"><i class="bi bi-printer-fill"></i></a>
                            <?php
                            }
                            if ($_SESSION['status'] != "staff") {
                            ?>
                                <a class="btn btn-primary btn-sm text-white" href="./detail-borrow-return.php?id=<?php echo $result['id'] ?>"><i class="bi bi-info-square-fill"></i></a>
                            <?php
                            }
                            ?>
                        </td>
                    </tr>
                <?php
                $i++;
                }
                ?>
            </tbody>
        </table>
    </div>
</div>

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
    $(document).ready(function() {
        var table = $('#myTable').DataTable({
            "lengthMenu": [5, 10],
            order: [[0, 'desc']]
        });
    });

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

    function removeBorrow(id) {
        var result = confirm("คุณต้องการจะลบข้อมูลนี้ใช่หรือไม่");
        if (result) {
            $.ajax({
                url: '../../assets/db/borrow-return/del-borrow.php',
                type: 'POST',
                data: {
                    id: id
                },
                success: function(data) {
                    data.substr(0,6) == "<br />" ? alert('ไม่สามารถลบข้อมูลได้') : window.location.href = "./borrow-return-management.php";
                }
            })
        }
    }
</script>
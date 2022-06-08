<?php
include_once "../layout/masterpage.php";
?>
<div class="home-section">
    <div class="home-content">
        <h1>จัดการข้อมูลแจ้งซ่อม</h1>
        <table id="myTable" style='font-size:14px; width: 100%; text-align:center; border:1px;' class='table table-striped '>
            <thead>
                <tr>
                    <th>เลขที่ใบแจ้งซ่อม</th>
                    <th>ครุภัณฑ์ที่แจ้งซ่อม</th>
                    <th>ผู้แจ้งซ่อม</th>
                    <th>รายละเอียด</th>
                    <th>วันที่แจ้งซ่อม</th>
                    <th>สถานะแจ้งซ่อม</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <?php
                require "../../assets/config/db.php";
                $db = new db();
                $stmt = $db->sqlQuery("SELECT r.*,p.personnel_firstname,p.personnel_lastname FROM repair_notice as r 
                JOIN personnels as p ON p.id = r.personel_id ORDER BY r.id ASC ");
                $stmt->execute();
                while ($result = $stmt->fetch(PDO::FETCH_ASSOC)) {
                ?>
                    <tr>
                        <td><?php echo "REPAIR_" . $result['id']; ?></td>
                        <td>
                            <?php
                            $stmt2 = $db->sqlQuery("SELECT drn.*,a.asset_name FROM detail_repair_notice as drn
                                                    JOIN assets as a ON a.id = drn.asset_id
                                                    WHERE drn.repair_id = " . $result['id']);
                            $stmt2->execute();
                            while ($res = $stmt2->fetch(PDO::FETCH_ASSOC)) {
                                echo $res['asset_name'];
                                echo "</br>";
                            ?>
                            <?php
                            }
                            ?>
                        </td>
                        <td><?php echo $result['personnel_firstname'] . " " . $result['personnel_lastname']; ?></td>
                        <td><?php echo $result['detail']; ?></td>
                        <td><?php echo DateThai($result['date_notice']); ?></td>
                        <td><?php
                            if ($result['status'] == 1) {
                                echo "แจ้งซ่อม";
                            } else if ($result['status'] == 2) {
                                echo "ดำเนินการซ่อม";
                            } else if ($result['status'] == 3) {
                                echo "ซ่อมสำเร็จ";
                            } else if ($result['status'] == 0) {
                                echo "ไม่อนุมัติ";
                            }
                            ?>
                        </td>
                        <td>
                            <?php
                            if ($result['status'] == 1 && $_SESSION['status'] != "staff") {
                            ?>
                                <a class="btn btn-sm btn-warning text-white" href="./repair-assetments-edit.php?id=<?php echo $result['id'] ?>"><i class='bx bx-edit'></i></a>
                                <a class="btn btn-danger btn-sm text-white" onclick="deleteRepair(<?php echo $result['id'] ?>)"><i class='bx bx-trash'></i></a>
                            <?php
                            }
                            if ($result['status'] == 1 && $_SESSION['status'] == "staff") {
                            ?>
                                <a class="btn btn-primary btn-sm text-white" href="../../assets/db/report/report-pdf-repair.php?id=<?php echo $result['id']; ?>"><i class="bi bi-printer-fill"></i></a>
                            <?php
                            }
                            ?>
                            <?php if ($_SESSION['status'] != "staff") {
                            ?>
                                <a class="btn btn-primary btn-sm text-white" href="./detail-repair-asset.php?id=<?php echo $result['id'] ?>"><i class="bi bi-info-square-fill"></i></a>
                            <?
                            }
                            ?>
                        </td>
                    </tr>
                <?php
                }
                ?>
            </tbody>
        </table>
    </div>
</div>
<?php
function DateThai($strDate)
{
    $strYear = date("Y", strtotime($strDate));

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
            columnDefs: [{
                type: 'natural',
                targets: 0
            }]
        });
    })

    function deleteRepair(repair_id) {
        var result = confirm("คุณต้องการจะลบข้อมูลนี้ใช่หรือไม่");
        if (result) {
            $.ajax({
                url: '../../assets/db/repair-assetments/delete-repair-assetment.php',
                type: 'POST',
                data: {
                    id: repair_id
                },
                success: function(data) {
                    window.location.href = "./repair-assetments-manage.php"
                }
            })
        }
    }
</script>
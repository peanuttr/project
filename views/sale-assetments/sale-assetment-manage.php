<?php
include_once "../layout/masterpage.php";
?>
<div class="home-section">
    <div class="home-content">
        <h1>จัดการข้อมูลจำหน่ายครุภัณฑ์</h1>
        <table id="myTable" style='font-size:14px; width: 100%; text-align:center; border:1px;' class='table table-striped '>
            <thead>
                <tr>
                    <th>เลขที่แจ้งจำหน่าย</th>
                    <th>ครุภัณฑ์ทีจำหน่าย</th>
                    <th>ผู้แจ้งจำหน่าย</th>
                    <th>รายละเอียด</th>
                    <th>วันที่แจ้งจำหน่าย</th>
                    <th>สถานะแจ้งจำหน่าย</th>
                    <th>การดำเนินการ</th>
                </tr>
            </thead>
            <tbody>
                <?php
                require "../../assets/config/db.php";
                $db = new db();
                $stmt = $db->sqlQuery("SELECT se.*,st.staff_firstname,st.staff_lastname FROM sells as se
                JOIN staffs as st ON st.id = se.staff_id ORDER BY se.id ASC ");
                $stmt->execute();
                while ($result = $stmt->fetch(PDO::FETCH_ASSOC)) {
                ?>
                    <tr>
                        <td><?php echo "SELLING_" . $result['id']; ?></td>
                        <td>
                            <?php
                            $stmt2 = $db->sqlQuery("SELECT ds.*,a.asset_name FROM detail_sells as ds
                                                    JOIN assets as a ON a.id = ds.asset_id
                                                    WHERE ds.sell_id = " . $result['id']);
                            $stmt2->execute();
                            while ($res = $stmt2->fetch(PDO::FETCH_ASSOC)) {
                                echo $res['asset_name'];
                                echo "</br>";
                            ?>
                            <?php
                            }
                            ?>
                        </td>
                        <td><?php echo $result['staff_firstname'] . " " . $result['staff_lastname']; ?></td>
                        <td><?php echo $result['detail']; ?></td>
                        <td><?php echo DateThai($result['selling_date']); ?></td>
                        <td><?php
                            if ($result['status'] == 1) {
                                echo "แจ้งจำหน่าย";
                            } else if ($result['status'] == 2) {
                                echo "ดำเนินการจำหน่าย";
                            } else if ($result['status'] == 3) {
                                echo "จำหน่ายสำเร็จ";
                            } else if ($result['status'] == 0) {
                                echo "ไม่อนุมัติ";
                            }
                            ?>
                        </td>
                        <td>
                            <?php
                            if ($result['status'] == 1 && $_SESSION['status'] == "staff") {
                            ?>
                                <a class="btn btn-sm btn-warning text-white" href="./sale-assetment-edit.php?id=<?php echo $result['id'] ?>"><i class='bx bx-edit'></i></a>
                                <a class="btn btn-danger btn-sm text-white" onclick="deleteSell(<?php echo $result['id'] ?>)"><i class='bx bx-trash'></i></a>
                            <?php
                            }
                            ?>
                            <?php if ($_SESSION['status'] != "staff") {
                            ?>
                                <a class="btn btn-primary btn-sm text-white" href="./detail-sale-asset.php?id=<?php echo $result['id'] ?>"><i class="bi bi-info-square-fill"></i></a>
                            <?php
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
            columnDefs: [{
                type: 'natural',
                targets: 0
            }]
        });
    })

    function deleteSell(sell_id) {
        var result = confirm("คุณต้องการจะลบข้อมูลนี้ใช่หรือไม่");
        if (result) {
            $.ajax({
                url: '../../assets/db/selling/delete-sell-assetment.php',
                type: 'POST',
                data: {
                    id: sell_id
                },
                success: function(data) {
                    window.location.href = "./sale-assetment-manage.php"
                }
            })
        }
    }
</script>
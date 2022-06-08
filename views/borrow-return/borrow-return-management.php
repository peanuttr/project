<?php
include_once "../layout/masterpage.php";
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
                    <th>action</th>
                </tr>
            </thead>
            <tbody>
                <?php
                require "../../assets/config/db.php";
                $db = new db();
                $stmt = $db->sqlQuery("SELECT br.*,p.personnel_firstname, s.staff_firstname FROM borrow_and_return as br
                JOIN personnels as p ON p.id = br.personel_id
                JOIN staffs as s ON s.id = br.staff_id");
                $stmt->execute();
                $number = 1;
                while ($result = $stmt->fetch(PDO::FETCH_ASSOC)) {
                ?>
                    <tr>
                        <td><?php echo "BORROW_", $number ?></td>
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
                        <td><?php echo $result['status'] ?></td>
                        <td>
                            <?php
                            if ($result['status'] == 'รออนุมัติ' && $_SESSION['status'] != "staff") {
                            ?>
                                <a class='btn btn-sm btn-warning text-white' href='./edit-borrow.php?id=<?php echo $result['id'] ?>'>
                                    <i class='bx bx-edit'></i>
                                </a>
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
                    $number += 1;
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
            "lengthMenu": [5, 10]
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
                    window.location.href = "./borrow-return-management.php";
                }
            })
        }
    }
</script>
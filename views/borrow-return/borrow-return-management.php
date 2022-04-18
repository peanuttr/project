<?php
include_once "../layout/masterpage.php";
?>
<div class="home-section">
    <div class="home-content">
        <h1> การจัดการยืม-คืนครุภัณฑ์ </h1>
        <table id="myTable" style='font-size:14px; width: 100%; text-align:center; border:1px;' class='table table-striped '>
            <thead>
                <tr>
                    <th>ลำดับ</th>
                    <th>ชื่อครุภัณฑ์</th>
                    <th>สถานที่</th>
                    <th>รายละเอียด</th>
                    <th>เจ้าหน้าที่</th>
                    <th>บุคลากร</th>
                    <th>วันที่ยืม</th>
                    <th>วันที่คืน</th>
                    <th>action</th>
                </tr>
            </thead>
            <tbody>
                <?php
                require "../../assets/config/db.php";
                $db = new db();
                $stmt = $db->sqlQuery("SELECT brd.*,s.staff_firstname,p.personnel_firstname,pl.placename,a.asset_name,br.borrow_date,br.return_date,br.detail
                FROM `detail_borrow_and_return` AS brd
                            JOIN `borrow_and_return` as br ON brd.borrow_and_return_id = br.id
                            JOIN `staffs` as s ON br.staff_id = s.id 
                            JOIN `personnels` as p ON br.personel_id = p.id 
                            JOIN `place` as pl ON brd.place_id = pl.id 
                            JOIN `assets` as a ON brd.asset_id = a.id");
                $stmt->execute();
                $number = 1;
                while ($result = $stmt->fetch(PDO::FETCH_ASSOC)) {
                ?>
                    <tr>
                        <td><?php echo $number ?></td>
                        <td><?php echo $result['asset_name']; ?></td>
                        <td><?php echo $result['placename']; ?></td>
                        <td><?php echo $result['detail']; ?></td>
                        <td><?php echo $result['staff_firstname']; ?></td>
                        <td><?php echo $result['personnel_firstname']; ?></td>
                        <td><?php echo DateThai($result['borrow_date']) ?></td>
                        <td><?php echo DateThai($result['return_date']) ?></td>
                        <td>
                            <a class="btn btn-primary btn-sm text-white" href="./detail-repair-asset.php?id=<?php echo $result['id'] ?>">view</a>
                            <a class="btn btn-sm btn-warning text-white">edit</a>
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
} ?>

<script>
    $(document).ready(function() {
        var table = $('#myTable').DataTable({
            "lengthMenu": [5, 10]
        });
    });

    function removeAsset(id) {
        var result = confirm("Want to delete?");
        if (result) {
            $.ajax({
                url: '../../assets/db/borrow-return/del-borrow-return.php',
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
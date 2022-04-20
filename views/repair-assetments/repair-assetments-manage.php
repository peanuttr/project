<?php
include_once "../layout/masterpage.php";
?>
<div class="home-section">
    <div class="home-content">
        <h1>การจัดการรายการแจ้งซ่อม</h1>
        <table id="myTable" style='font-size:14px; width: 100%; text-align:center; border:1px;' class='table table-striped '>
            <thead>
                <tr>
                    <th>เลขที่ใบแจ้งซ่อม</th>
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
                $stmt = $db->sqlQuery("SELECT r.*,p.personnel_firstname FROM repair_notice as r 
                JOIN personnels as p ON p.id = r.personel_id ORDER BY r.id ASC ");
                $stmt->execute();
                while ($result = $stmt->fetch(PDO::FETCH_ASSOC)) {
                ?>
                    <tr>
                        <td><?php echo "REPAIR_" . $result['id']; ?></td>
                        <td><?php echo $result['personnel_firstname']; ?></td>
                        <td><?php echo $result['detail']; ?></td>
                        <td><?php echo $result['date_notice']; ?></td>
                        <td><?php
                            if ($result['status'] == 1) {
                                echo "แจ้งซ่อม";
                            } else if ($result['status'] == 2) {
                                echo "ดำเนินการซ่อม";
                            } else if ($result['status'] == 3) {
                                echo "success";
                            }
                            ?>
                        </td>
                        <td>
                            <a class="btn btn-primary btn-sm text-white" href="./detail-repair-asset.php?id=<?php echo $result['id'] ?>">view</a>
                            <a class="btn btn-sm btn-warning text-white">edit</a>
                        </td>
                    </tr>
                <?php
                }
                ?>
            </tbody>
        </table>
    </div>
</div>
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
</script>
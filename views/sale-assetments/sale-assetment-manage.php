<?php
include_once "../layout/masterpage.php";
?>
<div class="home-section">
    <div class="home-content">
        <h1>การจัดการรายการแจ้งจำหน่าย</h1>
        <table id="myTable" style='font-size:14px; width: 100%; text-align:center; border:1px;' class='table table-striped '>
            <thead>
                <tr>
                    <th>เลขที่แจ้งจำหน่าย</th>
                    <th>ผู้แจ้งจำหน่าย</th>
                    <th>รายละเอียด</th>
                    <th>วันที่แจ้งจำหน่าย</th>
                    <th>สถานะแจ้งแจำหน่าย</th>
                    <th>Action</th>
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
                        <td><?php echo $result['staff_firstname']." ".$result['staff_lastname']; ?></td>
                        <td><?php echo $result['detail']; ?></td>
                        <td><?php echo $result['selling_date']; ?></td>
                        <td><?php
                            if ($result['status'] == 1) {
                                echo "แจ้งจำหน่าย";
                            } else if ($result['status'] == 2) {
                                echo "ดำเนินการจำหน่าย";
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
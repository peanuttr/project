<?php
include_once "../layout/masterpage.php";
?>
<div class="home-section">
    <div class="home-content">
        <h1> จัดการข้อมูลแหล่งเงิน </h1>
        <a class='button-17' href='./money-source-add.php'> <span>เพิ่มแหล่งเงิน</span> </a>
        <table id="myTable" style="font-size:14px; width: 100%; text-align:center; border:1px;" class="table table-striped">
            <thead>
                <tr>
                    <th>ลำดับ</th>
                    <th>รหัสแหล่งเงิน</th>
                    <th>ชื่อแหล่งเงิน</th>
                    <th>การดำเนินการ</th>
                </tr>
            </thead>
            <tbody>
                <?php
                require "../../assets/config/db.php";
                $db = new db();
                $stmt = $db->sqlQuery("SELECT * FROM money_source");
                $stmt->execute();
                $number = 1;
                while ($result = $stmt->fetch(PDO::FETCH_ASSOC)) {
                ?>
                    <tr>
                        <td><?php echo $number ?></td>
                        <td><?php echo $result['money_source_number']; ?></td>
                        <td><?php echo $result['money_source_name']; ?></td>
                        <td>
                            <a href='./money-source-edit.php?id=<?php echo $result['id']; ?>' class='btn btn-sm btn-warning'>
                                <i class='bx bx-edit'></i>
                            </a> /
                            <a class='del btn btn-sm btn-danger' onclick="removeUser('<?php echo $result['id']; ?>')">
                                <i class='bx bx-trash'></i>
                            </a>
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
<script>
    $(document).ready(function() {
        $('#myTable').DataTable({
            "lengthMenu": [5, 10]
        });
    });

    function removeUser(id) {
        var result = confirm("คุณต้องการจะลบข้อมูลนี้ใช่หรือไม่");
        if (result) {
            $.ajax({
                url: '../../assets/db/money-source/del-money-source.php',
                type: 'POST',
                data: {
                    id: id
                },
                success: function(data) {
                    data.substr(0,6) == "<br />" ? alert('ไม่สามารถลบข้อมูลได้') : window.location.href = "./money-source-management.php";
                }
            })
        }
    }
</script>
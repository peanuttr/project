<?php
include_once "../layout/masterpage.php";
?>
<div class="home-section">
    <h1> การจัดการบุคลากร </h1>
    <a class='button-17' href='./personnel-add.php'> <span>เพิ่มบุคลากร</span> </a>
    <table id="myTable" style="font-size:14px; width: 100%; text-align:center; border:1px;" class="table table-striped">
        <thead>
            <tr>
                <th>ลำดับ</th>
                <th>ชื่อ</th>
                <th>นามสกุล</th>
                <th>เบอร์โทรศัพท์</th>
                <th>อีเมล</th>
                <th>หน่วยงาน</th>
                <th>สถานะ</th>
                <th>action</th>
            </tr>
        </thead>
        <tbody>
            <?php
            require "../../assets/config/db.php";
            $db = new db();
            $stmt = $db->sqlQuery("SELECT p.*,d.department_name FROM personnels AS p JOIN department AS d ON d.id = p.department_id");
            $stmt->execute();
            $number = 1;
            while ($result = $stmt->fetch(PDO::FETCH_ASSOC)) {
            ?>
            <tr>
                <td><?php echo $number ?></td>
                <td><?php echo $result['personnel_firstname']; ?></td>
                <td><?php echo $result['personnel_lastname']; ?></td>
                <td><?php echo $result['telephone_number']; ?></td>
                <td><?php echo $result['email']; ?></td>
                <td><?php echo $result['department_name']; ?></td>
                <td><?php echo $result['status']; ?></td>
                <td>
                <a href='./personnel-edit.php?id=<?php echo $result['id']; ?>' class='btn btn-sm btn-success'>
                <i class='bx bx-edit'></i>
                </a> / 
                <a class='del btn btn-sm btn-danger' onclick="removeUser('<?php echo $result['id']; ?>')">
                <i class='bx bx-trash' ></i>
            </a>
                </td>
            </tr>
            <?php
            $number+=1; 
            }
            ?>
        </tbody>
    </table>
</div>
<script>
    $(document).ready(function() {
        $('#myTable').DataTable({
            "lengthMenu": [ 5,10 ]
        });
    });

    function removeUser(id) {
        var result = confirm("Want to delete?");
        if (result) {
            $.ajax({
                url: '../../assets/db/personnel/del-personnel.php',
                type: 'POST',
                data: {
                    id: id
                },
                success: function(data) {
                    window.location.href = "./personnel-management.php";
                }
            })
        }
    }
</script>
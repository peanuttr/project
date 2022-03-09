<?php
include_once "../layout/masterpage.php";
?>
<div class="home-section">
    <h1> การจัดการผู้ใช้งาน </h1>
    <a class='button-17' href='./user-add.php'> <span>เพิ่มเจ้าหน้าที่</span> </a>
    <table id="myTable" style="font-size:14px; width: 100%; text-align:center; border:1px;" class="table table-striped">
        <thead>
            <tr>
                <th>ชื่อ</th>
                <th>นามสกุล</th>
                <th>หน่วยงาน</th>
                <th>action</th>
            </tr>
        </thead>
        <tbody>
            <?php
            require "../../assets/config/db.php";
            $db = new db();
            $stmt = $db->connect()->prepare("SELECT s.*,d.department_name FROM staffs AS s JOIN department AS d ON d.id = s.department_id");
            $stmt->execute();
            while ($result = $stmt->fetch(PDO::FETCH_ASSOC)) {
            ?>
            <tr>
                <td><?php echo $result['staff_firstname']; ?></td>
                <td><?php echo $result['staff_lastname']; ?></td>
                <td><?php echo $result['department_name']; ?></td>
                <td>
                <a href='./user-edit.php?id=<?php echo $result['id']; ?>' class='btn btn-sm btn-success'>
                <i class='bx bx-edit'></i>
                </a> / 
                <a class='del btn btn-sm btn-danger' onclick="removeUser('<?php echo $result['id']; ?>')">
                <i class='bx bx-trash' ></i>
            </a>
                </td>
            </tr>
            <?php } ?>
        </tbody>
    </table>
</div>
<script>
    $(document).ready(function() {
        $('#myTable').DataTable();
    });

    function removeUser(id) {
        var result = confirm("Want to delete?");
        if (result) {
            $.ajax({
                url: '../../assets/db/user/del-user.php',
                type: 'POST',
                data: {
                    id: id
                },
                success: function(data) {
                    window.location.href = "./user-management.php";
                }
            })
        }
    }
</script>
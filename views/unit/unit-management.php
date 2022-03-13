<?php
include_once "../layout/masterpage.php";
?>
<div class="home-section">
    <h1> การจัดการหน่วยนับ </h1>
    <a class='button-17' href='./unit-add.php'> <span>เพิ่มหน่วยนับ</span> </a>
    <table id="myTable" style="font-size:14px; width: 100%; text-align:center; border:1px;" class="table table-striped">
        <thead>
            <tr>
                <th>ลำดับ</th>
                <th>ชื่อหน่วยนับ</th>
                <th>action</th>
            </tr>
        </thead>
        <tbody>
            <?php
            require "../../assets/config/db.php";
            $db = new db();
            $stmt = $db->sqlQuery("SELECT * FROM unit");
            $stmt->execute();
            $number = 1;
            while ($result = $stmt->fetch(PDO::FETCH_ASSOC)) {
            ?>
            <tr>
                <td><?php echo $number ?></td>
                <td><?php echo $result['unit_name']; ?></td>
                <td>
                <a href='./unit-edit.php?id=<?php echo $result['id']; ?>' class='btn btn-sm btn-success'>
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
                url: '../../assets/db/unit/del-unit.php',
                type: 'POST',
                data: {
                    id: id
                },
                success: function(data) {
                    window.location.href = "./unit-management.php";
                }
            })
        }
    }
</script>
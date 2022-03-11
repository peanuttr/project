<?php
include_once "../layout/masterpage.php";
?>
<div class="home-section">
    <h1> การจัดการครุภัณฑ์ </h1>
    <a class='button-17' href='./asset-add.php'> <span>เพิ่มครุภัณฑ์</span> </a>
    <table id="myTable" style='font-size:14px; width: 100%; text-align:center; border:1px;' class='table table-striped ' >
    <thead>
    <tr>
        <th>ลำดับ</th>
            <th>เลขครุภัณฑ์</th>
            <th>ชื่อครุภัณฑ์</th>
            <th>หน่วยนับ</th>
            <th>ที่อยู่</th>
            <th>สถานะ</th>
            <th>QR-CODE</th>
            <th>รูปภาพ</th>
            <th>action</th>
            </tr>
    </thead>
    <tbody>
    <?php
            require "../../assets/config/db.php";
            $db = new db();
            $stmt = $db->connect()->prepare("SELECT a.*,t.assets_types_name,u.unit_name,d.department_name,m.money_source_name FROM `assets` AS a 
            JOIN `assets_types` as t ON a.assets_types_id = t.id 
            JOIN `unit` as u ON a.unit_id = u.id 
            JOIN `department` as d ON a.department_id = d.id 
            JOIN `money_source` as m ON a.money_source_id = m.id");
            $stmt->execute();
            $number = 1;
            while ($result = $stmt->fetch(PDO::FETCH_ASSOC)) {
            ?>
            <tr>
                <td><?php echo $number ?></td>
                <td><?php echo $result['assets_number']; ?></td>
                <td><?php echo $result['asset_name']; ?></td>
                <td><?php echo $result['unit_name']; ?></td>
                <td><?php echo $result['place_name']; ?></td>
                <td><?php echo $result['status']; ?></td>
                <td><?php echo $result['qr-code']; ?></td>
                <td><img src="<?php echo $result['image']; ?>" width="50px" alt=""></td>
                <td>
                <a href='./asset-edit.php?id=<?php echo $result['id'] ?>' class='btn btn-sm btn-success'>
                <i class='bx bx-edit'></i>
                </a> / 
                <a class='del btn btn-sm btn-danger' onclick="removeAsset(<?php echo $result['id'] ?>)">
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
        var table = $('#myTable').DataTable({
            "lengthMenu": [ 5,10 ]
        });
    });
    function removeAsset(id) {
        var result = confirm("Want to delete?");
        if (result) {
            $.ajax({
                url: '../../assets/db/asset-detail/del-asset.php',
                type: 'POST',
                data: {
                    id: id
                },
                success: function(data) {
                    window.location.href = "./asset-management.php";
                }
            })
        }
    }
</script>
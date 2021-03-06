<?php
include_once "../layout/masterpage.php";
?>
<div class="home-section">
    <div class="home-content">
        <h1> จัดการข้อมูลครุภัณฑ์ </h1>
        <a class='button-17' href='./asset-add.php'> <span>เพิ่มครุภัณฑ์</span> </a>
        <table id="myTable" style='font-size:14px; width: 100%; text-align:center; border:1px;' class='table table-striped '>
            <thead>
                <tr>
                    <th>ลำดับ</th>
                    <th width="25%">เลขครุภัณฑ์</th>
                    <th width="25%">ชื่อครุภัณฑ์</th>
                    <th width="11%">ที่อยู่</th>
                    <th width="11%">สถานะ</th>
                    <th width="11%">QR-CODE</th>
                    <th >รูปภาพ</th>
                    <th width="15%">การดำเนินการ</th>
                </tr>
            </thead>
            <tbody>
                <?php
                require "../../assets/config/db.php";
                $db = new db();
                $stmt = $db->sqlQuery("SELECT a.*,t.assets_types_name,u.unit_name,d.department_name,m.money_source_name,p.placename FROM `assets` AS a 
                JOIN `assets_types` as t ON a.assets_types_id = t.id 
                JOIN `unit` as u ON a.unit_id = u.id 
                JOIN `department` as d ON a.department_id = d.id 
                JOIN `money_source` as m ON a.money_source_id = m.id
                JOIN `place` as p ON a.place_id = p.id");
                $stmt->execute();
                $number = 1;
                while ($result = $stmt->fetch(PDO::FETCH_ASSOC)) {
                ?>
                    <tr>
                        <td><?php echo $number ?></td>
                        <td><?php echo $result['assets_number']; ?></td>
                        <td><?php echo $result['asset_name']; ?></td>
                        <td><?php echo $result['placename']; ?></td>
                        <td><?php echo $result['status']; ?></td>
                        <td><img src="<?php echo "../../assets/qrcode/". $result['qr-code']; ?>" width="50px" alt=""></td>
                        <td><img src="<?php echo "../../assets/uploads/". $result['image']; ?>" width="50px" alt=""></td>
                        <td>
                            <a href='./asset-edit.php?id=<?php echo $result['id'] ?>' class='btn btn-sm btn-warning text-white'>
                                <i class='bx bx-edit'></i>
                            </a>
                            <a href='./asset-detail.php?id=<?php echo $result['id'] ?>' class='btn btn-sm btn-primary'><i class="bi bi-info-square-fill"></i></a>
                                <a class='del btn btn-sm btn-danger' onclick="removeAsset('<?php echo $result['id'] ?>')">
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
        var table = $('#myTable').DataTable({
            "lengthMenu": [5, 10]
        });
        //     $('#myTable tbody').on('click', 'tr', function () {
        //     var data = table.row( this ).data();
        //     alert( 'You clicked on '+data[1]+'\'s row' );
        // } );
    });

    function removeAsset(id) {
        var result = confirm("คุณต้องการจะลบข้อมูลนี้ใช่หรือไม่");
        if (result) {
            $.ajax({
                url: '../../assets/db/asset-detail/del-asset.php',
                type: 'POST',
                data: {
                    id: id
                },
                success: function(data,textStatus) {
                    console.log(data.substr(0,6));
                    console.log(textStatus);
                    data.substr(0,6) == "<br />" ? alert('ไม่สามารถลบข้อมูลได้') :window.location.href = "./asset-management.php";
                }
            })
        }
    }
</script>
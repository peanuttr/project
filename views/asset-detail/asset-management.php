<?php
include_once "../layout/masterpage.php";
?>
<div class="home-section">
    <h1> การจัดการบุคลากร </h1>
    <?php
    require "../../assets/config/db.php";
    $db = new db();
    $stmt = $db->connect()->prepare("SELECT a.*,t.assets_types_name,u.unit_name,d.department_name,m.money_source_name FROM `assets` AS a 
                                    JOIN `assets_types` as t ON a.assets_types_id = t.id 
                                    JOIN `unit` as u ON a.unit_id = u.id 
                                    JOIN `department` as d ON a.department_id = d.id 
                                    JOIN `money_source` as m ON a.money_source_id = m.id
                                    JOIN `detail_borrow_and_return` as b ON a.money_source_id = b.id");
    $stmt->execute();
    $output = "";
    $output .= "<a class='button-17' href='./asset-add.php'> <span>เพิ่มบุคลากร</span> </a>";
    $output .= "<table style='font-size:14px; width: 100%; text-align:center; border:1px;' class='table table-striped ' >
            <tr>
            <th>เลขครุภัณฑ์</th>
            <th>ชื่อครุภัณฑ์</th>
            <th>หน่วยนับ</th>
            <th>ที่อยู่</th>
            <th>สถานะ</th>
            <th>QR-CODE</th>
            <th>รูปภาพ</th>
            <th>action</th>
            </tr>";
    while ($result = $stmt->fetch(PDO::FETCH_ASSOC)) {
        $id = $result['id'];
        $asset_number = $result['assets_number'];
        $asset_name = $result['assets_name'];
        $unit = $result['unit_name'];
        $place = $result['place_name'];
        $status = $result['status'];
        $qrcode = $result['qr-code'];
        $image = $result['image'];
        $output .= "<tr>
                <td>$asset_number</td>
                <td>$asset_name</td>
                <td>$unit</td>
                <td>$place</td>
                <td>$status</td>
                <td>$qrcode</td>
                <td>$image</td>
                <td>
                <a href='./personnel-edit.php?id=$id' class='btn btn-sm btn-success'>
                <i class='bx bx-edit'></i>
                </a> / 
                <a class='del btn btn-sm btn-danger' onclick='removeUser($id)'>
                <i class='bx bx-trash' ></i>
                </sapan>
                </td>
                </tr>";
    }
    $output .= "</table>";
    echo $output;
    ?>
</div>
<script>
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
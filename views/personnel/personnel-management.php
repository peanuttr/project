<?php
include_once "../layout/masterpage.php";
?>
<div class="home-section">
    <h1> การจัดการบุคลากร </h1>
    <?php
    require "../../assets/config/db.php";
    $db = new db();
    $stmt = $db->connect()->prepare("SELECT p.*,d.department_name FROM personnels AS p JOIN department AS d ON d.id = p.department_id");
    $stmt->execute();
    $output = "";
    $output .= "<a class='button-17' href='./personnel-add.php'> <span>เพิ่มบุคลากร</span> </a>";
    $output .= "<table style='font-size:14px; width: 100%; text-align:center; border:1px;' class='table table-striped ' >
            <tr>
            <th>ชื่อ</th>
            <th>นามสกุล</th>
            <th>เบอร์โทรศัพท์</th>
            <th>อีเมล์</th>
            <th>สถานะ</th>
            <th>หน่วยงาน</th>
            <th>action</th>
            </tr>";
    while ($result = $stmt->fetch(PDO::FETCH_ASSOC)) {
        $id = $result['id'];
        $fname = $result['personnel_firstname'];
        $lname = $result['personnel_lastname'];
        $mobilenumber = $result['telephone_number'];
        $email = $result['email'];
        $status = $result['status'];
        $department = $result['department_name'];
        $output .= "<tr>
                <td>$fname</td>
                <td>$lname</td>
                <td>$mobilenumber</td>
                <td>$email</td>
                <td>$status</td>
                <td>$department</td>
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
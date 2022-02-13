<?php
include_once "../layout/masterpage.php";
?>
<div class="home-section">
    <h1> การจัดการผู้ใช้งาน </h1>
    <?php
    require "../../assets/config/db.php";
    $db = new db();
    $stmt = $db->connect()->prepare("SELECT s.*,d.department_name FROM staffs AS s JOIN department AS d ON d.id = s.department_id");
    $stmt->execute();
    $output = "";
    $output .= "<a class='button-17' href='./user-add.php'> <span>เพิ่มเจ้าหน้าที่</span> </a>";
    $output .= "<table style='font-size:14px; width: 100%; text-align:center; border:1px;' class='table table-striped ' >
            <tr>
            <th>ชื่อ</th>
            <th>นามสกุล</th>
            <th>หน่วยงาน</th>
            <th>action</th>
            </tr>";
    while ($result = $stmt->fetch(PDO::FETCH_ASSOC)) {
        $id = $result['id'];
        $fname = $result['staff_firstname'];
        $lname = $result['staff_lastname'];
        $department = $result['department_name'];
        $output .= "<tr>
                <td>$fname</td>
                <td>$lname</td>
                <td>$department</td>
                <td>
                <a href='./user-edit.php?id=$id' class='btn btn-sm btn-success'>
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
        $.ajax({
            url: '../../assets/db/user/del-user.php',
            type: 'POST',
            data: {id: id },
            success: function(data){
                window.location.href = "./user-management.php";
            }
        })
    }
</script>
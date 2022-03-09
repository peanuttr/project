<?php
include "../../assets/config/db.php";
include_once "../layout/masterpage.php";

if (isset($_GET['id'])) {
    $_id = $_GET['id'];
    $db = new db();
    $stmt = $db->connect()->prepare("SELECT s.*,d.department_name FROM staffs AS s JOIN department AS d ON d.id = s.department_id  WHERE s.id = $_id");
    $stmt->execute();

    $res = $stmt->fetch(PDO::FETCH_ASSOC);

    $dep_name = array();
    $stmt = $db->connect()->prepare("SELECT * FROM department");
    $stmt->execute();
    while ($dep = $stmt->fetch(PDO::FETCH_ASSOC)) {
        array_push($dep_name, ['id' => $dep['id'], 'department_name' => $dep['department_name']]);
    }
}
?>
<div class="home-section">
    <h1>แก้ไขผู้ใช้งาน</h1>
    <form action='../../assets/db/user/add-user-and-edit.php' method='post'>
        <input type="hidden" name='id' value=<?php echo $_id; ?>>
        <div class='row' style='margin: 10px 0 10px 39rem; width:50%;'>
            <div class='col-md-6'>
                <label>ชื่อผู้ใช้งาน</label>
                <input type='text' name='username' class='form-control' placeholder='ชื่อผู้ใช้งาน' value=<?php echo $res['username']; ?>>
            </div>
        </div>
        <div class='row' style='margin: 10px 0 10px 39rem; width:50%;'>
            <div class='col-md-6'>
                <label>รหัสผ่าน</label>
                <input type='password' name='password' class='form-control' placeholder='รหัสผ่าน' value=<?php echo $res['password']; ?>>
            </div>
        </div>
        <div class='row' style='margin: 10px 0 10px 39rem; width:50%;'>
            <div class='col-md-6'>
                <label>ชื่อ</label>
                <input type='text' name='fisrtname' class='form-control' placeholder='ชื่อ' value=<?php echo $res['staff_firstname']; ?>>
            </div>
        </div>
        <div class='row' style='margin: 10px 0 10px 39rem; width:50%;'>
            <div class='col-md-6'>
                <label>นามสกุล</label>
                <input type='text' name='lastname' class='form-control' placeholder='นามสกุล' value=<?php echo $res['staff_lastname']; ?>>
            </div>
        </div>
        <div class='row' style='margin: 10px 0 10px 39rem; width:50%;'>
            <div class='col-md-6'>
                <label>เบอร์มือถือ</label>
                <input type='text' name='telephone' class='form-control' placeholder='เบอร์มือถือ' value=<?php echo $res['telephone']; ?>>
            </div>

        </div>
        <div class='row' style='margin: 10px 0 10px 39rem; width:50%;'>
            <div class='col-md-6'>
                <label>อีเมล์</label>
                <input type='text' name='email' class='form-control' placeholder='E-Mail' value=<?php echo $res['email']; ?>>
            </div>
        </div>
        <div class='row' style='margin: 10px 0 10px 39rem; width:50%;'>
            <div class='col-md-6'>
                <label>สิทธิ์การใช้งาน</label>
                <select class='form-select' name='permission'>
                    <?php
                    $option = array("staff", "ceo");
                    if ($res['permission'] == $option[0]) {
                        echo "<option value='" . $res['permission'] . "' selected> เจ้าหน้าที่ </option>";
                        echo "<option value='" . $option[1] . "' > ผู้บริหาร </option>";
                    } else if ($res['permission'] == $option[1]) {
                        echo "<option value='" . $res['permission'] . "' selected> ผู้บริหาร </option>";
                        echo "<option value='" . $option[0] . "' > เจ้าหน้าที่ </option>";
                    }
                    ?>
                </select>
            </div>

        </div>
        <div class='row' style='margin: 10px 0 10px 39rem; width:50%;'>
            <div class='col-md-6'>
                <label>หน่วยงาน</label>
                <select class='form-select' name='department_id'>
                    <?php
                    if ($res['department_id'] == $dep_name[0]['id']) {
                        echo "<option value='" . $res['department_id'] . "' selected>" . $res['department_name'] . "</option>";
                        echo "<option value='" . $dep_name[1]['id'] . "' >" . $dep_name[1]['department_name'] . "</option>";
                        echo "<option value='" . $dep_name[2]['id'] . "' >" . $dep_name[2]['department_name'] . "</option>";
                        echo "<option value='" . $dep_name[3]['id'] . "' >" . $dep_name[3]['department_name'] . "</option>";
                    } else if ($res['department_id'] == $dep_name[1]['id']) {
                        echo "<option value='" . $res['department_id'] . "' selected>" . $res['department_name'] . "</option>";
                        echo "<option value='" . $dep_name[0]['id'] . "' >" . $dep_name[0]['department_name'] . "</option>";
                        echo "<option value='" . $dep_name[2]['id'] . "' >" . $dep_name[2]['department_name'] . "</option>";
                        echo "<option value='" . $dep_name[3]['id'] . "' >" . $dep_name[3]['department_name'] . "</option>";
                    } else if ($res['department_id'] == $dep_name[2]['id']) {
                        echo "<option value='" . $res['department_id'] . "' selected>" . $res['department_name'] . "</option>";
                        echo "<option value='" . $dep_name[0]['id'] . "' >" . $dep_name[0]['department_name'] . "</option>";
                        echo "<option value='" . $dep_name[1]['id'] . "' >" . $dep_name[1]['department_name'] . "</option>";
                        echo "<option value='" . $dep_name[3]['id'] . "' >" . $dep_name[3]['department_name'] . "</option>";
                    } else if ($res['department_id'] == $dep_name[3]['id']) {
                        echo "<option value='" . $res['department_id'] . "' selected>" . $res['department_name'] . "</option>";
                        echo "<option value='" . $dep_name[0]['id'] . "' >" . $dep_name[0]['department_name'] . "</option>";
                        echo "<option value='" . $dep_name[1]['id'] . "' >" . $dep_name[1]['department_name'] . "</option>";
                        echo "<option value='" . $dep_name[2]['id'] . "' >" . $dep_name[2]['department_name'] . "</option>";
                    }
                    ?>
                </select>
            </div>
        </div>
        <div class='row' style='margin: 10px 0 10px 20rem; width:50%;'>
            <div class='col' style='margin-left: 42%;'>
                <input type='submit' class='btn btn-sm btn-success' name='submit' value='บันทึก'>
            </div>
            <div class='col' style='margin-right: 37%;'>
                <a class='btn btn-sm btn-danger' href="javascript:history.back()"> <span>กลับ</span> </a>
            </div>
        </div>
    </form>
</div>
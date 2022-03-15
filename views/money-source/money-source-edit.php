<?php
include "../../assets/config/db.php";
include_once "../layout/masterpage.php";

if (isset($_GET['id'])) {
    $_id = $_GET['id'];
    $db = new db();
    $stmt = $db->sqlQuery("SELECT * FROM money_source WHERE id = $_id");
    $stmt->execute();
    $res = $stmt->fetch(PDO::FETCH_ASSOC);
}
?>
<div class="home-section">
    <div class="home-content">
        <h1>แก้ไขแหล่งเงิน</h1>
        <form action='../../assets/db/money-source/add-money-source-and-edit.php' method='post'>
            <input type="hidden" name='id' value=<?php echo $_id; ?>>
            <div class="container">
                <div class='row flex justify-content-center' style=''>
                    <div class='col-6 width-50 flex justify-center'>
                        <label>ชื่อแหล่งเงิน</label>
                        <input type='text' name='moneySourceName' class='form-control' placeholder='ชื่อแหล่งเงิน' value=<?php echo $res['money_source_name']; ?>>
                    </div>
                </div>
                <div class='row flex justify-content-center mt-2'>
                    <div class='col-1 d-flex justify-content-start'>
                        <a class='btn btn-sm btn-danger' href="javascript:history.back()"> <span>กลับ</span> </a>
                    </div>
                    <div class='col-1 d-flex justity-content-end'>
                        <input type='submit' class='btn btn-sm btn-success' name='submit' value='บันทึก'>
                    </div>
                </div>
        </form>
    </div>

</div>
<?php
include_once "../layout/masterpage.php";
require "../../assets/config/db.php";
$db = new db();

$stmt = $db->sqlQuery("SELECT * FROM place");
$stmt->execute();
$places = array();
foreach ($stmt->fetchAll() as $res) {
    array_push($places, $res);
}
?>
<div class="home-section">
    <div class="home-content">
        <h1 style="padding-top: 0.5%">เพิ่มข้อมูลครุภัณฑ์</h1>
        <form method="post" action="../../assets/db/asset-detail/add-asset-detail-csv.php" enctype="multipart/form-data">
            <div class="form-insert-asset">
            <div class="row flex justify-content-center">
                    <div class="col-5 width-50 d-flex justify-content-end">
                        <label for="">upload csv</label>
                    </div>
                    <div class="col-5 width-50 d-flex justify-content-start">

                        <input type="file" name="upload" id="upload">
                    </div>
                </div>
                <div class='row flex justify-content-center mt-2' style="padding-top: 20px">
                    <div class='col-1 d-flex justify-content-start' style=''>
                        <a class='btn btn-sm btn-danger' href="javascript:history.back()"> <span>กลับ</span> </a>
                    </div>
                    <div class='col-1 d-flex justity-content-end'>
                        <input type='submit' class='btn btn-sm btn-success' name='submit' value='บันทึก'>
                    </div>
                </div>
            </div>
        </form>
    </div>
</div>

<script>
    $(function() {
        $('.selectpicker').selectpicker();
    });

    function readURL(input) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();
            reader.onload = function(e) {
                $('#preview').attr('src', e.target.result);
            }
            reader.readAsDataURL(input.files[0]);
        }
    }
</script>
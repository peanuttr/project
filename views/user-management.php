<?php
include_once "./masterpage.php";
?>
<div class="home-section">
    <h1> การจัดการผู้ใช้งาน </h1>
    <div id="table">

    </div>
</div>
<script>
    function removeUser(id) {
        $.ajax({
            url: '../assets/includes/deluser.php',
            type: 'POST',
            data: {id: id },
            success: function(data){
                $("#table").load("../assets/includes/load.php")
            }
        })
    }
</script>
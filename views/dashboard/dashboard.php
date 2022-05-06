<?php
include_once "../layout/masterpage.php";
require "../../assets/config/db.php";

$db = new db();
?>
<div class="home-section">
    <div class="home-content">
        <h1>รายการครุภัณฑ์</h1>
        <div class="row form-group">
            <div class="col-md-3">
                <div class="card">
                    <div class="card-header">
                        <span>จำนวนครุภัณฑ์</span>
                        <a href="../../assets/db/report/report.php?name=assets" class="btn btn-primary">export excel</a>
                    </div>
                    <div class="card-body">
                        <h3 class='d-flex justify-content-end'>
                            <?php
                            $stmt = $db->sqlQuery("SELECT COUNT('id') FROM `assets`");
                            $stmt->execute();
                            foreach ($stmt->fetch(PDO::FETCH_ASSOC) as $res) {
                                echo $res;
                            }
                            // print_r($res['id']);
                            ?>
                            <i class='bx bx-tv'></i>
                        </h3>
                    </div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="card">
                    <div class="card-header">
                        <span>จำนวนรายการยืม-คืน</span>
                        <a href="../../assets/db/report/report.php?name=borrow_and_return" class="btn btn-primary">export excel</a>
                    </div>
                    <div class="card-body">
                        <h3 class='d-flex justify-content-end'>
                            <?php
                            $stmt = $db->sqlQuery("SELECT COUNT('id') FROM `borrow_and_return`");
                            $stmt->execute();
                            foreach ($stmt->fetch(PDO::FETCH_ASSOC) as $res) {
                                echo $res;
                            }
                            // print_r($res['id']);
                            ?>
                            <i class='bx bx-transfer-alt'></i>
                        </h3>
                    </div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="card">
                    <div class="card-header">
                        <span>จำนวนรายการแจ้งซ่อม</span>
                        <a href="../../assets/db/report/report.php?name=repair_notice" class="btn btn-primary">export excel</a>
                    </div>
                    <div class="card-body">
                        <h3 class='d-flex justify-content-end'>
                            <?php
                            $stmt = $db->sqlQuery("SELECT COUNT('id') FROM `repair_notice`");
                            $stmt->execute();
                            foreach ($stmt->fetch(PDO::FETCH_ASSOC) as $res) {
                                echo  $res;
                            }
                            // print_r($res['id']);
                            ?>
                            <i class='bx bx-wrench'></i>
                        </h3>
                    </div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="card">
                    <div class="card-header">
                        <span>จำนวนรายการจำหน่าย</span>
                        <a href="../../assets/db/report/report.php?name=sells" class="btn btn-primary">export excel</a>
                    </div>
                    <div class="card-body">
                        <h3 class='d-flex justify-content-end'>
                            <?php
                            $stmt = $db->sqlQuery("SELECT COUNT('id') FROM `sells`");
                            $stmt->execute();
                            foreach ($stmt->fetch(PDO::FETCH_ASSOC) as $res) {
                                echo $res;
                            }
                            // print_r($res['id']);
                            ?>
                            <i class='bx bx-cart-alt'></i>
                        </h3>
                    </div>
                </div>
            </div>
        </div>

        <div class="row form-group flex justify-content-center">
            <div class="col-md-3 ">
                <div class="card">
                    <div class="card-header">
                        <span>จำนวนประเภท</span>
                        <a href="../../assets/db/report/report.php?name=assets_types" class="btn btn-primary">export excel</a>
                    </div>
                    <div class="card-body">
                        <h3 class='d-flex justify-content-end'>
                            <?php
                            $stmt = $db->sqlQuery("SELECT COUNT('id') FROM `assets_types`");
                            $stmt->execute();
                            foreach ($stmt->fetch(PDO::FETCH_ASSOC) as $res) {
                                echo $res;
                            }
                            // print_r($res['id']);
                            ?>
                            <i class='bx bx-collection'></i>
                        </h3>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
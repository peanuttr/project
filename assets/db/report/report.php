<?php
require "../../config/db.php";
$db = new db();

if (isset($_GET['name'])) {
    $strExcelFileName = $_GET['name'] . ".xls";
    header("Content-Type: application/x-msexcel; name=\"$strExcelFileName\"");
    header("Content-Disposition: inline; filename=\"$strExcelFileName\"");
    header("Pragma:no-cache");

    if ($_GET['name'] == "assets") {


        $stmt = $db->sqlQuery("SELECT COUNT('id') FROM `assets`");
        $stmt->execute();
        $num = null;
        foreach ($stmt->fetch(PDO::FETCH_ASSOC) as $res) {
            $num = $res;
        }

        $stmt = $db->sqlQuery("SELECT a.*,t.assets_types_name,u.unit_name,d.department_name,m.money_source_name,p.placename FROM `assets` AS a 
    JOIN `assets_types` as t ON a.assets_types_id = t.id 
    JOIN `unit` as u ON a.unit_id = u.id 
    JOIN `department` as d ON a.department_id = d.id 
    JOIN `money_source` as m ON a.money_source_id = m.id
    JOIN `place` as p ON a.place_id = p.id");
        $stmt->execute();

?>

        <html xmlns:o="urn:schemas-microsoft-com:office:office" xmlns:x="urn:schemas-microsoft-com:office:excel" xmlns="http://www.w3.org/TR/REC-html40">

        <!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
        <html>

        <head>
            <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        </head>

        <body>
            <strong>รายงานครุภัณฑ์ วันที่ <?php echo date("d/m/Y"); ?> ทั้งหมด <?php echo number_format($num); ?> ชิ้น</strong><br>
            <br>
            <div id="SiXhEaD_Excel" align=center x:publishsource="Excel">
                <table x:str border=1 cellpadding=0 cellspacing=1 width=100% style="border-collapse:collapse">
                    <tr>
                        <td width="94" height="30" align="center" valign="middle"><strong>เลขครุภัณฑ์</strong></td>
                        <td width="200" align="center" valign="middle"><strong>ชื่อครุภัณฑ์</strong></td>
                        <td width="181" align="center" valign="middle"><strong>ที่อยู่</strong></td>
                        <td width="181" align="center" valign="middle"><strong>สถานะ</strong></td>
                    </tr>
                    <?php
                    while ($result = $stmt->fetch(PDO::FETCH_ASSOC)) {
                    ?>
                        <tr>
                            <td align="center" valign="middle"><?php echo $result['assets_number']; ?></td>
                            <td align="center" valign="middle"><?php echo $result['asset_name']; ?></td>
                            <td align="center" valign="middle"><?php echo $result['placename']; ?></td>
                            <td align="center" valign="middle"><?php echo $result['status'];; ?></td>
                        </tr>
                    <?php
                    }
                    ?>
                </table>
            </div>
            <script>
                window.onbeforeunload = function() {
                    return false;
                };
                setTimeout(function() {
                    window.close();
                }, 10000);
            </script>
        </body>

        </html>

    <?php
    } else if ($_GET['name'] == "borrow_and_return") {

        $stmt = $db->sqlQuery("SELECT COUNT('id') FROM `borrow_and_return`");
        $stmt->execute();
        foreach ($stmt->fetch(PDO::FETCH_ASSOC) as $res) {
            $num = $res;
        }

        $stmt = $db->sqlQuery("SELECT brd.*,s.staff_firstname,s.staff_lastname,p.personnel_firstname,p.personnel_lastname,pl.placename,a.asset_name,a.assets_number,br.borrow_date,br.return_date,br.detail
        FROM `detail_borrow_and_return` AS brd
                    JOIN `borrow_and_return` as br ON brd.borrow_and_return_id = br.id
                    JOIN `staffs` as s ON br.staff_id = s.id 
                    JOIN `personnels` as p ON br.personel_id = p.id 
                    JOIN `place` as pl ON brd.place_id = pl.id 
                    JOIN `assets` as a ON brd.asset_id = a.id ");
        $stmt->execute();
    ?>

        <html xmlns:o="urn:schemas-microsoft-com:office:office" xmlns:x="urn:schemas-microsoft-com:office:excel" xmlns="http://www.w3.org/TR/REC-html40">

        <!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
        <html>

        <head>
            <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        </head>

        <body>
            <strong>รายงานการยืมครุภัณฑ์ วันที่ <?php echo date("d/m/Y"); ?> ทั้งหมด <?php echo number_format($num); ?> รายการ</strong><br>
            <br>
            <div id="SiXhEaD_Excel" align=center x:publishsource="Excel">
                <table x:str border=1 cellpadding=0 cellspacing=1 width=100% style="border-collapse:collapse">
                    <tr>
                        <td width="94" height="30" align="center" valign="middle"><strong>เลขครุภัณฑ์</strong></td>
                        <td width="200" align="center" valign="middle"><strong>ชื่อครุภัณฑ์</strong></td>
                        <td width="181" align="center" valign="middle"><strong>ที่อยู่</strong></td>
                        <td width="181" align="center" valign="middle"><strong>สถานะ</strong></td>
                        <td width="181" align="center" valign="middle"><strong>วันที่ยืม</strong></td>
                        <td width="181" align="center" valign="middle"><strong>วันที่คืน</strong></td>
                        <td width="181" align="center" valign="middle"><strong>รายละเอียด</strong></td>
                        <td width="181" align="center" valign="middle"><strong>ชื่อ-นามสกุลผู้ยืม</strong></td>
                        <td width="181" align="center" valign="middle"><strong>ชื่อ-นามสกุลเจ้าหน้าที่</strong></td>
                    </tr>
                    <?php
                    while ($result = $stmt->fetch(PDO::FETCH_ASSOC)) {
                    ?>
                        <tr>
                            <td align="center" valign="middle"><?php echo $result['assets_number']; ?></td>
                            <td align="center" valign="middle"><?php echo $result['asset_name']; ?></td>
                            <td align="center" valign="middle"><?php echo $result['placename']; ?></td>
                            <td align="center" valign="middle"><?php echo $result['status']; ?></td>
                            <td align="center" valign="middle"><?php echo $result['borrow_date']; ?></td>
                            <td align="center" valign="middle"><?php echo $result['return_date']; ?></td>
                            <td align="center" valign="middle"><?php echo $result['detail']; ?></td>
                            <td align="center" valign="middle"><?php echo $result['personnel_firstname'] . " " . $result['personnel_lastname']; ?></td>
                            <td align="center" valign="middle"><?php echo $result['staff_firstname'] . " " . $result['staff_lastname']; ?></td>
                        </tr>
                    <?php
                    }
                    ?>
                </table>
            </div>
            <script>
                window.onbeforeunload = function() {
                    return false;
                };
                setTimeout(function() {
                    window.close();
                }, 10000);
            </script>
        </body>

        </html>

    <?php
    } else if ($_GET['name'] == "repair_notice") {
        $stmt = $db->sqlQuery("SELECT COUNT('id') FROM `repair_notice`");
        $stmt->execute();
        foreach ($stmt->fetch(PDO::FETCH_ASSOC) as $res) {
            $num = $res;
        }

        $stmt = $db->sqlQuery("SELECT a.id AS assets_id,a.assets_number,a.asset_name,r.date_notice,r.detail,r.status,p.personnel_firstname,p.personnel_lastname 
    FROM `detail_repair_notice` AS dr 
    JOIN `assets` AS a ON dr.asset_id = a.id 
    JOIN `repair_notice` AS r ON dr.repair_id = r.id 
    JOIN `personnels` AS p ON r.personel_id = p.id ");
        $stmt->execute();
    ?>

        <html xmlns:o="urn:schemas-microsoft-com:office:office" xmlns:x="urn:schemas-microsoft-com:office:excel" xmlns="http://www.w3.org/TR/REC-html40">

        <!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
        <html>

        <head>
            <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        </head>

        <body>
            <strong>รายงานการยืมครุภัณฑ์ วันที่ <?php echo date("d/m/Y"); ?> ทั้งหมด <?php echo number_format($num); ?> รายการ</strong><br>
            <br>
            <div id="SiXhEaD_Excel" align=center x:publishsource="Excel">
                <table x:str border=1 cellpadding=0 cellspacing=1 width=100% style="border-collapse:collapse">
                    <tr>
                        <td width="94" height="30" align="center" valign="middle"><strong>เลขครุภัณฑ์</strong></td>
                        <td width="200" align="center" valign="middle"><strong>ชื่อครุภัณฑ์</strong></td>
                        <td width="181" align="center" valign="middle"><strong>สถานะ</strong></td>
                        <td width="181" align="center" valign="middle"><strong>วันที่แจ้งซ่อม</strong></td>
                        <td width="181" align="center" valign="middle"><strong>รายละเอียด</strong></td>
                        <td width="181" align="center" valign="middle"><strong>ชื่อ-นามสกุลผู้แจ้งซ่อม</strong></td>
                    </tr>
                    <?php
                    while ($result = $stmt->fetch(PDO::FETCH_ASSOC)) {
                    ?>
                        <tr>
                            <td align="center" valign="middle"><?php echo $result['assets_number']; ?></td>
                            <td align="center" valign="middle"><?php echo $result['asset_name']; ?></td>
                            <td align="center" valign="middle"><?php
                                                                if ($result['status'] == 1) {
                                                                    echo "แจ้งซ่อม";
                                                                } else if ($result['status'] == 2) {
                                                                    echo "ดำเนินการซ่อม";
                                                                } else if ($result['status'] == 3) {
                                                                    echo "ซ่อมสำเร็จ";
                                                                }
                                                                ?></td>
                            <td align="center" valign="middle"><?php echo $result['date_notice']; ?></td>
                            <td align="center" valign="middle"><?php echo $result['detail']; ?></td>
                            <td align="center" valign="middle"><?php echo $result['personnel_firstname'] . " " . $result['personnel_lastname']; ?></td>
                        </tr>
                    <?php
                    }
                    ?>
                </table>
            </div>
            <script>
                window.onbeforeunload = function() {
                    return false;
                };
                setTimeout(function() {
                    window.close();
                }, 10000);
            </script>
        </body>

        </html>

    <?php
    } else if ($_GET['name'] == "sells") {
        $stmt = $db->sqlQuery("SELECT COUNT('id') FROM `sells`");
        $stmt->execute();
        foreach ($stmt->fetch(PDO::FETCH_ASSOC) as $res) {
            $num = $res;
        }

        $stmt = $db->sqlQuery("SELECT a.id AS assets_id,a.assets_number,a.asset_name,se.selling_date,se.detail,se.status,st.staff_firstname,st.staff_lastname 
        FROM `detail_sells` AS ds 
        JOIN `assets` AS a ON ds.asset_id = a.id 
        JOIN `sells` AS se ON ds.sell_id = se.id 
        JOIN `staffs` AS st ON st.id = se.staff_id ");
        $stmt->execute();

    ?>

        <html xmlns:o="urn:schemas-microsoft-com:office:office" xmlns:x="urn:schemas-microsoft-com:office:excel" xmlns="http://www.w3.org/TR/REC-html40">

        <!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
        <html>

        <head>
            <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        </head>

        <body>
            <strong>รายงานการยืมครุภัณฑ์ วันที่ <?php echo date("d/m/Y"); ?> ทั้งหมด <?php echo number_format($num); ?> รายการ</strong><br>
            <br>
            <div id="SiXhEaD_Excel" align=center x:publishsource="Excel">
                <table x:str border=1 cellpadding=0 cellspacing=1 width=100% style="border-collapse:collapse">
                    <tr>
                        <td width="94" height="30" align="center" valign="middle"><strong>เลขครุภัณฑ์</strong></td>
                        <td width="200" align="center" valign="middle"><strong>ชื่อครุภัณฑ์</strong></td>
                        <td width="181" align="center" valign="middle"><strong>สถานะ</strong></td>
                        <td width="181" align="center" valign="middle"><strong>วันที่แจ้งจำหน่าย</strong></td>
                        <td width="181" align="center" valign="middle"><strong>รายละเอียด</strong></td>
                        <td width="181" align="center" valign="middle"><strong>ชื่อ-นามสกุลผู้แจ้งจำหน่าย</strong></td>
                    </tr>
                    <?php
                    while ($result = $stmt->fetch(PDO::FETCH_ASSOC)) {
                    ?>
                        <tr>
                            <td align="center" valign="middle"><?php echo $result['assets_number']; ?></td>
                            <td align="center" valign="middle"><?php echo $result['asset_name']; ?></td>
                            <td align="center" valign="middle"><?php
                                        if ($result['status'] == 1) {
                                            echo "แจ้งจำหน่าย";
                                        } else if ($result['status'] == 2) {
                                            echo "ดำเนินการตำหน่าย";
                                        } else if ($result['status'] == 3) {
                                            echo "จำหน่ายสำเร็จ";
                                        }
                                        ?></td>
                            <td align="center" valign="middle"><?php echo $result['selling_date']; ?></td>
                            <td align="center" valign="middle"><?php echo $result['detail']; ?></td>
                            <td align="center" valign="middle"><?php echo $result['staff_firstname'] . " " . $result['staff_lastname']; ?></td>
                        </tr>
                    <?php
                    }
                    ?>
                </table>
            </div>
            <script>
                window.onbeforeunload = function() {
                    return false;
                };
                setTimeout(function() {
                    window.close();
                }, 10000);
            </script>
        </body>

        </html>

<?php
    } else if ($_GET['name'] == "assets_types") {
        $stmt = $db->sqlQuery("SELECT COUNT('id') FROM `assets_types`");
        $stmt->execute();
        foreach ($stmt->fetch(PDO::FETCH_ASSOC) as $res) {
            $num = $res;
        }

        $stmt = $db->sqlQuery("SELECT * FROM assets_types");
                $stmt->execute();

                ?>

        <html xmlns:o="urn:schemas-microsoft-com:office:office" xmlns:x="urn:schemas-microsoft-com:office:excel" xmlns="http://www.w3.org/TR/REC-html40">

        <!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
        <html>

        <head>
            <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        </head>

        <body>
            <strong>รายงานการยืมครุภัณฑ์ วันที่ <?php echo date("d/m/Y"); ?> ทั้งหมด <?php echo number_format($num); ?> ประเภท</strong><br>
            <br>
            <div id="SiXhEaD_Excel" align=center x:publishsource="Excel">
                <table x:str border=1 cellpadding=0 cellspacing=1 width=100% style="border-collapse:collapse">
                    <tr>
                        <td width="94" height="30" align="center" valign="middle"><strong>ชื่อประเภทครุภัณฑ์</strong></td>
                    </tr>
                    <?php
                    while ($result = $stmt->fetch(PDO::FETCH_ASSOC)) {
                    ?>
                        <tr>
                            <td align="center" valign="middle"><?php echo $result['assets_types_name']; ?></td>
                        </tr>
                    <?php
                    }
                    ?>
                </table>
            </div>
            <script>
                window.onbeforeunload = function() {
                    return false;
                };
                setTimeout(function() {
                    window.close();
                }, 10000);
            </script>
        </body>

        </html>

<?php
    }
}

<?php
require "../../config/db.php";
$db = new db();

if (isset($_GET['name'])) {
    $strExcelFileName = $_GET['name'] . ".xls";
    header("Content-Type: application/x-msexcel; name=\"$strExcelFileName\"");
    header("Content-Disposition: inline; filename=\"$strExcelFileName\"");
    header("Pragma:no-cache");

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
    $stmt->execute();;
}
?>

<html xmlns:o="urn:schemas-microsoft-com:office:office" xmlns:x="urn:schemas-microsoft-com:office:excel" xmlns="http://www.w3.org/TR/REC-html40">

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html>

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
</head>

<body>
    <strong>รายงานครุภัณฑ์ วันที่ <?php echo date("d/m/Y"); ?> ทั้งหมด <?php echo number_format($num); ?> ท่าน</strong><br>
    <br>
    <div id="SiXhEaD_Excel" align=center x:publishsource="Excel">
        <table x:str border=1 cellpadding=0 cellspacing=1 width=100% style="border-collapse:collapse">
            <tr>
                <td width="94" height="30" align="center" valign="middle"><strong>เลขครุภัณฑ์</strong></td>
                <td width="200" align="center" valign="middle"><strong>ชื่อครุภัณฑ์</strong></td>
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
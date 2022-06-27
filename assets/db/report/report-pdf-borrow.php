<?php
require '../../libs/TCPDF/tcpdf.php';
require "../../config/db.php";
session_start();
$db = new db();

$_id = $_GET['id'];
$stmt = $db->sqlQuery("SELECT brd.*,s.staff_firstname,s.staff_lastname,p.personnel_firstname,p.personnel_lastname,pl.placename,p.job_title,a.asset_name,a.assets_number,br.number_borrow,br.borrow_date,br.return_date,br.detail,d.department_name,u.unit_name
                FROM `detail_borrow_and_return` AS brd
                            JOIN `borrow_and_return` as br ON brd.borrow_and_return_id = br.id
                            JOIN `staffs` as s ON br.staff_id = s.id 
                            JOIN `personnels` as p ON br.personel_id = p.id 
                            JOIN `place` as pl ON brd.place_id = pl.id 
                            JOIN `assets` as a ON brd.asset_id = a.id
                            JOIN `department` as d ON d.id = p.department_id
                            JOIN `unit` as u ON u.id = a.unit_id
                            WHERE brd.borrow_and_return_id = " . $_id);
$stmt->execute();
$res = $stmt->fetch(PDO::FETCH_ASSOC);


$pdf = new TCPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);
$pdf->setPrintHeader(false);
$pdf->setPrintFooter(false);
$pdf->setFont('thsarabunnew001', '', 16);
$pdf->AddPage();
$dateNow = date('d-m-Y');
$stmt = $db->sqlQuery("SELECT count(id) FROM detail_borrow_and_return WHERE borrow_and_return_id = ".$_id);
$stmt->execute();
$row = $stmt->fetch(PDO::FETCH_BOTH);
$assetsName = null ;
$assetsNumber = null ;
$assetsUnit = null ;

$stmt = $db->sqlQuery("SELECT brd.*,s.staff_firstname,s.staff_lastname,p.personnel_firstname,p.personnel_lastname,pl.placename,p.job_title,a.asset_name,a.assets_number,br.number_borrow,br.borrow_date,br.return_date,br.detail,d.department_name,u.unit_name
                FROM `detail_borrow_and_return` AS brd
                            JOIN `borrow_and_return` as br ON brd.borrow_and_return_id = br.id
                            JOIN `staffs` as s ON br.staff_id = s.id 
                            JOIN `personnels` as p ON br.personel_id = p.id 
                            JOIN `place` as pl ON brd.place_id = pl.id 
                            JOIN `assets` as a ON brd.asset_id = a.id
                            JOIN `department` as d ON d.id = p.department_id
                            JOIN `unit` as u ON u.id = a.unit_id
                            WHERE brd.borrow_and_return_id = " . $_id);
$stmt->execute();
while( $resp = $stmt->fetch(PDO::FETCH_ASSOC)){
    $assetsName .=$resp['asset_name']." ,";
    $assetsNumber .=$resp['assets_number']." ,";
    $assetsUnit .=$resp['unit_name']." ,";
}
// $row = count($res['asset_name']);


$html = '<p style="text-align:right; font-size:large; top:0;">'.$res['number_borrow'].'</p>
<p style="text-align:center; font-size:large;">แบบบันทึกการยืมพัสดุ</p>
<p style="text-align:right;">เขียนที่ คณะอุตสาหกรรมเกษตร <br /> ' . DateThai($dateNow) . '</p>
<p style="text-align:left;">เรื่อง ขอยืมครุภัณฑ์ <br /> เรียน คณบดีคณะอุตสาหกรรมเกษตร</p>
<p style="text-align:center; text-indent: 5vh;">ข้าพเจ้า ' . $res['personnel_firstname'] . ' ' . $res['personnel_lastname'] . ' ตำแหน่ง ' . $res['job_title'] . '<br />
<span style="text-align:left;">สังกัดส่วนงาน(คณะ/วิทยาลัย/สำนัก/สถาบัน) อุตสาหกรรมเกษตร </span> <br />
<span style="text-align:left;">หน่วยงาน(ภาควิชา/กอง/ศูนย์/กลุ่มงาน) ' . $res['department_name'] . ' </span><br />
<span style="text-align:left;">ขอยืมทรัพย์สินของทางราชการซึ่งเป็นพัสดุประเภท </span><br />
<span style="text-align:center;"> ........ ใช้คงรูป ได้แก่ ................................................................................................ </span> <br />
<span style="text-align:center;"> ........ ใช้สินเปลือง ได้แก่ ................................................................................................ </span> <br />
<span style="text-align:left;">เพื่อใช้ในกิจการดังนี้ ' . $res['detail'] . '</span><br />
<span style="text-align:left;">โดยขอยืมพัดุเป็นระยะเวลา ' . DateThai($res['borrow_date']) . ' (วัน/เดือน/ปี) </span><br />
<span style="text-align:left;">กำหนดระยะเวลาคืนพัสดุ ภายใน ' . DateThai($res['return_date']) . ' </span> <br />
<b style="text-align:left;">รายละเอียดพัสดุที่ขอยืม</b> <br />
<span style="text-align:left;">ชื่อพัสดุ ' . $assetsName . '</span><br />
<span style="text-align:left;">ชนิด ' . $assetsUnit . ' เครื่อง จำนวน '.$row[0].' เครื่อง </span> <br>

<span style="text-align:left;">ชื่อทางการค้า(ยี่ห้อ) - </span><br />
<span style="text-align:left;">หมายเลขพัสดุ ' . $assetsNumber . ' </span><br />
<span style="text-align:left;">คุณลักษณะ ' . $res['detail'] . '</span><br />
</p>
<span style="text-align:center;">(ลงชื่อ) ........................ ชื่อผู้ยืม </span><br />
<span style="text-align:center;">( ' . $res['personnel_firstname'] . ' ' . $res['personnel_lastname'] . ' )</span><br />
<b style="text-align:right;">หัวหน้าส่วนงาน</b> <br />
<span style="text-align:right;"> ........ อนุญาต ....... ไม่อนุญาต</p>
<span style="text-align:left;">(ลงชื่อ) ........................ ผู้ตรวจสอบ (ถ้ามี) <br />
<span style="text-indent: 10px;">'.'&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;'.'( ........................ )</span><br />
(ตำแหน่ง) ........................ <br />
' . DateThai($dateNow) . '</span><br />
<span style="text-align:right;">(ลงชื่อ)  ........................  ผู้ให้ยืมพัสดุ <br />
( ........................ )'.'&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;'.'<br />
' . DateThai($dateNow) . '</span>
';
$pdf->writeHTML($html);
$pdf->Output();

function DateThai($strDate)
{

    $strYear = date("Y", strtotime($strDate)) + 543;

    $strMonth = date("n", strtotime($strDate));

    $strDay = date("j", strtotime($strDate));

    $strMonthCut = array("", "มกราคม.", "กุมภาพันธ์", "มีนาคม", "เมษายน", "พฤษภาคม", "มิถุนายม", "กรกฏาคม", "สิงหาคม", "กันยายน", "ตุลาคม", "พฤษจิกายน", "ธันวาคม");

    $strMonthThai = $strMonthCut[$strMonth];

    return "$strDay $strMonthThai $strYear";
}

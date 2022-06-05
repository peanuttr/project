<?php
require '../../libs/TCPDF/tcpdf.php';
require "../../config/db.php";
$db = new db();

$pdf = new TCPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);
$pdf->setPrintHeader(false);
$pdf->setPrintFooter(false);
$pdf->setFont('thsarabunnew001', '', 16);
$pdf->AddPage();
$dateNow = date('d-m-Y');
$html = '<p style="text-align:center; font-size:large;">แบบบันทึกการยืมพัสดุ
</p>
<p style="text-align:right;">เขียนที่ คณะอุตสาหกรรมเกษตร <br /> '.DateThai($dateNow).'</p>
<p style="text-align:left;">เรื่อง ขอยืมครุภัณฑ์ <br /> เรียนคณบดีคณะอุตสาหกรรมเกษตร</p>
<p style="text-align:center; text-indent: 5vh;">ข้าพเจ้า     ตำแหน่ง <br /> 
สังกัดส่วนงาน(คณะ/วิทยาลัย/สำนัก/สถาบัน) <br />
หน่วยงาน(ภาควิชา/กอง/ศูนย์/กลุ่มงาน) <br />
ขอยืมทรัพย์สินของทางราชการซึ่งเป็นพัสดุประเภท <br />
<span style="text-indent: 5vh;"> ใช้คงรูป ได้แก่ </span> <br />
<span style="text-indent: 5vh;"> ใช้สินเปลือง ได้แก่ </span> <br />
เพื่อใช้ในกิจการดังนี้ <br />
โดยขอยืมพัดุเป็นระยะเวลา (วัน/เดือน/ปี) <br />
กำหนดระยะเวลาคืนพัสดุ ภายในวันที่ เดือน พ.ศ. <br />
<b>รายละเอียดพัสดุที่ขอยืม</b>
ชื่อพัสดุ </br>
ชนิด เครื่อง จำนวน เครื่อง </br> 
ชื่อทางการค้า(ยี่ห้อ) <br />
หมายเลลขพัสดุ <br />
คุณลักษณะ <br />
</p>
<p style="text-align:center;">(ลงชื่อ) ชื่อผู้ยืม </p>
<p style="text-align:center;">( )</p>
<b style="text-align:right;">หัวหน้าส่วนงาน</b>
<p style="text-align:right;">อนุญาต ไม่อนุญาต</p>
<p style="text-align:left;">(ลงชื่อ) ผู้ตรวจสอบ (ถ้ามี) <br />
(ตำแหน่ง) <br />
วันที่ 27 / พ.ค / 65
</p>
<p style="text-align:right;">(ลงชื่อ) ผู้ให้ยืมพัสดุ <br />
(ตำแหน่ง) <br />
วันที่ 27 / พ.ค / 65
</p>
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
<?php
require '../../libs/TCPDF/tcpdf.php';
require "../../config/db.php";
$db = new db();

$pdf = new TCPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);
$pdf->setPrintHeader(false);
$pdf->setPrintFooter(false);
$pdf->setFont('thsarabunnew001','',16);
$pdf->AddPage();
$html = '<p style="text-align:center; font-size:large;">แบบบันทึกการยืมพัสดุ
</p>
<p style="text-align:right;">เขียนที่ คณะอุตสาหกรรมเกษตร <br /> วันที่ 27 เดือน พฤษภาคม พ.ศ. 2565</p>
<p style="text-align:left;">เรื่อง ขอยืมครุภัณฑ์ <br /> เรียนคณบดีคณะอุตสาหกรรมเกษตร</p>
';
$pdf->writeHTML($html, true, false, true, false, '');
$pdf->Output();
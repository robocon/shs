<?php 
/**
 * @param string $txt_number ปีงบ/เลขที่ 65/1
 * @param string $full_date_th วันเดือนปีแบบเต็ม 18 พฤศจิกายน 2564
 * @param string $physi_dt_name พ.ต.สุทัศน์ เครือแก้ว
 * @param string $physi_dt_code ก.3023
 * @param string $ptname นายอรุณ สวัสดิ์
 * @param string $pt_hn 49-9999
 * @param string $pt_diag ปวดไหล่
 * @param string $file_path physi_certificate/_pdf_name.pdf
 */

$pdf = new SHSPdf('P', 'mm', array( 148, 210));
$pdf->SetThaiFont(); // เซ็ตฟอนต์
$pdf->SetFont('THSarabun','',18); // เรียกใช้งานฟอนต์ที่เตรียมไว้
$pdf->SetAutoPageBreak(true, 2);
$pdf->SetMargins(2, 2);
$pdf->AddPage();

$pdf->Image('images/LogoFSH.jpg',10,5,22,32);

$pdf->SetFont('THSarabun','B',18);
$pdf->SetXY(2, 20);
$pdf->Cell(0, 8, 'ใบรับรองการเข้ารับการรักษากายภาพบำบัด', 0, 0, 'C');

$pdf->SetFont('THSarabun','',18);
$pdf->SetXY(2, 40);
$pdf->Cell(0, 8, 'ส่วนราชการ     แผนกกายภาพบำบัด  โรงพยาบาลค่ายสุรศักดิ์มนตรี', 0, 0, 'L');

$pdf->SetXY(2, 56);
$pdf->Write(8,"เลขที่ ");
$pdf->SetFont('THSarabun','B',18);
$pdf->Write(8, $txt_number);

$pdf->SetXY(45, 56);
$pdf->SetFont('THSarabun','',18);
$pdf->Write(8,"วันที่ ");
$pdf->SetFont('THSarabun','B',18);
$pdf->Write(8, iconv('UTF-8', 'Windows-874', $full_date_th));

$pdf->SetXY(2, 72);
$pdf->SetFont('THSarabun','',18);
$pdf->Write(8,"     ข้าพเจ้า");
$pdf->SetFont('THSarabun','B',18);
$pdf->Write(8, " ".iconv('UTF-8', 'Windows-874', $physi_dt_name)." ");
$pdf->SetFont('THSarabun','',18);
$pdf->Write(8,"ตำแหน่ง นักกายภาพบำบัด ใบประกอบวิชาชีพ เลขที่");
$pdf->SetFont('THSarabun','B',18);
$pdf->Write(8, " ".iconv('UTF-8', 'Windows-874', $physi_dt_code)." ");
$pdf->SetFont('THSarabun','',18);
$pdf->Write(8,"ได้ทำการรักษาทางกายภาพบำบัด");
$pdf->SetFont('THSarabun','B',18);
$pdf->Write(8,"\n".iconv('UTF-8', 'Windows-874', $ptname)." HN.$pt_hn ");
$pdf->SetFont('THSarabun','',18);
$pdf->Write(8,"ตามที่แพทย์ได้วินิจฉัยโรค");
$pdf->SetFont('THSarabun','B',18);
$pdf->Write(8," ".iconv('UTF-8', 'Windows-874', $pt_diag)." ");

$pdf->SetFont('THSarabun','',18);
$currY = $pdf->getY() + 24;
$pdf->SetXY(74, $currY);
$pdf->Cell(0, 8, 'ลงชื่อ', 0, 0, 'L');

$currY += 16;
$pdf->SetXY(74, $currY);
$pdf->Cell(0, 8, "( ".iconv('UTF-8', 'Windows-874', $physi_dt_name)." )", 0, 0, 'C');

$currY += 8;
$pdf->SetXY(74, $currY);
$pdf->Cell(0, 8, 'นักกายภาพบำบัด', 0, 0, 'C');

$pdf->AutoPrint(true);
$pdf->Output($file_path,'F');
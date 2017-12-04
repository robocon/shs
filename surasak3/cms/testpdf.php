<?php

require("fpdf.php");
//require("fpdf/pdf.php");
 
$pdf=new FPDF( 'P' , 'cm' , 'A4' );
$pdf->SetMargins(3,1.5,2);
$pdf->AddPage();


$pdf->Image('original_Tra-Khrut.gif',3,1.5,1.5,1.5,'','');
$pdf->AddFont('THSarabun','b','THSarabun Bold.php');


$pdf->SetFont('THSarabun','b',29);
$pdf->Cell(0 ,2 , 'บันทึกข้อความ'  , 0 , 1 , 'C' );

$pdf->Ln(0.1);
$pdf->AddFont('THSarabun','b','THSarabun Bold.php');
$pdf->SetFont('THSarabun','b',20);
$pdf->Cell(0.1,0,'ส่วนราชการ');
$pdf->AddFont('THSarabun','','THSarabun.php');//ธรรมดา
$pdf->SetFont('THSarabun','',16);
$pdf->Cell(11,0,'กองเภสัชกรรม    รพ.ค่ายสุรศักดิ์มนตรี',0,0,'C');
$pdf->Ln(1);

$pdf->AddFont('THSarabun','b','THSarabun Bold.php');
$pdf->SetFont('THSarabun','b',20);
$pdf->Cell(0,0,'ที่ กห.0483.63.4');
$pdf->Ln(1);

$pdf->AddFont('THSarabun','b','THSarabun Bold.php');
$pdf->SetFont('THSarabun','b',20);
$pdf->Cell(0.1,0,'เรื่อง');
$pdf->AddFont('THSarabun','','THSarabun.php');//ธรรมดา
$pdf->SetFont('THSarabun','',16);
$pdf->Cell(5,0,'ขออนุมัติจัดซื้อยา',0,0,'C');
$pdf->Ln(1);

$pdf->AddFont('THSarabun','b','THSarabun Bold.php');
$pdf->SetFont('THSarabun','b',20);
$pdf->Cell(0.1,0,'เรียน');
$pdf->AddFont('THSarabun','','THSarabun.php');//ธรรมดา
$pdf->SetFont('THSarabun','',16);
$pdf->Cell(6,0,'ผอ.รพ.ค่ายสุรศักดิ์มนตรี',0,0,'C');
$pdf->Ln(1);

$pdf->AddFont('THSarabun','b','THSarabun Bold.php');
$pdf->SetFont('THSarabun','b',20);
$pdf->Cell(1.5,0,'อ้างถึง');
$pdf->AddFont('THSarabun','','THSarabun.php');//ธรรมดา
$pdf->SetFont('THSarabun','',16);
$pdf->Cell(0,0,'1. ระเบียบสำนักนายกรัฐมนตรี ว่าด้วย การพัสดุ พ.ศ.2535, ลง 20 ม.ค. 2535, และที่แก้ไขเพิ่มเติม',0,0,'C');
$pdf->Ln(1);

$pdf->AddFont('THSarabun','b','THSarabun Bold.php');
$pdf->SetFont('THSarabun','b',20);
$pdf->Cell(1.5,0,'');
$pdf->AddFont('THSarabun','','THSarabun.php');//ธรรมดา
$pdf->SetFont('THSarabun','',16);
$pdf->Cell(0,0,'2. คำสั่ง กห (เฉพาะ) ที่ 50/50 16 มี.ค. 2550 เรื่อง การพัสดุ',0,0,'');
$pdf->Ln(1);

$pdf->AddFont('THSarabun','b','THSarabun Bold.php');
$pdf->SetFont('THSarabun','b',20);
$pdf->Cell(1.5,0,'');
$pdf->AddFont('THSarabun','','THSarabun.php');//ธรรมดา
$pdf->SetFont('THSarabun','',16);
$pdf->Cell(0,0,'3. คำสั่ง ทบ (เฉพาะ) ที่ 476/44 เรื่อง มอบอำนาจอนุมัติการเบิกจ่ายเงินรายรับสถานพยาบาล',0,0,'');
$pdf->Ln(1);


$pdf->AddFont('THSarabun','b','THSarabun Bold.php');
$pdf->SetFont('THSarabun','b',20);
$pdf->Cell(1.5,0,'สิ่งที่ส่งมาด้วย');
$pdf->AddFont('THSarabun','','THSarabun.php');//ธรรมดา
$pdf->SetFont('THSarabun','',16);
$pdf->Cell(15,0,'1. หนังสือกองเภสัชกรรม รพ.ค่ายฯ ที่00525/55ลงวันที่4 มกราคม 2555',0,0,'C');
$pdf->Ln(1);

$pdf->AddFont('THSarabun','b','THSarabun Bold.php');
$pdf->SetFont('THSarabun','b',20);
$pdf->Cell(3.6,0,'');
$pdf->AddFont('THSarabun','','THSarabun.php');//ธรรมดา
$pdf->SetFont('THSarabun','',16);
$pdf->Cell(3,0,'2. บัญชีรายละเอียดในการ จัดซื้อ จำนวน 1 ชุด',0,0,'');
$pdf->Ln(1);

$pdf->MultiCell(1,1, '1. เนื่องด้วยกองเภสัชกรรม รพ.ค่ายฯ มีความจำเป็นที่จะต้องจัดซื้อยาเพื่อใช้ในราชการ รพ.ค่ายฯ5555555555555555555555555555555555555555',0,0,'');
$pdf->Ln(1);



/*$pdf->AddFont('THSarabun','b','THSarabun Bold.php');//หนา
$pdf->SetFont('THSarabun','b',30);
$pdf->Cell(3,1.5,'ข้อความทดสอบ');
$pdf->Ln(15);*/

$pdf->Output();
?>

<?php 
require_once 'bootstrap.php';
require_once 'fpdf_thai/shspdf.php';

$dbi = new mysqli(HOST,USER,PASS,DB);

$pdf = new SHSPdf('L', 'mm', array(50,30));
$pdf->SetThaiFont(); // เซ็ตฟอนต์
$pdf->SetAutoPageBreak(true, 2);
$pdf->SetMargins(2, 2);

$sql = "SELECT * FROM `opcardchk` 
WHERE part LIKE 'สอบตำรวจ63%' 
ORDER BY `row` ASC ";
$q = $dbi->query($sql);
while ($a = $q->fetch_assoc()) {

    $hn = $a["HN"];
    $name = $a["yot"].' '.$a["name"].' '.$a["surname"];
    $exam_no = $a['exam_no'];
    $type = '01';
    $labno2 = $hn.$type;

    for ($i=0; $i < 2; $i++) { 

    // แผ่น1-2
    $pdf->AddPage();
    $pdf->SetFont('AngsanaNew','B',18);
    $pdf->SetXY(2, 7);
    $pdf->Cell(0, 5, 'HN '.$hn, 0, 1, 'C');

    $pdf->SetFont('AngsanaNew','',14);
    $pdf->SetXY(2, 12);
    $pdf->Cell(0, 5, $name, 0, 1, 'C');

    $pdf->SetFont('AngsanaNew','B',18);
    $pdf->SetXY(2, 17);
    $pdf->Cell(0, 5, 'STOOL', 0, 1, 'C');
    }

    // แผ่น3
    $pdf->AddPage();
    $pdf->SetFont('AngsanaNew','B',18);
    $pdf->SetXY(2, 2);
    $pdf->Cell(0, 5, 'HN '.$hn, 0, 1, 'C');

    $pdf->SetFont('AngsanaNew','',14);
    $pdf->SetXY(2, 7);
    $pdf->Cell(0, 5, $name, 0, 1, 'C');

    $pdf->SetFont('AngsanaNew','',14);
    $pdf->SetXY(2, 12);
    $pdf->Cell(0, 5, 'เป็นปัสสาวะของ', 0, 1, 'C');
    $pdf->SetXY(2, 19);
    $pdf->Cell(0, 5, '...................................................', 0, 1, 'C');


    // แผ่น4
    $pdf->AddPage();
    $pdf->SetFont('AngsanaNew','B',18);
    $pdf->SetXY(2, 7);
    $pdf->Cell(0, 5, 'HN '.$hn, 0, 1, 'C');

    $pdf->SetFont('AngsanaNew','',14);
    $pdf->SetXY(2, 12 );
    $pdf->Cell(0, 5, $name, 0, 1, 'C');


    // แผ่น5
    $pdf->AddPage();
    $pdf->SetFont('AngsanaNew','B',18);
    $pdf->SetXY(2, 7);
    $pdf->Cell(0, 5, 'HN '.$hn, 0, 1, 'C');

    $pdf->SetFont('AngsanaNew','',14);
    $pdf->SetXY(2, 12);
    $pdf->Cell(0, 5, $name, 0, 1, 'C');

    $pdf->SetFont('AngsanaNew','B',18);
    $pdf->SetXY(2, 17);
    $pdf->Cell(0, 5, 'CHEM', 0, 1, 'C');

    // แผ่น6
    $pdf->AddPage();
    $pdf->SetFont('AngsanaNew','B',18);
    $pdf->SetXY(2, 2);
    $pdf->Cell(0, 5, 'HN '.$hn, 0, 1, 'C');

    $pdf->SetFont('AngsanaNew','',14);
    $pdf->SetXY(2, 7);
    $pdf->Cell(0, 5, $name, 0, 1, 'C');

    $pdf->Code128(7,12, $labno2,36,10);
    $pdf->SetXY(2, 22);
    $pdf->Cell(0, 5, $labno2, 0, 1, 'C');
}

$pdf->Output();
exit;
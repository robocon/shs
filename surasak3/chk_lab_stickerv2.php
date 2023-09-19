<?php 
require_once 'bootstrap.php';
require_once 'fpdf_thai/shspdf.php';

$part = input('part');
if( empty($part) ){ die('EEEEERRRRRRRRRRRRROOORR Company Name'); }

$action = input_post('action');
if ( $action == 'print' ) { 

    $dbi = new mysqli(HOST,USER,PASS,DB);
    $dbi->query("SET NAMES UTF8");

    $count_cbc = input_post('count_cbc');
    $count_chem = input_post('count_chem');
    $count_ua = input_post('count_ua');
    $count_ua_barcode = input_post('count_ua_barcode');
    $count_stool = input_post('count_stool');
    $count_cs = input_post('count_cs');
    $urine_cs = input_post('urine_cs');
    $afp = input_post('afp');
    $count_etc = input_post('count_etc');
    $row_print = input_post('row_print');

    // $ua_check = $_POST['ua_check'];

    $noDisplayBs = sprintf("%d", $_POST['noDisplayBs']);
    if(empty($noDisplayBs)){
        $noDisplayBs = 0;
    }

    if ( !empty($row_print) ) {
        list($min,$max) = explode('-', $row_print);

        $min = $min - 1;
        $range = $max - $min;

        $limit_txt = " LIMIT $min, $range";
    }

    $sql = "SELECT `exam_no`,`HN` AS `hn`,`pid`,`name`,`surname` 
    FROM `opcardchk` 
    WHERE `part` = '$part' 
    ORDER BY `row` ".$limit_txt;
    $q = $dbi->query($sql);

    $pdf = new SHSPdf('L', 'mm', array(50,30));
    $pdf->SetThaiFont(); // เซ็ตฟอนต์
    $pdf->SetAutoPageBreak(true, 2);
    $pdf->SetMargins(2, 2);

    while ($a = $q->fetch_assoc()) {

        $hn = $a['hn'];
        $ptname = trim($a['name']).' '.trim($a['surname']);
        $ptname = iconv("UTF-8", "TIS-620", $ptname);

        $code_exam = $a['exam_no'];
        if( empty($code_exam) ){
            $code_exam = (date('y') + 43).date('md').sprintf('%03d', $a['pid']);
        }

        $user_number = (int) substr($code_exam,6);
        $normal_code = $code_exam.'01';
        $chem_code = $code_exam.'02';
        $ua_code = $code_exam.'03';

        if( $count_cbc > 0 ){
            for ($i=0; $i < $count_cbc; $i++) { 

                $pdf->AddPage();

                $pdf->SetFont('AngsanaNew','',23);
                $pdf->TextWithDirection(5,20,$user_number,'U');

                $pdf->SetXY(2, 2);
                $pdf->SetFont('AngsanaNew','',13);
                $pdf->Cell(0, 5, $ptname, 0, 1, 'C');
                $pdf->SetXY(2, 7);
                $pdf->Cell(0, 5, $hn, 0, 1, 'C');

                // x=7, y=12, width=36, height=10
                $pdf->Code128(7,12, $normal_code,36,10);

                $pdf->SetXY(7, 22);
                $pdf->Cell(36, 5, $normal_code, 0, 1, 'C');

                $pdf->SetFont('AngsanaNew','',23);
                $pdf->TextWithDirection(48,18,'01','U');

            }
        }

        if( $count_chem > 0 ){
            for ($i=0; $i < $count_chem; $i++) { 
                $pdf->AddPage();

                $pdf->SetFont('AngsanaNew','',23);
                $pdf->TextWithDirection(5,20,$user_number,'U');

                $pdf->SetXY(2, 2);
                $pdf->SetFont('AngsanaNew','',13);
                $pdf->Cell(0, 5, $ptname, 0, 1, 'C');
                $pdf->SetXY(2, 7);
                $pdf->Cell(0, 5, $hn, 0, 1, 'C');

                // x=7, y=12, width=36, height=10
                $pdf->Code128(7,12, $chem_code,36,10);

                $pdf->SetXY(7, 22);
                $pdf->Cell(36, 5, $chem_code, 0, 1, 'C');

                $pdf->SetFont('AngsanaNew','',23);
                $pdf->TextWithDirection(48,18,'02','U');
            }
        }

        if( $count_ua > 0 ){ 
            for ($i=0; $i < $count_ua; $i++) { 
                $pdf->AddPage();

                $pdf->SetFont('AngsanaNew','',23);
                $pdf->TextWithDirection(5,20,$user_number,'U');

                $pdf->SetXY(2, 2);
                $pdf->SetFont('AngsanaNew','',13);
                $pdf->Cell(0, 5, $ptname, 0, 1, 'C');
                $pdf->SetXY(2, 7);
                $pdf->Cell(0, 5, $hn, 0, 1, 'C');

                // x=7, y=12, width=36, height=10
                $pdf->Code128(7,12, $ua_code,36,10);

                $pdf->SetXY(7, 22);
                $pdf->Cell(36, 5, $ua_code, 0, 1, 'C');

                $pdf->SetFont('AngsanaNew','',23);
                $pdf->TextWithDirection(48,18,'03','U');

                if(!empty($count_ua_barcode))
                {
                    $pdf->AddPage();
                    $pdf->SetFont('AngsanaNew','',23);
                    $pdf->TextWithDirection(5,20,$user_number,'U');

                    $pdf->SetXY(2, 2);
                    $pdf->SetFont('AngsanaNew','',13);
                    $pdf->Cell(0, 5, $ptname, 0, 1, 'C');

                    $pdf->SetFont('AngsanaNew','B',23);
                    $pdf->SetXY(2, 7);
                    $pdf->Cell(0, 5, $hn, 0, 1, 'C');

                    $pdf->SetXY(2, 12);
                    $pdf->Cell(0, 5, 'UA', 0, 1, 'C');

                    $pdf->SetFont('AngsanaNew','',23);
                    $pdf->TextWithDirection(48,18,'03','U');
                }

            }
        }

        if( $count_cs > 0 ){ 
            for ($i=0; $i < $count_cs; $i++) { 
                $pdf->AddPage();
                $pdf->SetXY(2, 5);
                $pdf->SetFont('AngsanaNew','B',13);
                $pdf->Cell(0, 5, $ptname, 0, 1, 'C');
                $pdf->SetXY(2, 12);
                $pdf->SetFont('AngsanaNew','B',20);
                $pdf->Cell(0, 5, $hn, 0, 1, 'C');
                $pdf->SetXY(2, 19);
                $pdf->SetFont('AngsanaNew','B',20);
                $pdf->Cell(0, 5, 'STOOL C/S', 0, 1, 'C');
            }
        }

        if( $urine_cs > 0 ){
            for ($i=0; $i < $urine_cs; $i++) { 
                $pdf->AddPage();
                $pdf->SetXY(2, 5);
                $pdf->SetFont('AngsanaNew','B',13);
                $pdf->Cell(0, 5, $ptname, 0, 1, 'C');
                $pdf->SetXY(2, 12);
                $pdf->SetFont('AngsanaNew','B',20);
                $pdf->Cell(0, 5, $hn, 0, 1, 'C');
                $pdf->SetXY(2, 19);
                $pdf->SetFont('AngsanaNew','B',20);
                $pdf->Cell(0, 5, 'Urine C/S', 0, 1, 'C');
            }
        }

        if( $afp > 0 ){
            for ($i=0; $i < $afp; $i++) { 
                $pdf->AddPage();
                $pdf->SetXY(2, 2);
                $pdf->SetFont('AngsanaNew','B',13);
                $pdf->Cell(0, 5, 'โรงพยาบาลค่ายสุรศักดิ์มนตรี', 0, 1, 'C');

                $pdf->SetXY(2, 7);
                $pdf->SetFont('AngsanaNew','B',13);
                $pdf->Cell(0, 5, $ptname, 0, 1, 'C');

                $pdf->SetXY(2, 12);
                $pdf->SetFont('AngsanaNew','B',13);
                $pdf->Cell(0, 5, $hn.' (ตรวจสุขภาพ AFP)', 0, 1, 'C');

                $pdf->SetXY(2, 17);
                $pdf->SetFont('AngsanaNew','B',13);
                $pdf->Cell(0, 5, 'OUTLAB '.$chem_code, 0, 1, 'C');
            }
        }

        if( $count_etc > 0 ){ 
            for ($i=0; $i < $count_etc; $i++) { 
                
                $pdf->AddPage();
                $pdf->SetXY(2, 7);
                $pdf->SetFont('AngsanaNew','B',13);
                $pdf->Cell(0, 5, $ptname, 0, 1, 'C');

                $pdf->SetXY(2, 12);
                $pdf->SetFont('AngsanaNew','B',20);
                $pdf->Cell(0, 5, $hn, 0, 1, 'C');
            }
        }

        // ถ้ามีการติ๊ก "ไม่แสดงสติกเกอร์ BS" ค่าของ $noDisplayBs จะเป็น 1
        if($noDisplayBs==0){ 
            $sqlBs = "SELECT * FROM `chk_lab_items` WHERE `hn` = '$hn' AND `part` = '$part' AND `item_sso` = 'bs' ";
            $qBs = $dbi->query($sqlBs);
            if($qBs->num_rows > 0)
            {
                $bs = $qBs->fetch_assoc();
                $bs_user_number = (int) substr($bs['labnumber'],6);
                $bs_code = $bs['labnumber'].'02';
                
                $pdf->AddPage();

                $pdf->SetFont('AngsanaNew','',23);
                $pdf->TextWithDirection(5,20,$bs_user_number,'U');

                $pdf->SetXY(2, 2);
                $pdf->SetFont('AngsanaNew','B',13);
                $pdf->Cell(0, 5, $ptname, 0, 1, 'C');

                $pdf->SetXY(2, 7);
                $pdf->SetFont('AngsanaNew','B',20);
                $pdf->Cell(0, 5, $hn.' (BS)', 0, 1, 'C');

                $pdf->Code128(7,12, $bs_code,36,10);

            }
        }
        
        if( $count_stool > 0 ){ 

            $stool_txt = 'STOOL';
            $stool_thai = sprintf("%d", $_POST['stool_thai']);
            if ($stool_thai==1) {
                $stool_txt = 'อุจจาระ';
            }

            for ($i=0; $i < $count_stool; $i++) { 
                
                $pdf->AddPage();
                $pdf->SetXY(2, 7);
                $pdf->SetFont('AngsanaNew','B',13);
                $pdf->Cell(0, 5, $ptname, 0, 1, 'C');

                $pdf->SetXY(2, 12);
                $pdf->SetFont('AngsanaNew','B',20);
                $pdf->Cell(0, 5, $hn, 0, 1, 'C');

                $pdf->SetXY(2, 17);
                $pdf->SetFont('AngsanaNew','B',20);
                $pdf->Cell(0, 5, $user_number.'   '.$stool_txt, 0, 1, 'C');
            }
        }

    }

}




$pdf->Output();
exit;
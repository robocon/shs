<?php 
include 'bootstrap.php';
include 'fpdf_thai/shspdf.php';

// $dbi = new mysqli(HOST,USER,PASS,DB);
$dbi = new mysqli('192.168.131.250','remoteuser','',DB);

$id = $_REQUEST['id'];
$physi_dt = $_REQUEST['physi_dt'];
if(empty($id) OR empty($physi_dt))
{
    echo "ข้อมูลไม่ถูกต้อง";
    exit;
}

$physi_dt_list = array(
    '3023' => 'พ.ต.สุทัศน์ เครือแก้ว', 
    '10399' => 'ร.ท.หญิงปุณนาพร อินทรรักษ์', 
    '9927' => 'นางสาววรางคณา ธาตุรักษ์', 
    '12560' => 'นางสาววรดา เตจะน้อย' 
);

$physi_dt_code = "ก.".$physi_dt;
$physi_dt_name = $physi_dt_list[$physi_dt];

$m = date('m');
$full_date_th = date('d').' '.$def_fullm_th[$m].' '.(date('Y')+543);

$sql = "SELECT * FROM `depart` WHERE `row_id` = '$id' ";
$q = $dbi->query($sql);
$pt = $q->fetch_assoc();
$ptname = $pt['ptname'];
$pt_hn = $pt['hn'];
$pt_diag = $pt['diag'];

$file_name = date('Ymd').'-'.$pt_hn.'-'.$physi_dt.".pdf";
$file_path = 'physi_certificate/'.$file_name;

// จะเอาตามปีงบ ขึ้นต้นปีด้วย0
$sql_get_runno = "SELECT `prefix`,`runno` FROM `runno` WHERE `title` = 'physi_cert' ";
$q = $dbi->query($sql_get_runno);
$runno = $q->fetch_assoc();

$next_number = $runno['runno'] + 1;
$txt_number = $runno['prefix'].'/'.$next_number;

$sql_update_runno = "UPDATE `runno` SET `runno` = '$next_number' WHERE `title` = 'physi_cert' ";
$dbi->query($sql_update_runno);


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
// $pdf->Cell(0, 8, 'เลขที่ 65/1', 1, 1, 'L');
$pdf->Write(8,"เลขที่ ");
$pdf->SetFont('THSarabun','B',18);
$pdf->Write(8, $txt_number);

$pdf->SetXY(45, 56);
$pdf->SetFont('THSarabun','',18);
$pdf->Write(8,"วันที่ ");
$pdf->SetFont('THSarabun','B',18);
$pdf->Write(8,$full_date_th);
// $pdf->Cell(0, 8, 'วันที่ 11 พฤศจิกายน 2564', 1, 1, 'C');

$pdf->SetXY(2, 72);
$pdf->SetFont('THSarabun','',18);
$pdf->Write(8,"     ข้าพเจ้า");
$pdf->SetFont('THSarabun','B',18);
$pdf->Write(8, " $physi_dt_name ");
$pdf->SetFont('THSarabun','',18);
$pdf->Write(8,"ตำแหน่ง นักกายภาพบำบัด ใบประกอบวิชาชีพ เลขที่");
$pdf->SetFont('THSarabun','B',18);
$pdf->Write(8, " $physi_dt_code ");
$pdf->SetFont('THSarabun','',18);
$pdf->Write(8,"ได้ทำการรักษาทางกายภาพบำบัด");
$pdf->SetFont('THSarabun','B',18);
$pdf->Write(8," $ptname HN.$pt_hn ");
$pdf->SetFont('THSarabun','',18);
$pdf->Write(8,"ตามที่แพทย์ได้วินิจฉัยโรค");
$pdf->SetFont('THSarabun','B',18);
$pdf->Write(8," $pt_diag ");

// $mul_txt = "     ข้าพเจ้า ร.ท.หญิงปุณนาพร อินทรรักษ์ ตำแหน่ง นักกายภาพบำบัด ใบประกอบวิชาชีพ   เลขที่ ก.10399 ได้ทำการรักษาทางกายภาพบำบัด นางลำไย ไหทองคำ HN.49-9999 ตามที่แพทย์ได้วินิจฉัยโรค Muscle strain\n";
// $pdf->MultiCell(0, 8, $mul_txt, 1);

$pdf->SetFont('THSarabun','',18);
$currY = $pdf->getY() + 24;
$pdf->SetXY(74, $currY);
$pdf->Cell(0, 8, 'ลงชื่อ', 0, 0, 'L');

$currY += 16;
$pdf->SetXY(74, $currY);
$pdf->Cell(0, 8, "( $physi_dt_name )", 0, 0, 'C');

$currY += 8;
$pdf->SetXY(74, $currY);
$pdf->Cell(0, 8, 'นักกายภาพบำบัด', 0, 0, 'C');

$pdf->AutoPrint(true);
$pdf->Output($file_path,'F');

?>
<button type="button">ปิดหน้าต่าง</button>
<iframe src="<?=$file_path;?>" frameborder="0" width="100%" height="100%" id="printf" name="printf"></iframe>
<script>
    setTimeout(function(){ 
        window.frames["printf"].focus();
        window.frames["printf"].print();
     }, 500);

    window.onfocus = function(){
        setTimeout(function(){
            window.close();
        }, 100);
    }

</script>
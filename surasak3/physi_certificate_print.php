<?php 

include 'bootstrap.php';
include 'fpdf_thai/shspdf.php';

if(empty($_SESSION['sRowid']))
{
    redirect('../nindex.htm');
    exit;
}

$dbi = new mysqli(HOST,USER,PASS,DB);
$dbi->query("SET NAMES UTF8");

$pt_hn = $_REQUEST['hn'];
$physi_dt = $_REQUEST['physi_dt'];

list($Ys, $Ms, $Ds) = explode('-', $_REQUEST['date_save']);
$date_save = ($Ys-543)."-$Ms-$Ds";
$full_date_th = $Ds.' '.$def_fullm_th[$Ms].' '.$Ys;

$pt_diag = $_REQUEST['diag'];

if(empty($hn) OR empty($physi_dt) OR empty($date_save) OR empty($diag))
{
    echo "ข้อมูลไม่ครบถ้วน กรุณาตรวจสอบข้อมูลอีกครั้ง";
    exit;
}

$sql_opcard = "SELECT CONCAT(`yot`,' ',`name`,'  ',`surname`) AS `ptname` FROM `opcard` WHERE `hn` = '$pt_hn' ";
$q_opcard = $dbi->query($sql_opcard);
$op = $q_opcard->fetch_assoc();
$ptname = $op['ptname'];

$physi_dt_list = array(
    '3023' => 'พ.ต.สุทัศน์ เครือแก้ว', 
    '10399' => 'ร.ท.หญิงปุณนาพร อินทรรักษ์', 
    '9927' => 'นางสาววรางคณา ธาตุรักษ์', 
    '12560' => 'นางสาววรดา เตจะน้อย' 
);

$physi_dt_code = "ก.".$physi_dt;
$physi_dt_name = $physi_dt_list[$physi_dt];

// $m = date('m');
// $full_date_th = date('d').' '.$def_fullm_th[$m].' '.(date('Y')+543);

if(!file_exists('physi_certificate'))
{
    mkdir('physi_certificate');
}

$file_name = date('Ymd').'-'.$pt_hn.'-'.$physi_dt.".pdf";
$file_path = 'physi_certificate/'.$file_name;

$editor_id = get_session('sRowid');
$sOfficer = get_session('sOfficer');
$curr_date = date('Y-m-d');

$sql_his = "SELECT * FROM `physi_cert_history` WHERE `hn` = '$hn' AND `date_save` = '$curr_date' ";
$q_his = $dbi->query($sql_his);
if($q_his->num_rows > 0 )
{
    $cert = $q_his->fetch_assoc();
    $cert_id = $cert['id'];
    $txt_number = $cert['number'];

    // ลบไฟล์เดิม
    $test = unlink($cert['file_path']);

    $sql_his_update = "UPDATE `physi_cert_history` 
    SET `physi_dt_name`='$physi_dt_name', 
    `physi_license`='$physi_dt_code', 
    `hn`='$pt_hn', 
    `ptname`='$ptname', 
    `diag`='$pt_diag', 
    `file_path`='$file_path', 
    `editor`='$editor_id', 
    `officer` = '$sOfficer' 
    WHERE `id` = '$cert_id' ;";
    $save = $dbi->query($sql_his_update);

}
else
{
    // เลขที่ จะเอาตามปีงบ ขึ้นต้นปีด้วย0
    $sql_get_runno = "SELECT `prefix`,`runno` FROM `runno` WHERE `title` = 'physi_cert' ";
    $q = $dbi->query($sql_get_runno);
    $runno = $q->fetch_assoc();

    $next_number = $runno['runno'] + 1;
    $txt_number = $runno['prefix'].'/'.$next_number;

    $sql_update_runno = "UPDATE `runno` SET `runno` = '$next_number' WHERE `title` = 'physi_cert' ";
    $dbi->query($sql_update_runno);

    $sql_cert = "INSERT INTO `physi_cert_history` ( 
        `date_save`,`number`, `date`, `physi_dt_name`, `physi_license`, `hn`, `ptname`, `diag`, `file_path`, `editor`, `officer`
    ) VALUES ( 
        '$curr_date', '$txt_number', '$full_date_th', '$physi_dt_name', '$physi_dt_code', '$pt_hn', '$ptname', '$pt_diag', '$file_path', '$editor_id', '$sOfficer'
    );";
    $save = $dbi->query($sql_cert);
}

if($save==false)
{
    echo $dbi->error;
    exit;
}

/**
 * ค่าที่ส่งเข้าไปในแบบฟอร์มมีดังนี้
 * 
 * @param string $txt_number ปีงบ/เลขที่ 65/1
 * @param string $full_date_th วันเดือนปีแบบเต็ม 18 พฤศจิกายน 2564
 * @param string $physi_dt_name พ.ต.สุทัศน์ เครือแก้ว
 * @param string $physi_dt_code ก.3023
 * @param string $ptname นายอรุณ สวัสดิ์
 * @param string $pt_hn 49-9999
 * @param string $pt_diag ปวดไหล่
 * @param string $file_path physi_certificate/_pdf_name.pdf เซฟไฟล์ไปตามพาธที่กำหนด
 */
require_once 'physi_certificate_template.php';
?>
<button type="button">ปิดหน้าต่าง</button>
<iframe src="<?=$file_path;?>" frameborder="0" width="100%" height="100%" id="printf" name="printf"></iframe>
<!--
<div id="new_embed">
    <object data="<?=$file_path;?>" type="application/pdf">
        <p>It appears you don't have Adobe Reader or PDF support in this web browser. <a href="<?=$file_path;?>">Click here to download the PDF</a>. Or <a href="http://get.adobe.com/reader/" target="_blank">click here to install Adobe Reader</a>.</p>
       <embed src="<?=$file_path;?>" type="application/pdf" />
    </object>
</div>
-->
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
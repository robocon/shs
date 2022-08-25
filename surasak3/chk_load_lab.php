<?php 
require 'bootstrap.php';
$dbi = new mysqli(HOST, USER, PASS, DB);
$dbi->query("SET NAMES UTF8");
if(empty($_REQUEST['id']))
{
    exit;
}
$id = $_REQUEST['id'];
$q = $dbi->query("SELECT `id`,`code` FROM `chk_company_list` WHERE `id` = '$id' ");
if($q->num_rows > 0)
{
    $com = $q->fetch_assoc();
    $code = $com['code'];
}
else
{
    echo "Invalid value";
    exit;
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ใบรายงานผลทางห้องปฏิบัติการ-ตรวจสุขภาพ</title>
    <style type="text/css">
	body,td,th {
		font-family: "TH SarabunPSK";
		font-size: 18px;
	}
	.tg{
		border-collapse:collapse;
		border-spacing:0;
	}
	.tg td{
		overflow:hidden;
		word-break:normal;
	}
	.tg th{
		font-weight:normal;
		overflow:hidden;
		word-break:normal;
	}
	.tg .tg-0lax{
		vertical-align:top;
	}
	.labContent{
		font-size: 14px;
	}
	.labTitle{
		border-top: 1px solid black;
		border-bottom: 1px solid black;
	}
	.tbFooter{
		border-top: 1px solid #000000;
	}
	.tbFooter tr td{
		font-size: 16px!important;
	}
	.style1 {font-size: 13px}
	@media print {
        * {
            -webkit-print-color-adjust: exact;
        }
    }
	</style>
</head>
<body>
<?php 
$sql = "SELECT `HN`,`exam_no` FROM `opcardchk` WHERE `part` = '$code' ORDER BY `row` ASC ";
$q = $dbi->query($sql);

$testContent = array();
while ($a = $q->fetch_assoc()) {
    $exam_no = $a['exam_no'];
	if(empty($exam_no))
	{
		echo "ไม่สามารถพิมพ์ผลได้เนื่องจากจำเป็นต้องใช้ exam_no";
		exit;
	}
    $hn = $a['HN'];
    $url = 'http://'.$_SERVER['HTTP_HOST'].dirname($_SERVER['PHP_SELF'])."/get_multi_lab.php?hn=$hn&labnumber=$exam_no";
    $content = file_get_contents($url);
	if(empty($content))
	{
		$testContent[] = $hn;
	}
	else{
		echo $content;
	}
}

if(!empty($testContent))
{
	echo 'ไม่พบข้อมูลการตรวจ METAMP ใน HN '.implode(', ', $testContent);
}
?>
</body>
</html>
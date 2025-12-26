<?php
session_start();
include("connect.php");

$dbi = new mysqli($ServerName, $User, $Password, $DatabaseName);
$dbi->query("SET NAMES UTF8");

function dump($t){
    echo "<pre>";
    var_dump($t);
    echo "</pre>";
}

$appdate = $_POST['appdate'];
$appmo = $_POST['appmo'];
$thiyr = $_POST['thiyr'];
$dmyDate = $appdate.'-'.$appmo.'-'.$thiyr;
$appd=$appdate.'/'.$appmo.'/'.$thiyr;
$appd1=$thiyr.'-'.$appmo.'-'.$appdate;
?>
<!DOCTYPE html>
<html lang="th">
<head>
<meta charset="UTF-8">
<title>รายงานผู้ป่วยนอก</title>
<link href="https://fonts.googleapis.com/css2?family=Noto+Sans+Thai:wght@400;600&display=swap" rel="stylesheet">
<style>
    body {
        font-family: 'Noto Sans Thai', sans-serif;
        background: linear-gradient(135deg,#f0f8ff,#f9fbe7);
        margin: 0;
        padding: 30px;
        color: #333;
    }
    .container {
        max-width: 900px;
        margin: auto;
        background: #fff;
        border-radius: 16px;
        padding: 30px 40px;
        box-shadow: 0 8px 25px rgba(0,0,0,0.1);
    }
    h2 {
        text-align: center;
        margin-bottom: 20px;
        color: #2c3e50;
    }
    .btn-back, .btn-menu {
        display: inline-block;
        margin: 10px 5px;
        padding: 8px 20px;
        border-radius: 8px;
        text-decoration: none;
        font-weight: 600;
        transition: 0.2s;
    }
    .btn-back {
        background: #6c757d;
        color: #fff;
    }
    .btn-menu {
        background: #007bff;
        color: #fff;
    }
    .btn-back:hover { background: #5a6268; }
    .btn-menu:hover { background: #0056b3; }
    table {
        width: 100%;
        border-collapse: collapse;
        margin-top: 25px;
    }
    th, td {
        padding: 12px 15px;
        border-bottom: 1px solid #ddd;
        text-align: left;
        font-size: 16px;
    }
    th {
        background: #4caf50;
        color: #fff;
    }
    tr:nth-child(even) {
        background: #f9f9f9;
    }
    tr:hover {
        background: #f1f1f1;
    }
    a.link-report {
        color: #007bff;
        font-weight: 500;
        text-decoration: none;
    }
    a.link-report:hover {
        text-decoration: underline;
    }
    .summary {
        margin-top: 15px;
        font-weight: 600;
        color: #444;
    }
</style>
</head>
<body>
<div class="container">
    <h2>📋 รายงานลูกหนี้ผู้ป่วยนอก</h2>
    <p><b>วันที่:</b> <?php echo $appd; ?></p>
    <a href="javascript:history.back()" class="btn-back">&laquo; กลับไป</a><a href="../nindex.htm" class="btn-menu">เมนูหลัก</a>
    <hr>
    <div class='summary'>จำนวนรายการที่บันทึก / กดดู = รายชื่อผู้ป่วย</div>
    <?php
    $query="SELECT credit,COUNT(*) AS duplicate 
            FROM opacc 
            WHERE date like '$appd1%'   
            GROUP BY credit 
            HAVING duplicate > 0 
            ORDER BY credit";
    $result = mysql_query($query);
    $n=0;
    $num=0;

    echo "<table>";
    echo "<tr><th>#</th><th>สิทธิ / บริษัท</th><th>จำนวนรายการ</th></tr>";

    while (list ($credit,$duplicate) = mysql_fetch_row ($result)) {
        if($credit=="ตรวจสุขภาพตำรวจ") { continue; }

        $n++;
        $num += $duplicate;

        echo "<tr>";
        echo "<td>$n</td>";
        echo "<td><a target='_blank' class='link-report' href=\"chkmonycredit1.php?doctor1=$credit&yr=$thiyr&m=$appmo&d=$appdate\">$credit</a></td>";
        echo "<td>$duplicate รายการ</td>";
        echo "</tr>";
    }
    

    /**
     * ตรวจสอบข้อมูลพิเศษ "ตรวจสุขภาพตำรวจ"
     */
    if( $appd1 == '2568-05-26' ){
        $log_datechk = ($thiyr-543).'-'.$appmo.'-'.$appdate;
        $part = 'ศูนย์ฝึกอบรมตำรวจภูธร ภาค 5 68';

        $sql = "SELECT log_datechk, type, COUNT(log_id) AS log_count
        FROM log_opcardchk 
        WHERE log_datechk LIKE '$log_datechk%' AND log_part = '$part' 
        GROUP BY type;";

        $q = mysql_query($sql);
        if(mysql_num_rows($q) > 0){ 
            echo "<h3 style='margin-top:30px;'>🔍 ตรวจสุขภาพตำรวจ</h3>";
            while($a = mysql_fetch_assoc($q)){
                $partEncode = urlencode($part);
                $typeEncode = urlencode($a['type']);
                $count = $a['log_count'];
                echo "<p><a target='_blank' class='link-report' href=\"chk_credit_police63.php?repdate=$appd&part=$partEncode&type=$typeEncode\">ตรวจสุขภาพตำรวจ - {$a['type']}</a> จำนวน = $count รายการ</p>";
            }
        }
    }

    /*
    $n++;
    ?>
    <tr>
        <td><?= $n ?></td>
        <td><a target='_blank' class='link-report' href=\"chk_credit_police63.php?repdate=$appd&part=$partEncode&type=$typeEncode\">ตรวจสุขภาพตำรวจ - {$a['type']}</a> จำนวน = $count รายการ</td>
        <td></td>
    </tr>
    <?php
    */
    
    if( $appd1 == '2568-12-18' OR $appd1 == '2568-12-19' OR $appd1 == '2568-12-22' OR $appd1 == '2568-12-23' ){
        $n++;

        $sql = "SELECT a.*, CONCAT(b.`yot`,b.`name`,' ',b.`surname`) AS `ptname`, b.`ptright`, 
        c.`vn` 
        FROM (
            SELECT * FROM `manual_expense` WHERE `part` = 'มหาวิทยาลัยราชภัฏลำปาง 68' 
        ) AS a LEFT JOIN `opcard` AS b ON a.`hn` = b.`hn`
        LEFT JOIN (
            SELECT `row_id`,`thidate`,`hn`,`vn`,`ptname`,toborow 
            FROM opday 
            WHERE thidate LIKE '$appd1%' 
        ) AS c ON a.`hn` = c.`hn` 
        WHERE c.`row_id` IS NOT NULL
        ORDER BY a.`labnumber` ASC";
        $q = $dbi->query($sql);
        $rows = $q->num_rows;

        $q2 = $dbi->query("SELECT * FROM `opacc` WHERE `date` LIKE '$appd1%' AND `credit` = 'SSOCHECKUP68'");
        $opaccRows = $q2->num_rows;

        $urlArray = array(
            'company1'=>'มหาวิทยาลัยราชภัฏลำปาง 68',
            'company2'=>'คณะพยาบาลศาสตร์ มหาวิทยาลัยราชภัฏลำปาง 68 ธ.ค.',
            'date'=>$dmyDate,
            'appd1' => $appd1
        );
        $url = http_build_query($urlArray);
        ?>
        <tr>
            <td><?= $n ?></td>
            <td><a target='_blank' class='link-report' href="chk_credit_lpru.php?<?=$url;?>">มหาวิทยาลัยราชภัฏลำปาง 68 (<?= $rows; ?> ราย)</a></td>
            <td></td>
        </tr>
        <?php
    }
    echo "</table>";
    ?>
</div>
</body>
</html>

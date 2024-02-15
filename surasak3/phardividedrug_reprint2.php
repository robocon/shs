<?php
require_once 'bootstrap.php';
$dbi = new mysqli(HOST,USER,PASS,DB);
$dbi->query("SET NAMES UTF8");

$id = sprintf("%s", $_GET['id']);
$an = sprintf("%s", $_GET['an']);
if(empty($an)){
    echo "Invalid AN";
    exit;
}

$q = $dbi->query("SELECT * FROM ipcard WHERE an = '$an' ");
if($q->num_rows===0){
    echo "AN Not Found";
    exit;
}
$ipcard = $q->fetch_assoc();

$qPhardep = $dbi->query("SELECT * FROM phardep WHERE row_id = '$id' LIMIT 1");
$phardep = $qPhardep->fetch_assoc();

$build = array("42"=>"หอผู้ป่วยหญิง","44"=>"หอผู้ป่วย ICU","43"=>"หอผู้ป่วยสูติ","45"=>"หอผู้ป่วยพิเศษ");
$bedcode = substr($ipcard['bedcode'],0,2);
$bedNumber = str_replace($bedcode,'',$ipcard['bedcode']);

$qIpacc = $dbi->query("SELECT `date`,`status` FROM ipacc WHERE idno = '$id' LIMIT 1");
$ipacc = $qIpacc->fetch_assoc();
$ipaccStatus = $ipacc['status'];
$ipaccDate = $ipacc['date'];

$_SESSION['drugbill'] = "&nbsp;&nbsp;<font face='Angsana New'>$ipaccStatus, วันที่ ".$ipaccDate."<BR>&nbsp;&nbsp;".$build[$bedcode].", เตียง : ".$bedNumber.", ".$ipcard["ptname"].", อายุ ".$ipcard["age"].", HN:".$ipcard["hn"].", AN:".$ipcard["an"]."<BR>&nbsp;&nbsp;สิทธิ:".$ipcard["ptright"].", แพทย์ : ".$ipcard["doctor"].", โรค ".$ipcard["diag"]."<BR>";
$_SESSION["drugbill"] .= "<table width='650'>
<tr>
<td>#</td>
<td>รหัส</td>
<td>รายการ</td>
<td>สถานะ</td>
<td>วิธีใช้</td>
<td></td>
<td></td>
<td></td>
<td>จำนวน</td>
<td>ราคา</td>
<td>PART</td>
</tr>";
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>วันที่ <?=$phardep['date'];?></title>
    <link href="bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <script src="bootstrap/js/bootstrap.bundle.min.js"></script>
</head>
<body>
    <style>
        body{
            font-family: "TH SarabunPSK";
        }
        a,p,td,th{
            font-size: 18px;
        }
        .custom-color th,
        .custom-color > td{
            background-color: #13795b;
            color: white;
        }
    </style>
    <div class="container">

        <div>
            <h1 class="h1 mt-4">พิมพ์ใบสั่งยาย้อนหลัง วันที่ <?=$phardep['date'];?></h1>
        </div>

        <table class="table table-bordered table-striped-columns">
            <tr class="custom-color">
                <td colspan="6" class="text-center fw-bold">รายละเอียดผู้ป่วย</td>
            </tr>
            <tr>
                <td class="fw-bold text-end">AN : </td>
                <td><?=$ipcard['an'];?></td>
                <td class="fw-bold text-end">HN : </td>
                <td><?=$ipcard['hn'];?></td>
                <td class="fw-bold text-end">ชื่อ-สกุล : </td>
                <td><?=$ipcard['ptname'];?></td>
            </tr>
            <tr>
                <td class="fw-bold text-end">หอผู้ป่วย : </td>
                <td><?=$build[$bedcode];?></td>
                <td class="fw-bold text-end">สิทธิ : </td>
                <td><?=$ipcard['ptright'];?></td>
                <td class="fw-bold text-end">แพทย์ : </td>
                <td><?=$ipcard['doctor'];?></td>
            </tr>
        </table>

        <?php 
        $sql = "SELECT a.*,b.genname,b.salepri,b.part,c.* FROM ( 
            SELECT * FROM drugrx WHERE idno = '$id' 
        ) AS a LEFT JOIN druglst AS b ON a.drugcode = b.drugcode 
        LEFT JOIN drugslip AS c ON a.slcode = c.slcode";
        $q = $dbi->query($sql);
        if($q->num_rows > 0){
            ?>
            <table class="table table-striped-columns">
                <tr class="custom-color">
                    <th>#</th>
                    <th>รหัสยา</th>
                    <th>ชื่อสามัญ</th>
                    <th>ชื่อการค้า</th>
                    <th>จำนวน</th>
                    <th>slcode</th>
                    <th>ราคา</th>
                </tr>
            <?php
            $i = 1;
            while ($a = $q->fetch_assoc()) { 
                 
                $detail = '';
                if($a['detail1']){
                    $detail .= $a['detail1'];
                }
                if($a['detail2']){
                    $detail .= '<br>'.$a['detail2'];
                }
                if($a['detail3']){
                    $detail .= '<br>'.$a['detail3'];
                }
                if($a['detail4']){
                    $detail .= '<br>'.$a['detail4'];
                }

                if(!empty($detail)){
                    $detail = '<br>'.$detail;
                }
                ?>
                <tr>
                    <td><?=$i;?></td>
                    <td><?=$a['drugcode'];?></td>
                    <td><?=$a['genname'];?></td>
                    <td><?=$a['tradname'];?></td>
                    <td><?=$a['amount'];?></td>
                    <td><?=$a['slcode'].$detail;?></td>
                    <td><?=$a['price'];?></td>
                </tr>
                <?php 

$_SESSION["drugbill"] .= "<tr><td>".$i."</td>
<td><font face='Angsana New'>".$a['drugcode']."</td>
<td><font face='Angsana New'>".$a['tradname']."</td>
<td><font face='Angsana New'>$ipaccStatus</td>
<td><font face='Angsana New'>".$a['slcode']."</td>
<td></td>
<td></td>
<td></td>
<td align=\"right\"><font face='Angsana New'>".$a['amount']."&nbsp;</td>
<td align=\"right\"><font face='Angsana New'>".($a['salepri'] * $a['amount'])."&nbsp;</td>
<td align=\"center\"><font face='Angsana New'>".$a['part']."</td>
</tr>";

                $i++;
            }


$_SESSION["drugbill"] .= '</table>';
$_SESSION["drugbill"] .="ราคารวม  ".number_format($totalpay,strlen(strstr($totalpay,"."))-1, '.', ',')." บาท(เบิกไม่ได้ ".number_format($netpay,strlen(strstr($netpay,"."))-1, '.', ',')." บาท , เบิกได้ ".number_format($netfree,strlen(strstr($netfree,"."))-1, '.', ',')." บาท)<br><BR> ";

            ?>
            </table>
            <div class="mb-4">
                <a href="drugbill.php" target="_blank" class="btn btn-success">พิมพ์ใบสั่งยา</a>
                <a href="druglot_new.php" target="_blank" class="btn btn-success">พิมพ์สลากยาใหม่</a>
                <a href="druglot_qrcode.php" target="_blank" class="btn btn-success">พิมพ์สลากยา QR CODE</a>
                <a href="drugstk.php" target="_blank" class="btn btn-success">ติด OPD</a>
            </div>
            <?php
        }else{
            ?>
            <p class="fw-bold">ไม่พบข้อมูล</p>
            <?php
        }
        ?>
        
    </div>
</body>
</html>
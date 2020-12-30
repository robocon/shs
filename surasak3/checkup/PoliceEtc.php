<?php 
// include 'bootstrap.php';
error_reporting(E_ALL);
ini_set('display_errors', 1);

function dump($txt)
{
    echo "<pre>";
    var_dump($txt);
    echo "</pre>";
}

$mysqli = new mysqli("localhost","root","1234","smdb");
if ($mysqli->connect_errno)
{
  echo "Failed to connect to MySQL: " . $mysqli->connect_error;
  exit();
}

$camp = $_GET["camp"];
// $camp = "สอบตำรวจ63_02";
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>แบบรายงานการตรวจสุขภาพสอบเข้ารับราชการตำรวจ ภาค 5 </title>
</head>
<body>
<style type="text/css">
* {
	font-family: "TH Sarabun New","TH SarabunPSK";
	font-size: 18px;
}
.chk_table{
        border-collapse: collapse;
}
.chk_table th,
.chk_table td{
    padding: 3px;
    border: 1px solid black;
}
</style>
<?php 

$sql = "SELECT `date_checkup` AS `show_date`, `name` AS `company_name` FROM `chk_company_list` WHERE `code` = '$camp' ";
$q = $mysqli->query($sql);
$company = $q->fetch_assoc();
$company_name = $company['company_name'];
$show_date = $company['show_date'];

$sql = "SELECT a.*,b.`exam_no` 
FROM ( SELECT * FROM `out_result_chkup` WHERE `part` = '$camp' ) AS a 
LEFT JOIN ( SELECT * FROM `opcardchk` WHERE `part` = '$camp' ORDER BY `row` ASC ) AS b ON b.`HN` = a.`hn` 
ORDER BY b.`row` ASC";
$q = $mysqli->query($sql);
if($q->num_rows > 0 )
{
    
    ?>
    <h3 style="font-size: 22px; padding: 0; margin: 0; text-align:center;">แบบรายงานการตรวจสุขภาพผู้สมัครสอบเพื่อบรรจุเป็นเข้านักเรียนนายสิบตำรวจ ประจำปีงบประมาณ 2564 ( ผลการตรวจร่างกายทั่วไป )</h3>
    <h3 style="font-size: 22px; padding: 0; margin: 0; text-align:center;">โรงพยาบาลค่ายสุรศักดิ์มนตรี อ.เมือง จ.ลำปาง โทร 054-839-305-6 ต่อ 1135</h3>
    <h3 style="font-size: 22px; padding: 0; margin: 0; text-align:center;">หน่วยงาน : ศูนย์ฝึกอบรมตำรวจภูธร ภาค 5 วันที่ตรวจ 25-26 ธันวาคม 2563</h3>
    <table width="100%" class="chk_table">
        <tr style="text-align: center;">
            <th>ลำดับ</th>
            <th>HN</th>
            <th>ชื่อ-สกุล</th>
            <th>นน</th>
            <th>ส่วนสูง</th>
            <th>BMI</th>
            <th>BP</th>
            <td>T</td>
            <td>P</td>
            <td>R</td>
        </tr>
        <?php 
        $i = 1; 

        while ($outResult = $q->fetch_assoc())
        {
            $examNo = $outResult['exam_no'];

            $temp = $outResult['temp'];
            $rate = $outResult['rate'];
            $p = $outResult['p'];
            $weight = $outResult['weight'];
            $height = $outResult['height'];

            $bmi = 0;
            if (!empty($weight) && !empty($height)) {
                $h = ( $height / 100 );
                $bmi = ( $weight / ( $h * $h ) );
                $bmi = number_format($bmi, 2);
            }
            
            $bp1 = $bp = $outResult["bp1"]."/".$outResult["bp2"];
            $bp2 = false;
            if($outResult["bp3"] && $outResult["bp4"])
            {
                $bp = $outResult["bp3"]."/".$outResult["bp4"];
                // $bp2 = true;
            }
            ?>
            <tr>
                <td style="text-align: right;"><?=$i;?></td>
                <td><?=$outResult['hn'];?></td>
                <td><?=$outResult['ptname'];?></td>
                <td style="text-align: right;"><?=$weight;?></td>
                <td style="text-align: right;"><?=$height;?></td>
                <td style="text-align: right;"><?=$bmi;?></td>
                <td <?=($bp2===true) ? 'title="ความดันรอบแรก '.$bp1.'" bgcolor="yellow"' : '' ;?>  style="text-align: right;"><?=$bp;?></td>
                <td style="text-align: right;"><?=$temp;?></td>
                <td style="text-align: right;"><?=$p;?></td>
                <td style="text-align: right;"><?=$rate;?></td>
            </tr>
            <?php 
            $i++;
        }
        ?>
    </table>
    <?php
}

?>
</body>
</html>
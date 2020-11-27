<?php 
// include 'bootstrap.php';
error_reporting(1);
ini_set('display_errors', 1);
ini_set('max_execution_time', 0);

$mysqli = new mysqli("192.168.128.86","remoteuser","","smdb");

if ($mysqli -> connect_errno)
{
  echo "Failed to connect to MySQL: " . $mysqli->connect_error;
  exit();
}

// $camp = $_GET["camp"];
$camp = "สอบตำรวจ63_02";
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
    <h3>แบบรายงานการตรวจสุขภาพสอบเข้ารับราชการตำรวจ ภาค 5</h3>
    <h3>โรงพยาบาลค่ายสุรศักดิ์มนตรี อ.เมือง จ.ลำปาง โทร 054-839-305-6 ต่อ 1135</h3>
    <h3>หน่วยงาน : ศูนย์ฝึกอบรมตำรวจภูธร ภาค 5 วันที่ตรวจ 25-26 ธันวาคม 2563</h3>
    <h3>ผู้รับผิดชอบการตรวจทางห้องปฏิบัติการ พ.ท.สมยศ  แสงสุข (ทน 3226) ผู้รับผิดชอบผลการตรวจเอกซ์เรย์ พ.ท.วริทธิ์  พสุธาดล(ว.38228)</h3>
    <h3></h3>
    <table width="100%" class="chk_table">
        <tr>
            <th rowspan="2">ลำดับ</th>
            <th rowspan="2">HN</th>
            <th rowspan="2">ชื่อ-สกุล</th>

            <th colspan="12">CBC</th>
            <th colspan="10">UA</th>
            
            <th rowspan="2">Meth<br>Amphet</th>
            <th rowspan="2">Stool</th>
            <th rowspan="2">VDRL</th>
            <th rowspan="2">HIV</th>
            <th rowspan="2">X-RAY</th>
        </tr>
        <tr>
            <!-- CBC -->
            <th>WBC</th>
            <th>Neu</th>
            <th>Lymp</th>
            <th>Mo</th>
            <th>Eos</th>
            <th>Baso</th>
            <th>Hb</th>
            <th>Hct</th>
            <th>MCV</th>
            <th>MCH</th>
            <th>MCHC</th>
            <th>Plt</th>

            <!-- UA -->
            <th>Colour</th>
            <th>SpGr</th>
            <th>Ph</th>
            <th>Blood</th>
            <th>Prot</th>
            <th>Sugar</th>
            <th>Ketone</th>
            <th>Epi</th>
            <th>WBC</th>
            <th>RBC</th>
        </tr>
        <?php 
        $i = 1; 

        while ($outResult = $q->fetch_assoc())
        {

            $examNo = $outResult['exam_no'];
            ?>
            <tr>
                <td><?=$i;?></td>
                <td><?=$outResult['hn'];?></td>
                <td><?=$outResult['ptname'];?></td>

                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                
                <?php 
                $resultLab = "SELECT b.`autonumber`,b.`labcode`,b.`labname`,b.`result`,b.`normalrange`,b.`flag` 
                FROM (
                    SELECT MAX(`autonumber`) AS `LastAutonumber` FROM `resulthead` WHERE `labnumber` = '$examNo' AND `profilecode` = 'UA' GROUP BY `profilecode` 
                ) AS a 
                LEFT JOIN `resultdetail` AS b ON b.`autonumber` = a.`LastAutonumber` 
                WHERE ( b.`result` != 'DELETE' OR b.`result` != '*' ) 
                AND ( 
                    b.`labcode` = 'COLOR' || 
                    b.`labcode` = 'SPGR' || 
                    b.`labcode` = 'PH' || 
                    b.`labcode` = 'BLOODU' || 
                    b.`labcode` = 'PROU' || 
                    b.`labcode` = 'GLUU' || 
                    b.`labcode` = 'KETU' || 
                    b.`labcode` = 'EPIU' || 
                    b.`labcode` = 'WBCU' || 
                    b.`labcode` = 'RBCU' 
                ) 
                ORDER BY b.`seq` ASC";
                
                $qLab = $mysqli->query($resultLab);
                $labItems = array();
                while ($lab = $qLab->fetch_assoc()) { 

                    $key = $lab['labcode'];
                    $labItems[$key] = array( 
                        'autonumber' => $lab['autonumber'],
                        'labname' => $lab['labname'],
                        'flag' => $lab['flag'],
                        'result' => $lab['result'],
                        'normalrange' => $lab['normalrange']
                    );
                    
                }

                ?>
                <td>
                    <?php 
                    if ($labItems['COLOR'])
                    {
                        echo $labItems['COLOR']['result'];
                    }
                    ?>
                </td>
                <td>
                    <?php 
                    if ($labItems['SPGR'])
                    {
                        echo $labItems['SPGR']['result'];
                    }
                    ?> 
                    
                </td>
                <td>
                    <?php 
                    if ($labItems['PH'])
                    {
                        echo $labItems['PH']['result'];
                    }
                    ?>
                </td>
                <td>
                    <?php 
                    if ($labItems['BLOODU'])
                    {
                        if ($labItems['BLOODU']['result'] == 'Negative') {
                            echo "N";
                        }
                    }
                    ?>
                
                </td>
                <td>prot</td>
                <td>Sugar</td>
                <td>Ketone</td>
                <td>Epi</td>
                <td>WBC</td>
                <td>RBC</td>

                <td>Meth Amphet</td>
                <td>Stool</td>
                <td>VDRL</td>
                <td>HIV</td>
                <td>X-RAY</td>
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
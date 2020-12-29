<?php 
// include 'bootstrap.php';
error_reporting(1);
ini_set('display_errors', 1);
ini_set('max_execution_time', 0);

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
	font-size: 14px;
}
.chk_table{
        border-collapse: collapse;
}
.chk_table th,
.chk_table td{
    padding: 3px;
    border: 1px solid black;
}
.headerExtra{
    font-size: 18px; 
    padding: 0; 
    margin: 0; 
    text-align:center;
}
.setFont16 > th{
    font-size: 16px; 
}
.txtRight{
    text-align: right;
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
ORDER BY b.`row` ASC ";
$q = $mysqli->query($sql);
if($q->num_rows > 0 )
{ 
    ?>
    <h3 class="headerExtra">แบบรายงานการตรวจสุขภาพสอบเข้ารับราชการตำรวจ ภาค 5</h3>
    <h3 class="headerExtra">โรงพยาบาลค่ายสุรศักดิ์มนตรี อ.เมือง จ.ลำปาง โทร 054-839-305-6 ต่อ 1135</h3>
    <h3 class="headerExtra">หน่วยงาน : ศูนย์ฝึกอบรมตำรวจภูธร ภาค 5 วันที่ตรวจ 25-26 ธันวาคม 2563</h3>
    <h3 class="headerExtra">ผู้รับผิดชอบการตรวจทางห้องปฏิบัติการ พ.ท.สมยศ  แสงสุข (ทน.3226) ผู้รับผิดชอบผลการตรวจเอกซ์เรย์ พ.ท.วริทธิ์  พสุธาดล(ว.38228)</h3>
    <h3></h3>
    <table width="100%" class="chk_table">
        <thead>
            <tr>
                <th colspan="30" style="font-size: 18px;">N = negative , P = positive, NF = not found parasite ova , NR = non reactive , R = Reactive, Methamp = Methamphetamine</th>
            </tr>
            <tr class="setFont16">
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
            <tr style="color: green;">
                <th colspan="3" style="font-size: 16px;">ค่าปกติ</th>
                <th>5.0-10.0</th>
                <th>43-76</th>
                <th>17-48</th>
                <th>4-10</th>
                <th>0-5</th>
                <th>0-1</th>
                <th>12.5-16.4</th>
                <th>30-49</th>
                <th>80-97</th>
                <th>27.0-31.2</th>
                <th>31.8-35.4</th>
                <th>140-400</th>

                <th></th>
                <th>1.010-1.025</th>
                <th></th>
                <th>N</th>
                <th>N</th>
                <th>N</th>
                <th></th>
                <th>0-5</th>
                <th>0-5</th>
                <th>0-1</th>

                <th>N</th>
                <th>NF</th>
                <th>NR</th>
                <th>N</th>

                <th></th>
            </tr>
        </thead>
        <tbody>

        
        <?php 
        $i = 1; 

        while ($outResult = $q->fetch_assoc())
        {

            $examNo = $outResult['exam_no'];

            $stateCbC = "SELECT b.`autonumber`,b.`labcode`,b.`labname`,b.`result`,b.`normalrange`,b.`flag` 
                FROM (
                    SELECT MAX(`autonumber`) AS `LastAutonumber` FROM `resulthead` WHERE `labnumber` = '$examNo' AND `profilecode` = 'CBC' GROUP BY `profilecode` 
                ) AS a 
                LEFT JOIN `resultdetail` AS b ON b.`autonumber` = a.`LastAutonumber` 
                WHERE ( b.`result` != 'DELETE' OR b.`result` != '*' ) 
                AND ( 
                    b.`labcode` = 'WBC' || 
                    b.`labcode` = 'NEU' || 
                    b.`labcode` = 'LYMP' || 
                    b.`labcode` = 'MONO' || 
                    b.`labcode` = 'EOS' || 
                    b.`labcode` = 'BASO' || 
                    b.`labcode` = 'HB' || 
                    b.`labcode` = 'HCT' || 
                    b.`labcode` = 'MCV' || 
                    b.`labcode` = 'MCH' || 
                    b.`labcode` = 'MCHC' || 
                    b.`labcode` = 'PLTC' 
                ) 
                ORDER BY b.`seq` ASC";
                $qLab = $mysqli->query($stateCbC);
                $cbcItems = array();
                while ($lab = $qLab->fetch_assoc())
                { 
                    $key = $lab['labcode'];
                    $cbcItems[$key] = array( 
                        'autonumber' => $lab['autonumber'],
                        'labname' => $lab['labname'],
                        'flag' => $lab['flag'],
                        'result' => $lab['result'],
                        'normalrange' => $lab['normalrange']
                    );
                    
                }
            ?>
            <tr>
                <td><?=$i;?></td>
                <td><?=$outResult['hn'];?></td>
                <td><?=$outResult['ptname'];?></td>
                <td class="txtRight">
                    <?php 
                    if ($cbcItems['WBC'])
                    {
                        echo $cbcItems['WBC']['result'];
                    }
                    ?>
                </td>
                <td class="txtRight">
                    <?php 
                    if ($cbcItems['NEU'])
                    {
                        echo $cbcItems['NEU']['result'];
                    }
                    ?>
                </td>
                <td class="txtRight">
                    <?php 
                    if ($cbcItems['LYMP'])
                    {
                        echo $cbcItems['LYMP']['result'];
                    }
                    ?>
                </td>
                <td class="txtRight">
                    <?php 
                    if ($cbcItems['MONO'])
                    {
                        echo $cbcItems['MONO']['result'];
                    }
                    ?>
                </td>
                <td class="txtRight">
                    <?php 
                    if ($cbcItems['EOS'])
                    {
                        echo $cbcItems['EOS']['result'];
                    }
                    ?>
                </td>
                <td class="txtRight">
                    <?php 
                    if ($cbcItems['BASO'])
                    {
                        echo $cbcItems['BASO']['result'];
                    }
                    ?>
                </td>
                <td class="txtRight">
                    <?php 
                    if ($cbcItems['HB'])
                    {
                        echo $cbcItems['HB']['result'];
                    }
                    ?>
                </td>
                <td class="txtRight">
                    <?php 
                    if ($cbcItems['HCT'])
                    {
                        echo $cbcItems['HCT']['result'];
                    }
                    ?>
                </td>
                <td class="txtRight">
                    <?php 
                    if ($cbcItems['MCV'])
                    {
                        echo $cbcItems['MCV']['result'];
                    }
                    ?>
                </td>
                <td class="txtRight">
                    <?php 
                    if ($cbcItems['MCH'])
                    {
                        echo $cbcItems['MCH']['result'];
                    }
                    ?>
                </td>
                <td class="txtRight">
                    <?php 
                    if ($cbcItems['MCHC'])
                    {
                        echo $cbcItems['MCHC']['result'];
                    }
                    ?>
                </td>
                <td class="txtRight">
                    <?php 
                    if ($cbcItems['PLTC'])
                    {
                        echo $cbcItems['PLTC']['result'];
                    }
                    ?>
                </td>
                
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
                while ($lab = $qLab->fetch_assoc())
                { 
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
                <td class="txtRight">
                    <?php 
                    if ($labItems['SPGR'])
                    {
                        echo $labItems['SPGR']['result'];
                    }
                    ?> 
                    
                </td>
                <td class="txtRight">
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
                        if ($labItems['BLOODU']['result'] == 'Negative') 
                        {
                            echo "N";
                        }
                        elseif ($labItems['BLOODU']['result'] == 'Positive') 
                        {
                            echo "P";
                        }
                    }
                    ?>
                </td>
                <td>
                    <?php 
                    if ($labItems['PROU'])
                    {
                        if ($labItems['PROU']['result'] == 'Negative') 
                        {
                            echo "N";
                        }
                        elseif ($labItems['PROU']['result'] == 'Positive') 
                        {
                            echo "P";
                        }
                    }
                    ?>
                </td>
                <td>
                    <?php 
                    if ($labItems['GLUU'])
                    {
                        if ($labItems['GLUU']['result'] == 'Negative') 
                        {
                            echo "N";
                        }
                        elseif ($labItems['GLUU']['result'] == 'Positive') 
                        {
                            echo "P";
                        }
                    }
                    ?>
                </td>
                <td>
                    <?php 
                    if ($labItems['KETU'])
                    {
                        if ($labItems['KETU']['result'] == 'Negative') 
                        {
                            echo "N";
                        }
                        elseif ($labItems['KETU']['result'] == 'Positive') 
                        {
                            echo "P";
                        }
                    }
                    ?>
                </td>
                <td class="txtRight">
                    <?php 
                    if ($labItems['EPIU'])
                    {
                        echo $labItems['EPIU']['result'];
                    }
                    ?>
                </td>
                <td class="txtRight">
                    <?php 
                    if ($labItems['WBCU'])
                    {
                        echo $labItems['WBCU']['result'];
                    }
                    ?>
                </td>
                <td>
                    <?php 
                    if ($labItems['RBCU'])
                    {
                        if ($labItems['RBCU']['result'] == 'Negative') 
                        {
                            echo "N";
                        }
                        elseif ($labItems['RBCU']['result'] == 'Positive') 
                        {
                            echo "P";
                        }
                    }
                    ?>
                </td>
                <?php 
                $etcLabState = "SELECT b.`autonumber`,b.`labcode`,b.`labname`,b.`result`,b.`normalrange`,b.`flag` 
                FROM ( SELECT MAX(`autonumber`) AS `LastAutonumber` FROM `resulthead` WHERE `labnumber` = '$examNo' AND ( `profilecode` = 'STOOL' || `profilecode` = 'METAMP' || `profilecode` = 'HIV' || `profilecode` = 'VDRL' ) GROUP BY `profilecode` ) AS a 
                LEFT JOIN `resultdetail` AS b ON b.`autonumber` = a.`LastAutonumber` 
                WHERE ( b.`result` != 'DELETE' OR b.`result` != '*' ) 
                AND ( b.`labcode` = 'PARASI' || b.`labcode` = 'METAMP' || b.`labcode` = 'HIV' || b.`labcode` = 'VDRL' ) 
                ORDER BY b.`seq` ASC";
                $qLab = $mysqli->query($etcLabState);
                $etcLabItems = array();
                while ($lab = $qLab->fetch_assoc())
                { 
                    $key = $lab['labcode'];
                    $etcLabItems[$key] = array( 
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
                    if ($etcLabItems['METAMP'])
                    {
                        if ($etcLabItems['METAMP']['result'] == 'Negative') 
                        {
                            echo "N";
                        }
                        elseif ($labItems['METAMP']['result'] == 'Positive') 
                        {
                            echo "P";
                        }
                    }
                    ?>
                </td>
                <td>
                    <?php 
                    if ($etcLabItems['PARASI'])
                    {
                        if ($etcLabItems['PARASI']['result'] == 'Not found parasite') 
                        {
                            echo "NF";
                        }
                    }
                    ?>
                </td>
                <td>
                    <?php 
                    if ($etcLabItems['VDRL'])
                    {
                        if ($etcLabItems['VDRL']['result'] == 'Non Reactive') 
                        {
                            echo "NR";
                        }
                        elseif ($labItems['VDRL']['result'] == 'Reactive') 
                        {
                            echo "R";
                        }
                    }
                    ?>
                </td>
                <td>
                    <?php 
                    if ($etcLabItems['HIV'])
                    {
                        if ($etcLabItems['HIV']['result'] == 'COMPLETED') 
                        {
                            echo "N";
                        }
                    }
                    ?>
                </td>
                <td width="15%">
                    <?php 
                    if($outResult["cxr"] == "")
                    { 
                        echo "ปกติ"; 
                    }
                    else
                    { 
                        echo $outResult["cxr"];
                    }
                    ?>
                </td>
            </tr>
            <?php 
            $i++;
        }
        ?>
        </tbody>
    </table>
    <?php
}


?>


    


</body>
</html>
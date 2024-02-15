<?php 
require_once 'bootstrap.php';

$dbi = new mysqli(HOST,USER,PASS,DB);
$dbi->query("SET NAMES UTF8");
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ข้อมูล Refer, Observe และคำแนะนำก่อนผ่าตัด</title>
    <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
</head>
<body>
<style>
    *{
        font-family: "TH SarabunPSK";
        font-size: 18px; 
    }
</style>
    <div class="w3-container w3-center">
        <h4>ข้อมูล Refer, Observe และคำแนะนำก่อนผ่าตัด ตามวันที่</h4>
    </div>
    <div class="w3-container">
        <div class="w3-row">
            <div class="w3-col m4">&nbsp;</div>
            <div class="w3-col m4 w3-padding-small" style="border: 4px solid #009688;">
                <form action="opd_advice.php" method="post" >
                    <table width="100%">
                        <tr>
                            <td align="right">วันที่: </td>
                            <td>
                                <?php 
                                $input_day = empty($_REQUEST['days']) ? date('d') : $_REQUEST['days'] ;
                                $current_day = sprintf("%s", $input_day);

                                $input_months = empty($_REQUEST['months']) ? date('m') : $_REQUEST['months'] ;
                                $current_months = sprintf("%s", $input_months);

                                $year_range = range(2018, date('Y'));
                                $input_years = empty($_REQUEST['years']) ? date('Y') : $_REQUEST['years'] ;
                                $current_years = sprintf("%s", $input_years);

                                getDateList('days', $current_day);
                                ?>
                                เดือน: <?=getMonthList('months', $current_months);?>
                                ปี: <?=getYearList('years', false, $current_years, $year_range);?>
                            </td>
                        </tr>
                        <tr>
                            <td></td>
                            <td>
                                <button type="submit" class="w3-button w3-teal w3-round">ค้นหาข้อมูล</button>
                                <input type="hidden" name="page" value="search">
                            </td>
                        </tr>
                    </table>
                </form>
            </div>
        </div>
    </div>
    <?php 
    $page = sprintf("%s", $_POST['page']);
    if ($page === 'search') {

        $data = array(
            'form_a' => 'Refer',
            'form_b' => 'คำแนะนำผู้ป่วยถ่ายอุจจาระเหลว',
            'form_c' => 'คำแนะนำผู้ป่วยมีอาการปวดท้องแบบบิด',
            'form_d' => 'คำแนะนำผู้ป่วยมีไข้',
            'form_e' => 'คำแนะนำผู้ป่วยก่อนส่องตรวจลำไส้ใหญ่',
            'form_f' => 'คำแนะนำผู้ป่วยก่อนส่องตรวจกระเพาะอาหาร',
            'form_g' => 'คำแนะนำการปฏิบัติตัวก่อนผ่าตัด',
            'form_h' => 'Sleep Test'
        );

        $sql = "SELECT * FROM `opd_advice` WHERE `date` LIKE '$current_years-$current_months-$current_day%' ";
        $q_advice = $dbi->query($sql);
        if($q_advice->num_rows > 0){
        ?>
        <div>&nbsp;</div>
        <div class="w3-container">
            <table class="w3-table-all w3-hoverable">
                <thead>
                    <tr class="w3-teal">
                        <th>#</th>
                        <th>วันที่</th>
                        <th>HN</th>
                        <th>ชื่อ-สกุล</th>
                        <th>คำแนะนำ</th>
                        <th>เจ้าหน้าที่</th>
                        <th></th>
                    </tr>
                </thead>
                <?php 
                $i = 1;
                while ($a = $q_advice->fetch_assoc()) { 
                    if(!empty($a['document'])){
                        $doc_items = explode('|', $a['document']);
                    }
                    
                    ?>
                    <tr>
                        <td><?=$i;?></td>
                        <td><?=$a['date'];?></td>
                        <td><?=$a['hn'];?></td>
                        <td><?=$a['ptname'];?></td>
                        <td>
                            <?php 
                            foreach($doc_items AS $doc){
                                echo "- ".$data[$doc].'<br>';
                            }
                            ?>
                        </td>
                        <td><?=$a['officer'];?></td>
                        <td>
                            <a href="dt_paperLess.php?hn=<?=$a['hn'];?>" class="w3-btn w3-ripple w3-teal w3-round" target="_blank">E-OPD</a>
                        </td>
                    </tr>
                    <?php
                    $i++;
                }
                ?>
            </table>
        </div>
        <?php
        }else{
            ?>
            <div>&nbsp;</div>
            <div class="w3-container">
                <div class="w3-row">
                    <div class="w3-col m4">&nbsp;</div>
                    <div class="w3-col m4"><h3>ไม่พบข้อมูล</h3></div>
                    <div class="w3-col m4">&nbsp;</div>
                </div>
            </div>
            <?php
        }
    }
    
    ?>
    
</body>
</html>
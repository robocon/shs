<?php 
include 'bootstrap.php';
$dbi = new mysqli(HOST, USER, PASS, DB);
$dbi->query("SET NAMES UTF8");
include_once 'includes/JSON.php';
$json = new Services_JSON();

function check_in_a($name){ 
    global $ia;
    return in_array($name, $ia) ? '<img src="images/icons/OK.gif" title="'.$name.'">' : '' ;
}

function check_in_b($name){ 
    global $ib;
    return in_array($name, $ib) ? '<img src="images/icons/OK.gif" title="'.$name.'">' : '' ;
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ผลการบันทึก Fresh Traumatic Wound และ Acute Diarrhea</title>
</head>
<body>
    <style>
        *{
            font-family: "TH SarabunPSK";
            font-size: 18px;
        }
        h1{
            font-size: 32px;
        }
        h3{
            font-size: 28px;
            margin-bottom: 0;
        }
        .clearfix::after {
            content: "";
            clear: both;
            display: table;
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
    $date = sprintf("%s", $_POST['date']);
    $def_date = (empty($date)) ? date('Y-m-d') : $date ;
    ?>
    <fieldset>
        <legend>ค้นหาตามวันที่</legend>
        <form action="view_form_fresh_wound.php" method="post">
            <div>
                <h1>ผลการบันทึก Fresh Traumatic Wound และ Acute Diarrhea</h1>
            </div>
            <div>
                <label for="date">วันที่</label> <input type="text" name="date" id="date" value="<?=$def_date;?>">
            </div>
            <div>
                <button type="submit">แสดงข้อมูล</button>
                <input type="hidden" name="page" value="show">
            </div>
        </form>
    </fieldset>
    <?php 
    $page = sprintf("%s", $_POST['page']);
    if($page === 'show'){

        list($y,$m,$d) = explode('-', $date);
        
        $def_d = 'วันที่';
        if(empty($d)){
            $def_d = 'เดือน';
        }
        if(empty($d) && empty($m)){
            $def_d = 'ปี';
        }

        ?>
        <div>
            <h1><?=$def_d;?> <?=$d.' '.$def_fullm_th[$m].' '.($y);?></h1>
        </div>
        <div>
            <div>
                <h3>คัดกรองบาดแผลสด : Fresh Traumatic Wound</h3>
                <style>
                    .rotate90 p{ 
                        writing-mode: vertical-lr;
                    }
                    .rotate90{ 
                        vertical-align: top;
                    }
                    .b{ 
                        font-weight: bold;
                        background-color: #dfdfdf;
                    }
                </style>

                <?php 
                $sql = "SELECT a.*,CONCAT(b.`yot`,b.`name`,' ',b.`surname`) AS `ptname` 
                FROM 
                ( 
                    SELECT * FROM `er_ftw` WHERE `date` LIKE '$date%'
                ) AS a LEFT JOIN `opcard` AS b ON b.`hn` = a.`hn`";
                $qa = $dbi->query($sql);
                if($qa->num_rows>0){ 

                ?>
                <table class="chk_table">
                    <tr>
                        <th>#</th>
                        <th>HN</th>
                        <th >ชื่อ / หัวข้อ</th>
                        <th class="rotate90 b"><p>บาดแผลที่มีโอกาสติดเชื้อและควรใช้ยาปฏิชีวนะ</p></th>
                        <th class="rotate90"><p>1.แผลขอบไม่เรียบ เย็บแผลให้ขอบชนกันได้ไม่สนิท</p></th>
                        <th class="rotate90"><p>2.แผลลึกถึงกล้ามเนื้อ เอ็น หรือกระดูก</p></th>
                        <th class="rotate90"><p>3.แผลยาวกว่า 5 ซม.</p></th>
                        <th class="rotate90"><p>4.แผลจากการบดอัด</p></th>
                        <th class="rotate90"><p>5.ผู้ป่วยภูมิต้านทานต่ำ</p></th>
                        <th class="rotate90 b"><p>บาดแผลที่มีสิ่งปนเปื้อนและควรได้ยาปฏิชีวนะ</p></th>
                        <th class="rotate90"><p>1.แผลสัตว์กัด/คนกัด</p></th>
                        <th class="rotate90"><p>2.มีเนื้อตายบริเวณกว้าง</p></th>
                        <th class="rotate90"><p>3.มีสิ่งสกปรกติดอยู่ในแผลล้างไม่ออก</p></th>
                        <th class="rotate90"><p>4.ปนเปื้อนสิ่งที่มีแบคทีเรียมาก</p></th>
                        <th class="rotate90 b"><p>ไม่เข้าเกณฑ์การได้รับยาปฏิชีวนะ</p></th>
                        <th>ผู้บันทึก</th>
                    </tr>
                    <?php 
                    $i = 1;
                    while ($a = $qa->fetch_assoc()) { 
                        $ia = $json->decode($a['ftwa']);
                        $ib = $json->decode($a['ftwb']);

                        $n = $a['ftwn'];
                        ?>
                        <tr>
                            <td><?=$i;?></td>
                            <td><?=$a['hn'];?></td>
                            <td><a href="er_form_fresh_wound.php?view=print&datehn=<?=$a['datehn'];?>" target="_blank"><?=$a['ptname'];?></a></td>
                            <td></td>
                            <td align="center"><?=check_in_a('a1');?></td>
                            <td align="center"><?=check_in_a('a2');?></td>
                            <td align="center"><?=check_in_a('a3');?></td>
                            <td align="center"><?=check_in_a('a4');?></td>
                            <td align="center"><?=check_in_a('a5');?></td>
                            <td></td>
                            <td align="center"><?=check_in_b('b1');?></td>
                            <td align="center"><?=check_in_b('b2');?></td>
                            <td align="center"><?=check_in_b('b3');?></td>
                            <td align="center"><?=check_in_b('b4');?></td>
                            <td align="center"><?=(empty($n)) ? '' : '<img src="images/icons/OK.gif">' ;?></td>
                            <td><?=$a['owner'];?></td>
                        </tr>
                        <?php
                        $i++;
                    }
                    ?>
                </table>
                <?php 
                }else{
                    ?>
                    <p>ไม่พบข้อมูล</p>
                    <?php
                }
                ?>
            </div>
            
            <div style="">
                <h3>คัดกรองท้องร่วงเฉียบพลัน : Acute Diarrhea</h3>
                <?php 
                $sql = "SELECT a.*,CONCAT(b.`yot`,b.`name`,' ',b.`surname`) AS `ptname` 
                FROM 
                ( 
                    SELECT * FROM `er_acute` WHERE `date` LIKE '$date%'
                ) AS a LEFT JOIN `opcard` AS b ON b.`hn` = a.`hn`";
                $qb = $dbi->query($sql);
                if($qb->num_rows>0){
                    ?>
                    <table class="chk_table">
                        <tr>
                            <th>#</th>
                            <th>HN</th>
                            <th>ชื่อ / หัวข้อ</th>
                            <th class="rotate90"><p>1.อุจจาระเป็นมูกเลือด</p></th>
                            <th class="rotate90"><p>2.ทารกอายุ&le;3เดือน ถ่ายอุจจาระเป็นมูกเลือด</p></th>
                            <th class="rotate90"><p>3.ผู้ป่วยภูมิคุ้มกันบกพร่อง หรือผู้สูงอายุ(&ge;70ปี)</p></th>
                            <th class="rotate90"><p>4.ผู้ป่วยสงสัยติดเชื้อในกระแสเลือด หรืออาการรุนแรง</p></th>
                            <th class="rotate90"><p>5.ถ่ายเป็นน้ำ ร่วมกับผลเพราะเชื้อเป็นเชื้อ Vibrio cholerae </p></th>
                            <th class="rotate90"><p>6.กำลังได้รับ หรือเคยได้รับ broad spectrum antibiotic</p></th>
                            <th class="rotate90"><p>7.ผลเพาะเชื้อจากอุจจาระบเชื้อ Entamoeba histolytica</p></th>
                            <th class="rotate90 b"><p>ไม่เข้าเกณฑ์การได้รับยาปฏิชีวนะ</p></th>
                            <th>ผู้บันทึก</th>
                        </tr>
                    <?php 
                    $ii = 1;
                    while ($b = $qb->fetch_assoc()) {
                        ?>
                        <tr>
                            <td><?=$ii;?></td>
                            <td><?=$b['hn'];?></td>
                            <td><a href="er_form_acute_diarrhea.php?view=print&datehn=<?=$b['datehn'];?>" target="_blank"><?=$b['ptname'];?></a></td>
                            <td align="center"><?=(empty($b['acu1'])) ? '' : '<img src="images/icons/OK.gif">' ;?></td>
                            <td align="center"><?=(empty($b['acu2'])) ? '' : '<img src="images/icons/OK.gif">' ;?></td>
                            <td align="center"><?=(empty($b['acu3'])) ? '' : '<img src="images/icons/OK.gif">' ;?></td>
                            <td align="center"><?=(empty($b['acu4'])) ? '' : '<img src="images/icons/OK.gif">' ;?></td>
                            <td align="center"><?=(empty($b['acu5'])) ? '' : '<img src="images/icons/OK.gif">' ;?></td>
                            <td align="center"><?=(empty($b['acu6'])) ? '' : '<img src="images/icons/OK.gif">' ;?></td>
                            <td align="center"><?=(empty($b['acu7'])) ? '' : '<img src="images/icons/OK.gif">' ;?></td>
                            <td align="center"><?=(empty($b['acu_n'])) ? '' : '<img src="images/icons/OK.gif">' ;?></td>
                            <td><?=$b['owner'];?></td>
                        </tr>
                        <?php
                        $ii++;
                    }
                    ?>
                    </table>
                    <?php
                }else{
                    ?>
                    <p>ไม่พบข้อมูล</p>
                    <?php
                }
                ?>
            </div>
        </div>
        <?php
    }
    ?>
</body>
</html>
<?php 
include 'bootstrap.php';

$db = Mysql::load();



$action = input_post('action');
if ($action == 'print') {

    $age = input_post('age');
    $name = input_post('name');
    $hn = input_post('hn');
    $date = input_post('date');
    $ids = $_POST['id'];

    ?>
    <style>
        *{
            font-family: 'TH Sarabun New','TH SarabunPSK';
            font-size: 14pt;
        }
        .chk_table{
            border-collapse: collapse;
        }

        .chk_table th, .chk_table td{
            border: 1px solid black;
            font-size: 14pt;
            padding: 3px;
        }
        @media print{
            .no_print{
                display: none;
            }
        }
    </style>
    <div class="no_print">
        <a href="ckd_drugprofile.php">กลับไปหน้า Drugprofile</a>
    </div>
    <table width="100%">
        <tr>
            <td colspan="2" style="text-align: center;"><b style="font-size: 32px;">Medication Record</b></td>
        </tr>
        <tr>
            <td><b>ชื่อ-สกุล</b> : <?=urldecode($name);?> <b>อายุ</b> : <?=$age;?>ปี</td>
            <td><b>HN</b> : <?=$hn;?></td>
        </tr>
    </table>
    <table class="chk_table" width="100%">
        <tr>
            <td colspan="2">วัน/เดือน/ปี</td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
        </tr>
        <?php  
        $i = 1; 
        $countItem = 0;
        foreach ($ids as $key => $id) {
            
            $sql = "SELECT `tradname` FROM `ddrugrx` WHERE `row_id` = '$id' ";
            $db->select($sql);
            $drug = $db->get_item();

            ?>
            <tr>
                <td width="10%" style="text-align: center;"><?=$i;?></td>
                <td width="30%"><?=$drug['tradname'];?></td>
                <td width="10%"></td>
                <td width="10%"></td>
                <td width="10%"></td>
                <td width="10%"></td>
                <td width="10%"></td>
                <td width="10%"></td>
            </tr>
            <?php
            $i++;
            $countItem++;
        }

        $defaultLine = 22;
        for ($i=0; $i < ($defaultLine - $countItem); $i++) { 
            ?>
            <tr>
                <td>&nbsp;</td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
            </tr>
            <?php
        }
        ?>
        <tr>
            <td colspan="2"><b>แพทย์</b></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
        </tr>
        <tr>
            <td colspan="2"><b>พยาบาล</b></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
        </tr>
    </table>
    <table width="100%">
        <tr>
            <td><b>หมายเหตุ</b></td>
            <td>1. ถ้ารายการยา วิธีใช้และขนาดยาเท่าเดิม ให้ใส่ /</td>
        </tr>
        <tr>
            <td></td>
            <td>2. ถ้ายกเลิกรายการยา ให้ใส่ -</td>
        </tr>
        <tr>
            <td></td>
            <td>3. ถ้ารายการยามีการเปลี่ยนแปลง วิธีใช้ ขนาดของยา ให้ระบุวิธีการใช้และขสาดยาลงไปใหม่</td>
        </tr>
    </table>
    <script>
        window.onload = function(){
			window.print();
		};
    </script>
    <?php
    exit;

}
?>
<style>
	*{
		font-family: 'TH Sarabun New','TH SarabunPSK';
		font-size: 18px;
	}
    .chk_table{
        border-collapse: collapse;
    }

    .chk_table th,.chk_table td{
        border: 1px solid black;
        font-size: 16pt;
        padding: 3px;
    }
</style>
<div>
    <a href="../nindex.htm">&lt;&lt;&nbsp;กลับหน้าหลัก ร.พ.</a>
</div>
<div>
    <h3>CKD Drug profile</h3>
    <div>
        <fieldset>
            <legend>ค้นหาตาม HN</legend>
            <form action="ckd_drugprofile.php" method="post">
                
                <?php
                if ( preg_match('/^HD/', $_SESSION['sIdname']) ) {
                    
                    $drName = $_SESSION['sOfficer'];
                    ?><input type="hidden" name="drName" value="<?=$drName;?>"><?php

                }else{

                    $sql = "SELECT `name` FROM `inputm` WHERE `name` LIKE 'HD%' ";
                    $db->select($sql);
                    $drLists = $db->get_items();
                    ?>
                    <div>
                        เลือกแพทย์: <select name="drName" id="">
                            <?php
                            foreach ($drLists as $key => $dr) {
                                ?>
                                <option value="<?=$dr['name'];?>"><?=$dr['name'];?></option>
                                <?php
                            }
                            ?>
                        </select>
                    </div>
                    <?php
                }
                ?>
                <div>
                    HN: <input type="text" name="hn" id="">
                </div>
                <div style="margin-top: 8px;">
                    <button type="submit">ค้นหา</button>
                    <input type="hidden" name="page" value="search">
                </div>
            </form>
        </fieldset>
    </div>
</div>
<?php 
$page = input('page');
if( $page == 'search' ){

    $hn = input_post('hn');
    $drName = input_post('drName');
    $nowTH = (date('Y') + 543).date('-m-d');

    // หาวันสุดท้ายของเดือน
    $lastOfMonth = date('t', strtotime(date('m').'-01'));
    $currentMonth = date('m');
    $currentYear = date('Y');

    // mktime format : H i s m d Y
    // 6เดือนล่าสุด
    $last6MonthMK = mktime(0,0,0,$currentMonth-6,$lastOfMonth,$currentYear);
    $last6Month = date('Y-m-d', $last6MonthMK);
    $last6MonthTH = (date('Y', $last6MonthMK)+543).date('-m-d', $last6MonthMK);

    $sql = "SELECT a.`row_id`,a.`date`,a.`ptname`,a.`hn`,a.`diag`,a.`doctor`,a.`ptright`,
    TIMESTAMPDIFF(YEAR, toEn(SUBSTRING(`dbirth`, 1, 10)), toEn(SUBSTRING(`date`, 1, 10)) ) AS `age` 
    FROM `dphardep` AS a 
    LEFT JOIN `opcard` AS b ON b.`hn` = a.`hn` 
    WHERE a.`hn` = '$hn' 
    AND a.`doctor` = '$drName' 
    AND ( a.`date` > '$last6MonthTH 00:00:00' AND a.`date` <= '$nowTH 23:59:59' ) 
    ORDER BY a.`date` DESC ";
    
    $db->select($sql);
    if ( $db->get_rows() > 0 ) {
        ?>
        <div>
            <h3>รายการสั่งยา</h3>
        </div>
        <table class="chk_table">
            <tr>
                <th>#</th>
                <th>วันที่สั่งยา</th>
                <th>ชื่อ-สกุล ผู้ป่วย</th>
                <th>Diag</th>
                <th>สิทธิ</th>
                <th>#</th>
            </tr>
            <?php 
            $items = $db->get_items();
            $i = 1;
            foreach ($items as $key => $list) { 

                $age = $list['age'];
                $name = urlencode($list['ptname']);
                $date = urlencode(substr($list['date'], 0, 10));
                ?>
                <tr>
                    <td><?=$i;?></td>
                    <td><?=$list['date'];?></td>
                    <td><?=$list['ptname'];?></td>
                    <td><?=$list['diag'];?></td>
                    <td><?=$list['ptright'];?></td>
                    <td><a href="ckd_drugprofile.php?page=showDrug&id=<?=$list['row_id'];?>&age=<?=$age;?>&name=<?=$name;?>&hn=<?=$hn;?>&date=<?=$date;?>">แสดงรายการยา</a></td>
                </tr>
                <?php 
                $i++;
            }
            ?>
        </table>
        <?php
    }else{
        ?><p>ไม่พบข้อมูล</p><?php
    }
    
}elseif ( $page == 'showDrug' ) {

    $id = input_get('id');
    $age = input_get('age');
    $name = input_get('name');
    $hn = input_get('hn');
    $date = input_get('date');

    $sql = "SELECT * FROM `ddrugrx` WHERE `idno` = '$id' ";
    $db->select($sql);
    if ( $db->get_rows() > 0 ) {
        $items = $db->get_items();
        ?>
        <div>
            <h3>รายการยา</h3>
        </div>
        <div>
            <p><b>ชื่อสกุล</b> : <?=urldecode($name);?> <b>อายุ</b> : <?=$age;?>ปี <b>HN</b> : <?=$hn;?></p>
        </div>
        <form action="ckd_drugprofile.php" method="post">
            <table class="chk_table">
                <tr>
                    <th>เลือกยา</th>
                    <th>วันที่สั่งยา</th>
                    <th>รหัสยา</th>
                    <th>Tradname</th>
                </tr>
                <?php 
                foreach ($items as $key => $item) {
                    ?>
                    <tr>
                        <td style="text-align: center;">
                            <input type="checkbox" name="id[]" id="" value="<?=$item['row_id'];?>">
                        </td>
                        <td><?=$item['date'];?></td>
                        <td><?=$item['drugcode'];?></td>
                        <td><?=$item['tradname'];?></td>
                    </tr>
                    <?php
                }
                ?>
                
            </table>
            <div style="margin-top: 8px;">
                <button type="submit">พิมพ์</button>
                <input type="hidden" name="age" value="<?=$age;?>">
                <input type="hidden" name="name" value="<?=$name;?>">
                <input type="hidden" name="hn" value="<?=$hn;?>">
                <input type="hidden" name="date" value="<?=$date;?>">
                <input type="hidden" name="action" value="print">

            </div>
        </form>
        <?php
        
    }else{
        ?>ไม่พบข้อมูล<?php
    }

}
<?php 
include 'bootstrap.php';

$db = Mysql::load();

?>
<link type="text/css" href="epoch_styles.css" rel="stylesheet" />
<script type="text/javascript" src="epoch_classes.js"></script>
<style>
@media print{
    form{
        display: none;
    }
}
*{
    font-family:"TH Sarabun New","TH SarabunPSK";
    font-size: 12pt;
}
.chk_table{
    border-collapse: collapse;
}
.chk_table th,
.chk_table td{
    border: 1px solid black;
    padding: 1px;
}
h3{
    margin: 0;
}
</style>
<form action="hsri_lab.php" method="post">
    <fieldset>
        <legend>ค้นหารายการทางห้องปฏิบัติการ</legend>
        <div>
            HN : <input type="text" name="hn" id="">
        </div>
        <div>
            เลือกวันที่ ตั้งแต่วันที่ <input type="text" name="dateStart" id="dateStart"> ถึงวันที่ <input type="text" name="dateEnd" id="dateEnd">
        </div>
        <div>
            <button type="submit">แสดงข้อมูล</button>
            <input type="hidden" name="action" value="show">
        </div>
    </fieldset>
</form>
<script type="text/javascript">
    var popup1,popup2;
    window.onload = function() {
        popup1 = new Epoch('popup1','popup',document.getElementById('dateStart'),false);
        popup2 = new Epoch('popup2','popup',document.getElementById('dateEnd'),false);
    };
</script>
<?php
$action = input_post('action');
if ($action == 'show') {

    $hn = input_post('hn');
    $dateStart = input_post('dateStart');
    $dateEnd = input_post('dateEnd');

    $sql = "SELECT `orderdate`,`labnumber`,`patientname`,`clinicalinfo`,`clinicianname` 
    FROM `orderhead` 
    WHERE `orderdate` >= '$dateStart 00:00:00' AND `orderdate` <= '$dateEnd 23:59:59' 
    AND `patienttype` = 'OPD' 
    AND `hn` = '$hn' 
    ORDER BY `orderdate` DESC";
    $db->select($sql);

    if( $db->get_rows() == 0 ){
        echo "ไม่พบข้อมูล กรุณาตรวจสอบ HN, วันที่เริ่มต้น และวันที่สิ้นสุด ในการดึงข้อมูล";
        exit;
    }

    $items = $db->get_items();
    $lab_i = 0;
    foreach ($items as $key => $item) {

        $labnumber = $item['labnumber'];
        $orderdate = $item['orderdate'];
        $patientname = $item['patientname'];
        $clinicalinfo = $item['clinicalinfo'];
        $clinicianname = $item['clinicianname'];
        
        $res_sql = "SELECT c.* 
        FROM  `resulthead` AS b 
        LEFT JOIN `resultdetail` AS c ON c.`autonumber` = b.`autonumber` 
        WHERE b.`labnumber` = '$labnumber' 
        AND ( c.`result` != '..' AND c.`result` <> '' )";
        $db->select($res_sql);
        $labRows = $db->get_rows();

        if ($labRows > 0) {
            
            $lab_items = $db->get_items();

            ?>
            <h3><b>ORDER DATE</b> : <?=$orderdate;?> <b>LABNUMBER</b> : <?=$labnumber;?> <b>HN</b> : <?=$hn;?> <b>NAME</b> : <?=$patientname;?> </h3>
            <h3><b>TEST</b> : <?=$clinicalinfo;?> DOCTOR : <?=$clinicianname;?></h3>
            <?php

            ?>
            <table class="chk_table">
                <thead>
                    <tr style="background-color: #a5d6f3;">
                        <th>Test</th>
                        <th>Result</th>
                        <th>Unit</th>
                        <th>Reference Range</th>
                    </tr>
                </thead>
                <tbody>
                <?php 
                $i=0;
                foreach ($lab_items as $key => $value) { 

                    $flag = $value['flag'];
                    $txt_flag = '';
                    if( $flag != 'N' ){
                        $txt_flag = "[$flag]";
                    }
                    
                    $style = '';
                    if($i%2 == 0){
                        $style = 'style="background-color: #dddddd;"';
                    }
                    ?>
                    <tr <?=$style;?>>
                        <td><?=$value['labname'];?></td>
                        <td><?=$value['result'];?><b style="color: red;"><?=$txt_flag;?></b></td>
                        <td><?=$value['unit'];?></td>
                        <td><?=$value['normalrange'];?></td>
                    </tr>
                    <?php 
                    $i++;
                }
                ?>
                </tbody>
            </table>
            <?php
            ++$lab_i;

            if ($lab_i > 0) {
                ?>
                <div style='page-break-after: always'></div>
                <?php
            }

        }

        
    }


}
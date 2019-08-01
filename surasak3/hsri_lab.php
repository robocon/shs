<?php 
include 'bootstrap.php';

$db = Mysql::load($shs_configs);

// $db->exec("SET NAMES TIS620");


?>
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
</style>
<form action="hsri_lab.php" method="post">
    <div>
        HN : <input type="text" name="hn" id="">
    </div>
    <div>
        <button type="submit">show</button>
        <input type="hidden" name="action" value="show">
    </div>
</form>

<?php
$action = input_post('action');
if ($action == 'show') {
    $hn = input_post('hn');

    $sql = "SELECT `orderdate`,`labnumber`,`patientname` 
    FROM `orderhead` 
    WHERE `orderdate` >= '2018-08-01 00:00:00' AND `orderdate` <= '2019-07-31 23:59:59' 
    AND `patienttype` = 'OPD' 
    AND `hn` = '$hn' ";
    $db->select($sql);
    $items = $db->get_items();

    $lab_i = 0;
    foreach ($items as $key => $item) {

        $labnumber = $item['labnumber'];
        $orderdate = $item['orderdate'];
        $patientname = $item['patientname'];

        ?>
        <h3>ORDER DATE:<?=$orderdate;?> HN:<?=$hn;?> NAME:<?=$patientname;?> LABNUMBER:<?=$labnumber;?></h3>
        <?php
        
        $res_sql = "SELECT c.* 
        FROM  `resulthead` AS b 
        LEFT JOIN `resultdetail` AS c ON c.`autonumber` = b.`autonumber` 
        WHERE b.`labnumber` = '$labnumber'";
        $db->select($res_sql);
        $lab_items = $db->get_items();

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
                    <td><?=$value['result'].$txt_flag;?></td>
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
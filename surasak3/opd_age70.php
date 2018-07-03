<?php
include 'bootstrap.php';
$db = Mysql::load();
?>

<div>
    <a href="../nindex.htm">˹����ѡ �.�.</a>
</div>

<style>
/* ���ҧ */
body, button{
    font-family: TH SarabunPSK, TH Sarabun NEW;
    font-size: 16pt;
}
.chk_table{
    border-collapse: collapse;
}

.chk_table, th, td{
    border: 1px solid black;
    font-size: 16pt;
}

.chk_table th,
.chk_table td{
    padding: 3px;
}
</style>
<?php
$def_month = ( date('Y') + 543 ).date('-m');
$month_select = input_post('month_selected', $def_month);
?>
<h3>���������ͤ�¢ͧ����٧����70�բ���</h3>
<form action="opd_age70.php" method="post">
    <div>
        ���͡��͹ <input type="text" name="month_selected" value="<?=$month_select;?>">
        <br>
        <span style="color: red;"><u><b>�ٻẺ ��-��͹ �� 2561-02</b></u></span>
    </div>
    <div>
        <button type="submit">�ʴ���</button>
        <input type="hidden" name="action" value="show">
    </div>
</form>

<?php
$action = input_post('action');
if ( $action == 'show' ) {

    $month_selected = input_post('month_selected');
    
    $sql = "SELECT `row_id`,SUBSTRING(`thidate`, 1, 10) AS `date`,`thdatehn`,`hn`,`ptname`,`age`,`ptright`,`time1`,`time2`  
    FROM `opday` 
    WHERE `thidate` LIKE '$month_selected%' 
    AND SUBSTRING(`age`, 1, 2) >= 70 ";

    $db->select($sql);
    $items = $db->get_items();

    ?>

    <table class="chk_table">
        <tr>
            <th>�ӴѺ</th>
            <th>�ѹ���</th>
            <th>HN</th>
            <th>����-ʡ��</th>
            <th>����</th>
            <th>��������<br>��蹺ѵ÷���¹</th>
            <th>��������<br>�ѡ����ѵ�</th>
        </tr>

    <?php 

    $i = 1;
    foreach ($items as $key => $item) {

        $thdatehn = $item['thdatehn'];

        $time1 = $item['time1'];
        $time2 = $item['time2'];

        $regis_time = '-';
        if ( !empty($time1) && !empty($time2) ) {
            $time_diff = strtotime($time2) - strtotime($time1);
            $regis_time = gmdate('H:i:s', $time_diff);
        }

        $opd_time = '-';
        if ( $regis_time != '-' ) { 

            $sql = "SELECT SUBSTRING(`thidate`, 1, 10) AS `date`,SUBSTRING(`thidate`, 11, 8) AS `opd_time`  
            FROM `opd` 
            WHERE `thdatehn` = '$thdatehn'";
            $db->select($sql);
            $opd = $db->get_item();

            if( !empty($opd) ){
                $time3 = $opd['opd_time'];

                // ������� checkout �ͧ����¹�Թ���Ңͧ�ѡ����ѵ�
                // ��������� checkin ᷹
                if( $time2 > $time3 ){
                    $time2 = $time1;
                }

                $opd_diff = strtotime($time3) - strtotime($time2);
                $opd_time = gmdate('H:i:s', $opd_diff);
            }
        }
        
        ?>
        <tr>
            <td><?=$i;?></td>
            <td><?=$item['date'];?></td>
            <td><?=$item['hn'];?></td>
            <td><?=$item['ptname'];?></td>
            <td><?=$item['age'];?></td>
            <td align="center"><?=$regis_time;?></td>
            <td align="center"><?=$opd_time;?></td>
        </tr>
        <?php 
        $i++;
    }
    ?>
    </table>
    <div style="font-size: 14pt;">
        <p style="margin: 0; padding: 0;"><b>�������� ��蹺ѵ÷���¹</b> : �Ѻ���Ҩҡ���ŧ����¹ -> ��ͧ�鹺ѵ� -> ��Ѻ�͡�ҷ������������¹</p>
        <p style="margin: 0; padding: 0;"><b>�������� �ѡ����ѵ�</b> : �Ѻ���Ҩҡ��� Checkout �����ͧ�鹺ѵ� �Ҩ��֧��úѹ�֡�����ŷ��ѡ����ѵ�</p>
    </div>
    <?php
}

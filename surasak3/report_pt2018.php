<?php

include 'bootstrap.php';

function sign(){
    ?>
    <table width="100%" border="0" cellspacing="0" cellpadding="2">
        <tr>
            <td width="15%" align="right"><strong>���ѹ�֡</strong></td>
            <td width="32%" valign="bottom"><div style="width:150px;"><u>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</u></div></td>
            <td width="18%" align="right"><strong>��Ǩ�١��ͧ</strong></td>
            <td width="35%" align="right">&nbsp;</td>
        </tr>
        <tr>
            <td>&nbsp;</td>
            <td valign="bottom"><div style="width:150px;"><u>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</u></div></td>
            <td align="right">�.�.</td>
            <td>&nbsp;</td>
        </tr>
        <tr>
            <td>&nbsp;</td>
            <td>&nbsp;</td>
            <td>&nbsp;</td>
            <td align="left"><div style="margin-left:10px;">(˷���ѵ��&nbsp;&nbsp;&nbsp;&nbsp;��Ūԧ���)</div></td>
        </tr>
        <tr>
            <td>&nbsp;</td>
            <td>&nbsp;</td>
            <td>&nbsp;</td>
            <td align="left"><div style="margin-left:25px;">ᾷ��Ἱ��</div></td>
        </tr>
    </table>
    <?php
}

function header_sign($name){
    global $day_start,$month_start,$year_start,$day_end,$month_end,$year_end,$def_fullm_th,$time_selected;

    $txt_month = '��͹ '.$def_fullm_th[$month_start];
    if($month_start != $month_end){
        $txt_month = '��͹ '.$def_fullm_th[$month_start].' �֧ '.$def_fullm_th[$month_end];
    }

    $txt_time = '';
    if( $time_selected == 2 ){
        $txt_time = '(�͡�����Ҫ���)';
    }

    ?>
    <p align="center"><b>��ª��ͼ�����Ѻ��ԡ�ùǴἹ��<?=$txt_time;?></b></p>
    <p><b>���;�ѡ�ҹ�Ǵ : </b><?=$name;?></p>
    <p><b>��ǧ���������ҧ�ѹ��� : </b><?=$day_start.' '.$def_fullm_th[$month_start].' '.$year_start;?> �֧ <?=$day_end.' '.$def_fullm_th[$month_end].' '.$year_end;?></p>
    <?php
}

?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <style>
            *{
                font-family: TH SarabunPSK;
                font-size: 22px;
            }
            p{
                margin: 0;
            }
            /* ���ҧ */
            .chk_table{
                border-collapse: collapse;
                width: 100%;
            }

            .chk_table th,
            .chk_table td{
                border: 1px solid black;
                padding: 3px;
            }
            @media print { 
                .no-print { display: none; } 
            } 
        </style>
    </head>
<body>
<form action="report_pt2018.php" method="post" class="no-print">
    <h3>��§ҹ�ǴἹ�µ����ǧ����</h3>
    <div>
        ������ѹ��� 
        <?php 
        $day_start = input('day_start', date('d'));
        getDateList('day_start', $day_start);
        ?>

        ��͹       
        <?php
        $month_start = input('month_start', date('m'));
        getMonthList('month_start', $month_start, 'txt');
        ?>

        �� 
        <?php 
        $year_start = input('year_start', date('Y'));
        $dates = range(2004, date('Y') );
        getYearList('year_start', true, $year_start, $dates, 'txt');
        ?>
    </div>

    <div>
        �֧�ѹ��� 
        <?php 
        $day_end = input('day_end', date('d'));
        getDateList('day_end', $day_end);
        ?>

        ��͹       
        <?php
        $month_end = input('month_end', date('m'));
        getMonthList('month_end', $month_end, 'txt');
        ?>

        �� 
        <?php 
        $year_end = input('year_end', date('Y'));
        $dates = range(2004, date('Y') );
        getYearList('year_end', true, $year_end, $dates, 'txt');
        ?>
    </div>
    <div>
        <?php
        $type_list = array( 2 => '�Ǵ�ѡ��(250)', '�Ǵ�ѡ�ҹ͡����(250+50)');
        $type_select = input('print_type');
        ?>
        �кء���ʴ���
        <select name="print_type" id="">
            <?php
            foreach ($type_list as $key => $item) {
                $select = ( $key == $type_select ) ? 'selected="selected"' : '' ;
                ?>
                <option value="<?=$key;?>" <?=$select;?> ><?=$item;?></option>
                <?php
            }
            ?>
        </select>
    </div>
    <!--
    <div> 
        <?php 
        $time_list = array( 1 => '������Ҫ���', '�͡�����Ҫ���');
        $time_select = input('time_selected');
        ?>
        ���͡��ǧ����
        <select name="time_selected" id="">
            
            <?php
            foreach ($time_list as $key => $item) {
                $select = ( $key == $time_select ) ? 'selected="selected"' : '' ;
                ?>
                <option value="<?=$key;?>" <?=$select;?> ><?=$item;?></option>
                <?php
            }
            ?>
        </select>  
    </div>
    -->
    <div>
        <input type="submit" value="���Ң�����" name="B1"  class="txt" />
        <input type="hidden" name="action" value="show">
    </div>
</form>
<?php

$action = input_post('action');
if ( $action == 'show' ) {
    
    $print_type = input_post('print_type');
    $time_selected = input_post('time_selected');

    $day_start = input_post('day_start');
    $month_start = input_post('month_start');
    $year_start = (input_post('year_start')) + 543;

    $day_end = input_post('day_end');
    $month_end = input_post('month_end');
    $year_end = (input_post('year_end')) + 543;

    $db = Mysql::load();


    $sql = "SELECT a.`hn`,a.`ptname`,a.`sumnprice`,a.`staf_massage`,
    DATE_FORMAT(a.`date`,'%H:%i:%s') AS `time`, 
    DATE_FORMAT( CONCAT((DATE_FORMAT(a.`date`,'%Y')-543), DATE_FORMAT(a.`date`, '-%m-%d')) , '%w') AS `day_name` ,
    SUBSTRING(a.`date`, 1, 10) AS `aDate`, 
    b.`code`, a.`price` AS `aPrice`
    FROM `depart` AS a 
    LEFT JOIN `patdata` AS b ON b.`idno` = a.`row_id`
    WHERE a.`staf_massage` != '' 
    AND a.`status` != 'N' 
    AND a.`date` >= '$year_start-$month_start-$day_start 00:00:00' AND a.`date` <= '$year_end-$month_end-$day_end 23:59:59' 
    AND b.`code` in ('58002' , '58003' ,'58004' ,'58002a','58002b','58002c','58005','58006','58007','58102','58130','58131','58201','58301','58301a','58131P','58130P','58130S','58131S','58133')
    ORDER BY a.`date`, a.`staf_massage`";

	
	//print($sql);

    $db->select($sql);
    $items = $db->get_items();

    $new_items_250 = array();
    $new_items_250_plus = array();
    
    foreach ($items as $key => $item) {
        
        /*
        $dayNum = (int) $item['day_name'];
        if ( $time_selected == "1" ) { // ���� �͡�����Ҫ��� �������͡���������Ҫ���
            
            if( $dayNum == 0 OR $dayNum == 6 ){
                continue;
            }

            if( $item['time'] <= "08:20:00" OR $item['time'] >= "16:20:00" ){
                continue;
            }

        }elseif ( $time_selected == "2" ) { // ���� ������Ҫ��� �������͡�����Ź͡�����Ҫ���
            
            if( $item['time'] >= "08:20:00" AND $item['time'] <= "16:20:00" ){
                continue;
            }
        }
        */

        // �ҷ��ᾷ�������ѹ���
        $item['tradname'] = NULL;
        $drug_sql = "SELECT `tradname` FROM `drugrx` WHERE `date` LIKE '".$item['aDate']."%' AND `hn` = '".$item["hn"]."'";
        $db->select($drug_sql);
        $drug = $db->get_item();
        if ( $drug['tradname'] != NULL ) {
            $item['tradname'] = $drug['tradname'];
        }

        $key = $item['staf_massage'];


        if($item['aPrice'] == "250.00"){
            $new_items_250[$key][] = $item;
        }

        if($item['aPrice'] == "300.00"){
            $new_items_250_plus[$key][] = $item;
        }
		        
    }

    $notification = false;


    if ( count($new_items_250) > 0 && $print_type == 2 ) {
        $notification = true;
        foreach ($new_items_250 as $key => $item_list) {
            ?>
            <div>
                <?=header_sign($key);?>
                <table class="chk_table">
                    <thead>
                        <tr bgcolor="#e8e8e8">
                            <th width="5%">�ӴѺ</th>
                            <th width="18%">�ѹ/��͹/��</th>
                            <th width="10%">HN</th>
                            <th width="25%">���� - ���ʡ��</th>
                            <th width="25%">��è�����</th>
                            <th class="no-print">�Ҥ�</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $i = 1;
                        foreach ($item_list as $key_list => $item) {
                            ?>
                            <tr>
                                <td><?=$i;?></td>
                                <td><?=$item['aDate'];?> <?=$item['time'];?></td>
                                <td><?=$item['hn'];?></td>
                                <td><?=$item['ptname'];?></td>
                                <td><?=$item['tradname'];?></td>
                                <td align="right" class="no-print"><?=$item['aPrice'];?></td>
                            </tr>
                            <?php
                            $i++;
                        }
                        ?>
                    </tbody>
                </table>
                <br>
                <?=sign();?>
            </div>
            <div style="page-break-after:always;"></div>
            <?php
        }
    }

    if( count($new_items_250_plus) > 0 && $print_type == 3 ){
        $notification = true;
        foreach ($new_items_250_plus as $key => $item_list) {
            ?>
            <div>
                <?=header_sign($key);?>
                <table class="chk_table">
                    <thead>
                        <tr bgcolor="#e8e8e8">
                            <th width="5%">�ӴѺ</th>
                            <th width="18%">�ѹ/��͹/��</th>
                            <th width="10%">HN</th>
                            <th width="25%">���� - ���ʡ��</th>
                            <th width="25%">��è�����</th>
                            <th class="no-print">�Ҥ�</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $i = 1;
                        foreach ($item_list as $key_list => $item) {
                            ?>
                            <tr>
                                <td><?=$i;?></td>
                                <td><?=$item['aDate'];?> <?=$item['time'];?></td>
                                <td><?=$item['hn'];?></td>
                                <td><?=$item['ptname'];?></td>
                                <td><?=$item['tradname'];?></td>
                                <td align="right" class="no-print"><?=$item['aPrice'];?> (+<?=$item['sumnprice'];?>)</td>
                            </tr>
                            <?php
                            $i++;
                        }
                        ?>
                    </tbody>
                </table>
                <br>
                <?=sign();?>
            </div>
            <div style="page-break-after:always;"></div>
            <?php
        }
    }
	
    if( $notification == false ){
        ?>
        <p><b>��辺������</b></p>
        <?php
    }
}
?>
</body>
</html>
<?php

include 'bootstrap.php';

$db = Mysql::load($shs_configs);

$camp = input_get('camp');
if( empty($camp) ){
    echo "��辺������";
    exit;
}

$Conn = mysql_connect(HOST13, USER13, PASS13) or die ("�������ö�Դ��͡Ѻ�����������");
mysql_select_db(DB13, $Conn) or die ("�������ö�Դ��͡Ѻ�ҹ��������");

$sql = "SELECT *,SUBSTRING(`yearchk`, 3, 2) AS `short_year` FROM `chk_company_list` WHERE `code` = '$camp' ";
$q = mysql_query($sql);
$company = mysql_fetch_assoc($q);

$com_yearchk = $company['short_year'];

$sql = "SELECT b.* 
FROM ( 
    SELECT * FROM `opcardchk` WHERE `part` = '$camp'
) AS a 
LEFT JOIN `dxofyear_out` AS b ON b.`hn` = a.`HN` 
WHERE b.row_id IS NOT NULL 
AND b.`yearchk` = '$com_yearchk'
ORDER BY a.`row`";
$items = array();
$q = mysql_query($sql);
while ($item = mysql_fetch_assoc($q)) {
    $items[] = $item;
}
$user_rows = count($items);

if( $user_rows == 0 ){
    echo "����բ����š��ŧ�����ūѡ����ѵ� �����ػ�Ũҡᾷ��";
    exit;
}




?>
<style>
*{
    font-family: TH SarabunPSK;
    font-size: 16px;
}
.chk_table{
    border-collapse: collapse;
}

.chk_table, th, td{
    border: 1px solid black;
}

.chk_table th,
.chk_table td{
    padding: 3px;
}
@media print{
    .no-display{
        display: none;
    }
}
</style>
<div style="text-align: center;">
    <p><b>�š�õ�Ǩ�آ�Ҿ���˹�ҷ�� <?=$company['name'];?> ��ԡ�õ�Ǩ�آ�Ҿ � �ç��Һ�Ť�������ѡ��������</b></p>
    <p><b>�����ҧ�ѹ��� <?=$company['date_checkup'];?> �ӹǹ <?=$user_rows;?> ���</b></p>
</div>
<table class="chk_table" width="100%">
    <thead>
        <tr>
            <th width="3%" rowspan="2" align="center">�ӴѺ</th>
            <th width="5%" rowspan="2" align="center">HN</th>
            <th width="15%" rowspan="2" align="center">���� - ʡ��</th>
            <th width="3%" rowspan="2" align="center">����</th>
            <th width="3%" rowspan="2" align="center">���˹ѡ</th>
            <th width="3%" rowspan="2" align="center">��ǹ�٧</th>
            <th width="5%" rowspan="2" align="center">BP</th>
            <th colspan="9" align="center">��¡�õ�Ǩ</th>
            <th width="8%" rowspan="2" align="center">��ػ�š�õ�Ǩ</th>
            <th rowspan="2" align="center">���й�</th>
        </tr>
        <tr>

            <th width="3%" align="center">X-RAY</th>
            <th width="3%" align="center">CBC</th>
            <th width="3%" align="center">UA</th>
            <th width="3%" align="center">BS</th>
            <th width="3%" align="center">CR</th>
            <th width="3%" align="center">CHOL</th>
            <th width="3%" align="center">HDL</th>
            <th width="5%" align="center">HBsAg</th>
            <th width="6%" align="center">FOBT</th>

        </tr>
    </thead>
    <tbody>
    
    <?php 
    $i = 0;
    foreach ($items as $key => $item) {

        ++$i;

        $age = substr($item['age'], 0, 2);
        $bp1 = $item['bp1'];
        $bp2 = $item['bp2'];

        if( !empty($item['bp21']) && $item['bp21'] != '-' ){
            $bp1 = $item['bp21'];
        } 
        if( !empty($item['bp22']) && $item['bp22'] != '-' ){
            $bp2 = $item['bp22'];
        }

        $yearchk = $item['yearchk'];
        $hn = $item['hn'];

        $chk_sql = "SELECT b.`cxr`,b.`res_cbc`,b.`res_ua`,b.`res_glu`,b.`res_crea`,b.`res_chol`,b.`res_hdl`,b.`res_hbsag`, 
        b.`conclution`,b.`normal_suggest`,b.`normal_suggest_date`,b.`abnormal_suggest`,b.`abnormal_suggest_date`,b.`diag`, 
        b.`yearchk` 
        FROM ( 
            SELECT MAX(`id`) AS `latest_id` FROM `chk_doctor` WHERE `hn` = '$hn' AND `yearchk` = '$yearchk' 
        ) AS a 
        LEFT JOIN `chk_doctor` AS b ON b.`id` = a.`latest_id` ";
        $chk_q = mysql_query($chk_sql);
        $chk_item = mysql_fetch_assoc($chk_q);
        // $db->select($chk_sql);
        // $chk_item = $db->get_item();

        
        $item = array_merge($item, $chk_item);
        // dump($item);
        // ��Ǩ ʵ�� <-- �����ѧ��Ѵ������
        // $occult = false;
        // $sql = "SELECT b.* 
        // FROM `resulthead` AS a 
        // LEFT JOIN `resultdetail` AS b ON b.`autonumber` = a.`autonumber` 
        // WHERE a.`hn` = '$hn' 
        // AND a.`clinicalinfo` = '��Ǩ�آ�Ҿ��Шӻ�$yearchk' 
        // AND a.`profilecode` = 'OCCULT' ";

        // $db->select($sql);
        // $occu_row = $db->get_rows();
        // if( $occu_row > 0 ){
        //     $lab = $db->get_item();
        //     $occult = $lab['flag'];
        // }

        // ��ػ�Ũҡ conclution ���ᾷ��ŧ
        $conclution = $item['conclution'];
        if( $conclution == 1 ){
            $suggest_list = array(
                1 => '����������й�', 
                '�й�����Ѻ��õ�Ǩ������ͧ ���駵���'
            );

            $suggest = $item['normal_suggest'];
            $suggest_date = ( !empty($item['normal_suggest_date']) && $item['normal_suggest_date'] != '0000-00-00' ) ? '��ѹ��� '.$item['normal_suggest_date'] : '' ;
            
        }else{
            $suggest_list = array(
                1 => '����������й�', 
                '�����й�㹡�õ�Ǩ�Դ���/��Ǩ��� ���駵���', 
                '�����й�����Ѻ����ѡ�ҡó��纻����¹Ѵ����Ѻ��ԡ��', 
                '�����й�����ѡ����ѡ�ҡó������á��͹�ҡ�ä������ѧ'
            );

            $suggest = $item['abnormal_suggest'];
            $suggest_date = ( !empty($item['abnormal_suggest_date']) && $item['abnormal_suggest_date'] != '0000-00-00' ) ? '��ѹ��� '.$item['abnormal_suggest_date'] : '' ;
            
        }

        $suggest_detail = $suggest_list[$suggest];
        $conclution_detail = $suggest_detail.$suggest_date;

        // �ŵ�Ǩ�������
        $sql = "SELECT b.* 
        FROM ( 

            SELECT MAX(`autonumber`) AS `latest_number` 
            FROM `resulthead` 
            WHERE `hn` = '$hn' 
            AND ( `profilecode` != 'CBC' AND `profilecode` != 'UA' )
            AND `clinicalinfo` = '��Ǩ�آ�Ҿ��Шӻ�$yearchk' 
            GROUP BY `profilecode` 
            ORDER BY `autonumber` ASC 

        ) AS a 
            RIGHT JOIN `resultdetail` AS b ON b.`autonumber` = a.`latest_number` 
        WHERE b.`autonumber` = a.`latest_number` 
        AND ( 
            b.`labcode` = 'GLU' 
            OR b.`labcode` = 'CREA' 
            OR b.`labcode` = 'CHOL' 
            OR b.`labcode` = 'HDL' 
            OR b.`labcode` = 'HBSAG' 
            OR b.`labcode` = 'OCCULT' 
            OR b.`labcode` = '38302' 
            OR b.`labcode` = 'STOCC' 
        ) 
        ORDER BY b.seq ASC ";

        $etc_items = array();
        $etc_q = mysql_query($sql);
        while ($etc_item = mysql_fetch_assoc($etc_q)) {
            $etc_items[] = $etc_item;
        }

        
        $etc = array();
        foreach ($etc_items as $key => $lab_item) {
            $labcode = strtolower($lab_item['labcode']);
            $etc[$labcode] = array(
                'result' => $lab_item['result'], 
                'normalrange' => $lab_item['normalrange'],
                'flag' => $lab_item['flag']
            );
        }
        
        ?>
        <tr>
            
            <td align="right"><?=$i;?></td>
            <td><?=$hn;?></td>
            <td><?=$item['ptname'];?></td>
            <td align="right"><?=$age;?></td>
            <td align="right"><?=$item['weight'];?></td>
            <td align="right"><?=$item['height'];?></td>
            <td><?=$bp1.'/'.$bp2?></td>


            <td><?=( $item['cxr'] == '1' ? '����' : ( $item['cxr'] == '2' ? '�Դ����' : '' ) );?></td>
            <td>
                <?php
                if( $item['res_cbc'] == '1' ){
                    echo "����";
                }else if( $item['res_cbc'] == '2' ){
                    echo "�Դ����";
                }
                ?>
            </td>
            <td>
                <?php
                if( $item['res_ua'] == '1' ){
                    echo "����";
                }else if( $item['res_ua'] == '2' ){
                    echo "�Դ����";
                }
                ?>
            </td>
            <?php 
            $bg = '';
            if( !empty($etc['glu']['result']) && $item['res_glu'] == "0" ){
                $bg = 'bgcolor="yellow"';
            }
            ?>
            <td align="right" <?=$bg;?>>
                <?php 
                $style = '';
                if( $etc['glu']['flag'] != 'N' ){
                    $style = 'style="font-weight: bold; color: red;"';
                }
                ?>
                <span <?=$style;?> title="Normal: <?=$etc['glu']['normalrange'];?>"><?=$etc['glu']['result'];?></span>
            </td>
            <?php 
            $bg = '';
            if( !empty($etc['crea']['result']) && $item['res_crea'] == "0" ){
                $bg = 'bgcolor="yellow"';
            }
            ?>
            <td align="right" <?=$bg;?>>
                <?php 
                $style = '';
                if( $etc['crea']['flag'] != 'N' ){
                    $style = 'style="font-weight: bold; color: red;"';
                }
                ?>
                <span <?=$style;?> title="Normal: <?=$etc['crea']['normalrange'];?>"><?=$etc['crea']['result'];?></span>
            </td>
            <?php 
            $bg = '';
            if( !empty($etc['chol']['result']) && $item['res_chol'] == "0" ){
                $bg = 'bgcolor="yellow"';
            }
            ?>
            <td align="right" <?=$bg;?> >
                <?php 
                $style = '';
                if( $etc['chol']['flag'] != 'N' ){
                    $style = 'style="font-weight: bold; color: red;"';
                }
                ?>
                <span <?=$style;?> title="Normal: <?=$etc['chol']['normalrange'];?>"><?=$etc['chol']['result'];?></span>
            </td>
            <?php 
            $bg = '';
            if( !empty($etc['hdl']['result']) && $item['res_hdl'] == "0" ){
                $bg = 'bgcolor="yellow"';
            }
            ?>
            <td align="right" <?=$bg;?>>
                <?php 
                $style = '';
                if( $etc['hdl']['flag'] != 'N' ){
                    $style = 'style="font-weight: bold; color: red;"';
                }
                ?>
                <span <?=$style;?> title="Normal: <?=$etc['hdl']['normalrange'];?>"><?=$etc['hdl']['result'];?></span> 
            </td>
            <?php 
            $bg = '';
            if( !empty($etc['hbsag']['result']) && $item['res_hbsag'] == "0" ){
                $bg = 'bgcolor="yellow"';
            }
            ?>
            <td <?=$bg;?>>
                <?php
                if( $etc['hbsag']['result'] == 'Negative' ){
                    echo '��辺����';
                }elseif ( $etc['hbsag']['result'] == 'Positive' ) {
                    echo '������';
                }
                ?>
            </td>
            <?php 
            $bg = '';
            if( (!empty($etc['occult']['result']) OR !empty($etc['stocc']['result']) ) && $item['res_occult'] == "0" ){
                $bg = 'bgcolor="yellow"';
            }
            ?>
            <td <?=$bg;?>>
                <?php
                if( $etc['occult']['result'] == 'Negative' ){
                    echo '��辺���ʹ';
                }elseif ( $etc['occult']['result'] == 'Positive' ) {
                    echo '�����ʹ';
                }

                if( $etc['stocc']['result'] == 'Negative' ){
                    echo '��辺���ʹ';
                }elseif ( $etc['stocc']['result'] == 'Positive' ) {
                    echo '�����ʹ';
                }

                $bg = '';
                
                ?>
            </td>

            
            <td><?=( $item['conclution'] == '1' ? '����' : ( $item['conclution'] == '2' ? '�Դ����' : '' ) );?></td>
            <td><?=$conclution_detail;?></td>
            <!-- <td>��ػ�š�õ�Ǩ</td> -->

        </tr>
        <?php
    }
    ?>

    </tbody>
</table>
<p align="center">BS = ��ӵ������ʹ  CHOL, HDL = ��ѹ����ʹ CR = ��÷ӧҹ�ͧ� HBsAg = ��������ʵѺ�ѡ�ʺ  FOBT = ���ʹ��ب����</p>
<p class="no-display">���ͺ����͹ BS, CHOL, HDL, CR, HBsAg, FOBT ����ʴ�����������ʴ����ᾷ���ѧ�����ŧ��</p>
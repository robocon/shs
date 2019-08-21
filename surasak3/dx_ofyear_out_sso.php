<?php

include 'bootstrap.php';
$shs_configs = array(
    'host' => '192.168.1.13',
    'port' => '3306',
    'dbname' => 'smdb',
    'user' => 'dottow',
    'pass' => ''
);
$db = Mysql::load($shs_configs);

$def_date = input('date', date('Y-m-d'));
$hn = input('hn');
$action = input('action');
?>
<style type="text/css">
*{
    font-family: TH SarabunPSK;
    font-size: 18px;
}
@media print{
    .no-print{
        display: none;
    }
}

</style>

<div class="no-print">
    <a href="../nindex.htm">&lt;&lt;&nbsp;��Ѻ�˹������� þ.</a>
</div>
<br>

<fieldset class="no-print">
    <legend>���ҵ���ѹ���</legend>
    <form action="dx_ofyear_out_sso.php" method="post">
        <div>
            ���͡�ѹ��� <input type="text" name="date" id="" value="<?=$def_date;?>">
        </div>
        <div>
            <button type="submit">�ʴ�������</button>
            <input type="hidden" name="action" value="show">
        </div>
    </form>
</fieldset>

<fieldset class="no-print">
    <legend>���ҵ��HN</legend>
    <form action="dx_ofyear_out_sso.php" method="post">
        <div>
            ���͡HN <input type="text" name="hn" id="" value="<?=$hn;?>">
        </div>
        <div>
            <button type="submit">�ʴ�������</button>
            <input type="hidden" name="action" value="show">
        </div>
    </form>
</fieldset>

<fieldset class="no-print">
    <legend>���ҵ������ѷ</legend>
    <form action="dx_ofyear_out_sso.php" method="post">
        <?php 
        $db->select("SELECT `code`,`name` FROM `chk_company_list` ORDER BY `id` DESC");
        $company_list = $db->get_items();
        ?>
        <div>
            ���͡����ѷ: 
            <select name="company_name" id="">
                <?php 
                foreach ($company_list as $key => $item) {
                    ?>
                    <option value="<?=$item['code'];?>"><?=$item['name'];?> (<?=$item['code'];?>)</option>
                    <?php
                }
                ?>
            </select>
        </div>
        <div>
            <button type="submit">�ʴ�������</button>
            <input type="hidden" name="action" value="show">
            <input type="hidden" name="type" value="company">
        </div>
    </form>
</fieldset>
<?php
if( $action === 'show' ){

    $test_type = input_post('type');
    if( $test_type == 'company' ){

        $part = input('company_name');

        $sql_com = "SELECT * FROM `chk_company_list` WHERE `code` = '$part' ";
        $db->select($sql_com);
        $company = $db->get_item();

        // ��Ǻ���ѷ�����ҡ����ʴ���Ẻ��� -___-" ����͹� paper
        if($company['id'] < 70){

            //������
            $sql = "SELECT b.* 
            FROM `opcardchk` AS a 
            LEFT JOIN `dxofyear_out` AS b ON b.`hn` = a.`HN` 
            WHERE a.`part` = '$part' 
            AND b.`camp` LIKE '��Ǩ�آ�Ҿ%' ";

            // $sql = "SELECT b.* 
            // FROM `opcardchk` AS a 
            // LEFT JOIN `dxofyear_out` AS b ON b.`hn` = a.`HN` 
            // WHERE a.`part` = '$part' 
            // AND b.`row_id` IS NOT NULL 
            // ORDER BY b.`row_id` ASC ";

        }else{ // �������� order �����¡�ù���Ңͧ���Ἱ���Ǩ�آ�Ҿ
            $sql = "SELECT a.`row`,a.`pid`,a.`HN` AS `hn2`,CONCAT(a.`name`,' ',a.`surname`) AS `ptname2`,b.* 
            FROM ( 
                SELECT * FROM `opcardchk` WHERE `part` = '$part' 
            ) AS a 
            LEFT JOIN `dxofyear_out` AS b ON b.`hn` = a.`HN` 
            WHERE b.row_id IS NOT NULL ";
        }

        $db->select($sql);
        $rows = $db->get_rows();

    }else{

        $where = "AND `thidate` LIKE '$def_date%' ";
        if( !empty($hn) ){
            $where = "AND `hn` = '$hn' ORDER BY `row_id` DESC";
        }

        // �ѹ����� `camp` LIKE '��Ǩ�آ�Ҿ%'
        $sql = "SELECT *, SUBSTRING(`thidate`, 1, 10) AS `short_date`  
        FROM `dxofyear_out` 
        WHERE `camp` LIKE '��Ǩ�آ�Ҿ%' 
        $where ";

        $db->select($sql);
        $rows = $db->get_rows();
        
    }
    
    if( $rows > 0 ){
        $items = $db->get_items();
        ?>
        <style>
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
        </style>
        <?php 
        if( $test_type == 'company' ){
            ?>
            <div class="no-print" style="margin: 4px;">
                <button onclick="window.print();">��ԡ������觾����� <?=$company['name'];?></button>
            </div>
            <h3>����ѷ <?=$company['name'];?></h3>
            <?php
        }else{
            ?>
            <h3>��ª��ͼ���Ǩ�آ�Ҿ Walk-in �ѹ��� <?=$def_date;?></h3>
            <?php
        }
        ?>
        <table class="chk_table">
            <thead>
                <tr>
                    <th>#</th>
                    <th>�ѹ���</th>
                    <th>HN</th>
                    <th>����-ʡ��</th>
                    <th>�٧(cm.)</th>
                    <th>��.(kg.)</th>
                    <th>bp1</th>
                    <th>bp2</th>
                    <th>CXR</th>
                    <th>CBC</th>
                    <th>UA</th>
                    <th>��ӵ������ʹ FBS</th>
                    <th>�(CREA)</th>
                    <th>Total Cholesterol</th>
                    <th>HDL Cholesterol</th>
                    <th>HBsAg</th>
                    <th>Occult(FOBT)</th>
                    <th>��ػ�ŵ�Ǩ</th>
                    <th>Diag</th>
                    <th>�Ţ�ѵ� ���.</th>
                    <th>�������</th>
                    <th>������</th>
                </tr>
            </thead>
            <tbody>
            <?php
            $i = 1;
            foreach ($items as $key => $item) {
                
                $hn = $item['hn'];
                $yearchk = $item['yearchk'];

                $sql = "SELECT 
                CASE
                    WHEN b.`res_cbc` = 1 THEN '����' 
                    WHEN b.`res_cbc` = 2 THEN '�Դ����' 
                    ELSE ''
                END AS `res_cbc`,
                CASE
                    WHEN b.`res_ua` = 1 THEN '����' 
                    WHEN b.`res_ua` = 2 THEN '�Դ����' 
                    ELSE ''
                END AS `res_ua`,
                CASE
                    WHEN b.`res_glu` = 1 THEN '����' 
                    WHEN b.`res_glu` = 2 THEN '�Դ����' 
                    ELSE ''
                END AS `res_glu`,
                CASE
                    WHEN b.`res_crea` = 1 THEN '����' 
                    WHEN b.`res_crea` = 2 THEN '�Դ����' 
                    ELSE ''
                END AS `res_crea`,
                CASE
                    WHEN b.`res_chol` = 1 THEN '����' 
                    WHEN b.`res_chol` = 2 THEN '�Դ����' 
                    ELSE ''
                END AS `res_chol`,
                CASE
                    WHEN b.`res_hdl` = 1 THEN '����' 
                    WHEN b.`res_hdl` = 2 THEN '�Դ����' 
                    ELSE ''
                END AS `res_hdl`,
                CASE
                    WHEN b.`res_hbsag` = 1 THEN '����' 
                    WHEN b.`res_hbsag` = 2 THEN '�Դ����' 
                    ELSE ''
                END AS `res_hbsag`, 
                CASE
                    WHEN b.`cxr` = 1 THEN '����' 
                    WHEN b.`cxr` = 2 THEN '�Դ����' 
                    ELSE ''
                END AS `cxr`, 
                CASE
                    WHEN b.`res_occult` = 1 THEN '����' 
                    WHEN b.`res_occult` = 2 THEN '�Դ����' 
                    ELSE ''
                END AS `res_occult`, 
                CASE 
                    WHEN b.`conclution` = 1 THEN '����' 
                    WHEN b.`conclution` = 2 THEN '�Դ����' 
                    ELSE '' 
                END AS `conclution`, 
                `diag` 
                FROM ( 
                    SELECT MAX(`id`) AS `latest_id` FROM `chk_doctor` WHERE `hn` = '$hn' AND `yearchk` = '$yearchk' 
                ) AS a 
                LEFT JOIN `chk_doctor` AS b ON b.`id` = a.`latest_id` 
                WHERE ( b.`date_chk` LIKE '".$item['short_date']."%' OR b.`vn` = '".$item['vn']."' )";
                $db->select($sql);
                $user = $db->get_item();

                

                $sql_opcard = "SELECT `idcard`,`address`,`tambol`,`ampur`,`changwat`,`hphone`,`phone`,`ptffone` 
                FROM `opcard` 
                WHERE `hn` = '$hn' ";
                $db->select($sql_opcard);
                $opcard = $db->get_item();

                $address = $opcard['address'];
                if( $opcard['tambol'] ){
                    $address .= ' �.'.$opcard['tambol'];
                }

                if( $opcard['ampur'] ){
                    $address .= ' �.'.$opcard['ampur'];
                }

                if( $opcard['changwat'] ){
                    $address .= ' �.'.$opcard['changwat'];
                }

                $phone = $opcard['phone'].' '.$opcard['hphone'].' '.$item['ptffone'];

                
                ?>
                <tr valign="top">
                    <td><?=$i;?></td>
                    <td><?=$item['thidate'];?></td>
                    <td>
                    <?php
                    if(empty($hn)){
                        $hn = $item['hn2'];
                    }

                    echo $hn;
                    ?>
                    </td>
                    <td>
                        <?php 
                        $ptname = $item['ptname'];
                        if(empty($ptname)){
                            $ptname = $item['ptname2'];
                        }
                        echo $ptname;
                        ?>
                    </td>
                    <td align="right"><?=$item['height'];?></td>
                    <td align="right"><?=$item['weight'];?></td>
                    <td align="right"><?=$item['bp1'];?></td>
                    <td align="right"><?=$item['bp2'];?></td>
                    <td><?=$user['cxr'];?></td>
                    <td><?=$user['res_cbc'];?></td>
                    <td><?=$user['res_ua'];?></td>
                    <td><?=$user['res_glu'];?></td>
                    <td><?=$user['res_crea'];?></td>
                    <td><?=$user['res_chol'];?></td>
                    <td><?=$user['res_hdl'];?></td>
                    <td><?=$user['res_hbsag'];?></td>
                    <td><?=$user['res_occult'];?></td>
                    <td><?=$user['conclution'];?></td>
                    <td><?=$user['diag'];?></td>
                    <td><?=$opcard['idcard'];?></td>
                    <td><?=$address;?></td>
                    <td><?=$phone;?></td>
                </tr>
                <?php
                $i++;
            }
            ?>
            </tbody>
        </table>
        <?php
    }else{
        ?>
        <p>��辺������</p>
        <?php
    }
}
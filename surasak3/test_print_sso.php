<?php

header('Content-Type: text/html; charset=tis-620');
date_default_timezone_set("Asia/Bangkok");

include 'bootstrap.php';

class cu_sso{
    
    public $checkup_list = array();
    public $code = array();

    public function __construct(){

    }

    public function get_lab_lists(){
        return array('CBC' => 'CBC', 
        'UA' => 'UA',
        'FBS' => 'BS',
        '�' => 'CR',
        '��ѹ' => 'LIPID',
        '�Ѻ�ѡ�ʺ' => 'HBSAG',
        'Pap Smear' => 'PAP',
        'Stool' => 'STOCB',
        'X-Ray' => '41001');
    }

    public function check($labs, $age, $sex){
        
        $age = (int) $age;
        
        $this->checkup_list = array();
        $this->code = array();

        if( ( $age >= 18 && $age <= 70 ) && in_array('CBC', $labs) === true ){
            $this->checkup_list[] = '��������ó�ͧ������ʹ CBC'."<br>";
            $this->code[] = 'CBC';
        }

        if( $age >= 55 && in_array('UA', $labs) === true ){
            $this->checkup_list[] = '������� UA'."<br>";
            $this->code[] = 'UA';
        }

        if( ( $age >= 35 && $age <= 55 ) && in_array('BS', $labs) === true ){
            $this->checkup_list[] = '��ӵ������ʹ FBS'."<br>";
            $this->code[] = 'BS';
        }

        if( $age >= 55 && in_array('CR', $labs) === true ){
            $this->checkup_list[] = '��÷ӧҹ�ͧ� Cr'."<br>";
            $this->code[] = 'CR';
        }

        if( $age >= 20 && in_array('LIPID', $labs) === true ){
            $this->checkup_list[] = '��ѹ�������ʹ��Դ Total & HDL cholesterol'."<br>";
            $this->code[] = 'LIPID';
        }

        if( $age >= 25 && in_array('HBSAG', $labs) === true ){
            $this->checkup_list[] = '��������ʵѺ�ѡ�ʺ HBsAg'."<br>";
            $this->code[] = 'HBSAG';
        }

        if( ( $age >= 30 && $sex > 1 ) && in_array('pap', $labs) === true ){
            $this->checkup_list[] = '����移ҡ���١ Pap Smear'."<br>";
            $this->code[] = 'PAP';
            
        }

        if( $age >= 50 && in_array('STOCB', $labs) === true ){
            $this->checkup_list[] = '���ʹ��ب���� FOBT'."<br>";
             $this->code[] = 'STOCB';
        }

        if( $age >= 15 ){
            $this->checkup_list[] = 'Chest X-ray'."<br>";
            $this->code[] = '41001';
        }

    }

    public function get_checkup_list(){
        return $this->checkup_list;
    }

    public function get_code(){
        return $this->code;
    }

}


$sso = new cu_sso();
$db = Mysql::load();
$sql = "SELECT a.*,b.`dbirth`
, CONCAT(SUBSTRING(b.`dbirth`, 1, 4) - 543, SUBSTRING(b.`dbirth`, 5, 10))
, b.`idcard` AS `idcard`
FROM `opcardchk` AS a 
LEFT JOIN `opcard` AS b ON b.`hn` = a.`hn` 
WHERE a.`part` = '�١��ҧ60' 
AND a.`active` = 'y';";
$db->select($sql);
$items = $db->get_items();

?>
<style type="text/css">
*{
    font-family: 'TH SarabunPSK';
    font-size: 16pt;
}
</style>
<h3>��õ�Ǩ�آ�Ҿ��Шӻ� 2560 �ͧ����Сѹ�� þ.��������ѡ��������</h3>
<table border="1" cellspacing="0" cellpadding="3"  bordercolor="#000000" border-collapse="collapse">
    <?php
    $headers = $sso->get_lab_lists();
    ?>
    <thead>
        <tr>
            <th>#</th>
            <th>HN</th>
            <th>����</th>
            <th>�Ţ�ѵ� ���.</th>
            <th>����</th>
            <th>�ԡ</th>
            <?php
            foreach ($headers as $key => $head) {
                ?>
                <th><?=$key;?></th>
                <?php
            }
            ?>
            <th>���</th>
        </tr>
    </thead>
    <tbody>
        <?php
        $i = 1;

        $total_yprice = 0;
        $total_nprice = 0;
        foreach ($items as $key => $item) {
            
            $sql = "SELECT `profilecode` 
            FROM `resulthead` WHERE `hn` = '".$item['HN']."' 
            AND `clinicalinfo` = '��Ǩ�آ�Ҿ��Шӻ�60' 
            AND `profilecode` IN ('CBC','UA','BS','BUN','CR','LIPID','HBSAG','PAP','STOCB')
            GROUP BY `profilecode` ";
            $db->select($sql);
            $labs = $db->get_items();
            $lab_lists = array();
            // �鴷���Ǩ��ԧ�ҡ resulthead
            foreach ($labs as $key => $val) {
                $lab_lists[] = $val['profilecode'];
            }

            // ������
            list($th_year, $month, $day) = explode('-', $item['dbirth']);
            $time1 = strtotime(($th_year - 543)."-$month-$day");
            $time2 = strtotime(date('Y-m-d'));
            $time_diff = $time2 - $time1;

            $age_year = (date('Y',$time_diff) - 1970);
            $age_month = ( date('m',$time_diff) - 1 );

            if( strpos($item['name'], '���') !== false ){
                $item['sex'] = 1;
            }else if( strpos($item['name'], '�ҧ') !== false ){
                $item['sex'] = 2;
            }else if( strpos($item['name'], '�.�.') !== false ){
                $item['sex'] = 3;
            }

            // ����¡�� lab 
            $sso->check($lab_lists, $age_year, $item['sex']);

            // ����������
            // $checkup_list = $sso->get_checkup_list();

            // ��¡�÷�����������ö��Ǩ��㹡�����ͧ��Сѹ�ѧ��
            $code_list = $sso->get_code();

            ?>
            <tr>
                <td align="center"><?=$i;?></td>
                <td><?=$item['HN'];?></td>
                <td><?=($item['name'].' '.$item['surname']);?></td>
                <td><?=$item['idcard'];?></td>
                <td>
                    <?php echo $age_year;?> �� <?php echo ( $age_month != 0 ) ? $age_month.'��͹' : '' ;?> 
                </td>
                <td>��<br>�����</td>
                <?php
                $yprice_per_user = 0;
                $nprice_per_user = 0;
                foreach ($headers as $key => $head) {
                    ?>
                    <td align="right" valign="top">
                        <?php
                        if( in_array($head, $code_list) ){

                            $sql = "SELECT `price`,`yprice`,`nprice` 
                            FROM `sso_checkup` 
                            WHERE `code_lab` = '$head'";
                            $db->select($sql);

                            $val = $db->get_item();

                            $yprice = (float) $val['yprice'];
                            $nprice = (float) $val['nprice'];

                            $yprice_per_user += $yprice;
                            $nprice_per_user += $nprice;

                            echo '<span title="�ԡ��">'.number_format($yprice, 2).'</span>';
                            if( $nprice > 0 ){
                                echo '<br><span title="�ԡ�����">'.number_format($nprice, 2).'</span>';
                            }
                        }
                        ?>
                        </td>
                    <?php
                    
                } // end foreach sso_checkup

                $total_yprice += $yprice_per_user;
                $total_nprice += $nprice_per_user;
                ?>
                <td align="right">
                    <?=(number_format($yprice_per_user, 2).'<br>'.number_format($nprice_per_user, 2));?>
                </td>
            </tr>
            <?php
            $i++;
        }
        ?>
        <tr>
            <td colspan="14" align="center">���</td>
            <td align="right">
                <?=(number_format($total_yprice, 2).'<br>'.number_format($total_nprice, 2));?>
            </td>
        </tr>
    </tbody>
</table>
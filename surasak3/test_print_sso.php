<?php

header('Content-Type: text/html; charset=tis-620');
date_default_timezone_set("Asia/Bangkok");

include 'bootstrap.php';

// phpinfo();

class cu_sso{
    
    public $checkup_list = array();
    public $code = array();

    public function __construct(){

    }

    public function get_lab_lists(){
        return array('CBC' => 'CBC', 
        'UA' => 'UA',
        'FBS' => 'BS',
        'ไต' => 'BUN,CR',
        'ไขมัน' => 'LIPID',
        'ตับอักเสบ' => 'HBSAG',
        'Pap Smear' => 'PAP',
        'Stool' => 'STOCB',
        'X-Ray' => '41001');
    }

    public function check($package, $age, $sex){
        
        $age = (int) $age;
        
        $this->checkup_list = array();
        $this->code = array();
        // $code = array();

        if( $age >= 40 ){
            $this->checkup_list[] = 'การตรวจตาโดยความดูแลของจักษุแพทย์'."<br>";
            
        }

        if( $age >= 55 ){
            $this->checkup_list[] = 'การตรวจสายตาด้วย snellen eye chart'."<br>";
            
        }

        if( $age >= 18 && $age <= 70 ){
            $this->checkup_list[] = 'ความสมบูรณ์ของเม็ดเลือด CBC'."<br>";
            $this->code[] = 'CBC';
        }

        if( $age >= 55 ){
            $this->checkup_list[] = 'ปัสสาวะ UA'."<br>";
            $this->code[] = 'UA';
        }

        if( $age >= 35 && $age <= 55 ){
            $this->checkup_list[] = 'น้ำตาลในเลือด FBS'."<br>";
            $this->code[] = 'BS';
        }

        if( $age >= 55 ){
            $this->checkup_list[] = 'การทำงานของไต Cr'."<br>";
            $this->code[] = 'BUN,CR';
        }

        if( $age >= 20 ){
            $this->checkup_list[] = 'ไขมันในเส้นเลือดชนิด Total & HDL cholesterol'."<br>";
            $this->code[] = 'LIPID';
        }

        if( $age >= 25 ){
            $this->checkup_list[] = 'เชื้อไวรัสตับอักเสบ HBsAg'."<br>";
            $this->code[] = 'HBSAG';
        }

        if( $age >= 30 && $sex > 1 ){
            $this->checkup_list[] = 'มะเร็งปากมดลูก Pap Smear'."<br>";
            $this->checkup_list[] = 'มะเร็งปากมดลูก Via'."<br>";

            $this->code[] = 'PAP';
            
        }

        if( $age >= 50 ){
            $this->checkup_list[] = 'เลือดในอุจจาระ FOBT'."<br>";
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

/**
 * todo
 * ออกรายงาน
 *
 */
$sso = new cu_sso();

$db = Mysql::load();
$sql = "SELECT a.*,b.`dbirth`
, CONCAT(SUBSTRING(b.`dbirth`, 1, 4) - 543, SUBSTRING(b.`dbirth`, 5, 10))
, b.`idcard`
FROM `opcardchk` AS a 
LEFT JOIN `opcard` AS b ON b.`hn` = a.`hn` 
WHERE a.`part` = 'ลูกจ้าง60' 
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
<h3>การตรวจสุขภาพประจำปีของผู้ประกันตน รพ.ค่ายสุรศักดิ์มนตรี</h3>
<table border="1" cellspacing="0" cellpadding="3"  bordercolor="#000000" border-collapse="collapse">
    <?php
    $headers = $sso->get_lab_lists();
    ?>
    <thead>
        <tr>
            <th>#</th>
            <th>HN</th>
            <th>ชื่อ</th>
            <th>เลขบัตรปชช.</th>
            <th>อายุ</th>
            <th>เบิก</th>
            <?php
            foreach ($headers as $key => $head) {
                ?>
                <th><?=$key;?></th>
                <?php
            }
            ?>
            <th>รวม</th>
        </tr>
    </thead>
    <tbody>
        <?php
        $i = 1;

        $total_yprice = 0;
        $total_nprice = 0;
        foreach ($items as $key => $item) {
            
            // วันเกิดจากใน opcard
            list($th_year, $month, $day) = explode('-', $item['dbirth']);
            $time1 = strtotime(($th_year - 543)."-$month-$day");

            // เปรียบเทียบกับ ณ วันที่มาเจาะ lab เค้าอายุจริงเท่าไร
            $hn = $item['HN'];
            $sql = "SELECT SUBSTRING(`orderdate`, 1, 10) AS `date_lab` 
            FROM `orderhead` 
            WHERE `hn` = '$hn' 
            AND `clinicalinfo` = 'ตรวจสุขภาพประจำปี60' ";
            $db->select($sql);
            $lab = $db->get_item();
            $time2 = strtotime($lab['date_lab']);
            $time_diff = $time2 - $time1;


            if( strpos($item['name'], 'นาย') !== false ){
                $item['sex'] = 1;
            }else if( strpos($item['name'], 'นาง') !== false ){
                $item['sex'] = 2;
            }else if( strpos($item['name'], 'น.ส.') !== false ){
                $item['sex'] = 3;
            }

            $age_year = (date('Y',$time_diff) - 1970);
            $age_month = ( date('m',$time_diff) - 1 );

            $sso->check($item['pid'], $age_year, $item['sex']);

            $checkup_list = $sso->get_checkup_list();

            // รายการที่ผู้ป่วยสามารถตรวจได้ในกลุ่มของประกันสังคม
            $code_list = $sso->get_code();

            ?>
            <tr>
                <td align="center"><?=$i;?></td>
                <td><?=$item['HN'];?></td>
                <td><?=($item['name'].' '.$item['surname']);?></td>
                <td><?=$item['idcard'];?></td>
                <td>
                    <?php
                    // dump($item['dbirth']);
                    // list($th_year, $month, $day) = explode('-', $item['dbirth']);
                    // dump(($th_year - 543)."-$month-$day");
                    // dump(date('Y-m-d',$time_diff));
                    ?>
                    <?php echo $age_year;?> ปี <?php echo ( $age_month != 0 ) ? $age_month.'เดือน' : '' ;?> 
                </td>
                <td>ได้<br>ไม่ได้</td>
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

                            echo '<span title="เบิกได้">'.number_format($yprice, 2).'</span>';
                            if( $nprice > 0 ){
                                echo '<br><span title="เบิกไม่ได้">'.number_format($nprice, 2).'</span>';
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
            <td colspan="15" align="center">รวม</td>
            <td align="right">
                <?=(number_format($total_yprice, 2).'<br>'.number_format($total_nprice, 2));?>
            </td>
        </tr>
    </tbody>
</table>
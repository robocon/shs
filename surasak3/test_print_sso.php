<?php
include 'bootstrap.php';


class cu_sso{
    
    public $checkup_list = array();
    public $code = array();

    public function __construct(){

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
            $this->code[] = 'BUN';
            $this->code[] = 'CR';
            
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
        // dump($this->checkup_list);
        // return $checkup_list;   
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
$sql = "SELECT * FROM smdb.opcardchk where part = 'ลูกจ้าง60' and active = 'y';";
$db->select($sql);

$items = $db->get_items();

foreach ($items as $key => $item) {
    
    
    if( mb_strpos($item['name'], 'นาย') !== false ){
        $item['sex'] = 1;
    }else if( mb_strpos($item['name'], 'นาง') !== false ){
        $item['sex'] = 2;
    }else if( mb_strpos($item['name'], 'น.ส.') !== false ){
        $item['sex'] = 3;
    }

    echo $item['HN'].' อายุ:'.$item['agey'].'ปี '.$item['name'].' '.$item['surname'];
    echo "<br>";
    $sso->check($item['pid'], $item['agey'], $item['sex']);
    // dump($this->checkup_list);

    $checkup_list = $sso->get_checkup_list();
    $code_list = $sso->get_code();
    
    ?>
    <ol>
    <?php
    foreach ($checkup_list as $key => $item) {
        ?>
        <li><?=$item;?></li>
        <?php
    }
    ?>
    </ol>
    <?php
    echo 'โค้ดที่ตรวจ '.implode(',', $code_list);
    echo "<hr>";
}


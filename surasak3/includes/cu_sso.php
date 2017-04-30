<?php
/**
 * เริ่มนับตั้งแต่ปี 2560
 */

include_once 'functions.php';

class CU_SSO{
    
    public $checkup_list = array();
    public $code = array();

    public $lab_name = array();

    public $call_temp = false;
    public $call_chkup_temp = false;

    public function __construct(){

    }

    public function get_lab_lists(){
        return array('CBC' => 'CBC', 
        'UA' => 'UA',
        'FBS' => 'BS',
        'ไต' => 'CR',
        'ไขมัน' => 'LIPID',
        'ตับอักเสบ' => 'HBSAG',
        'Pap Smear' => 'PAP',
        'Stool' => 'STOCB',
        'X-Ray' => '41001');
    }

    // หาชื่อของ lab
    public function get_lab_name(){

        global $Conn;

        $lists = $this->get_lab_lists();
        $pre = array();
        foreach( $lists as $val => $key ){
            $pre[] = "'$key'";
        }

        $in = implode(',', $pre);
        $sql = "SELECT `code`,`detail` FROM `labcare` WHERE `code` IN($in)";
        $q = mysql_query($sql, $Conn) or die( mysql_error() );
        $lab = array();
        while ( $item = mysql_fetch_array($q) ) {
            
            $key = $item['code'];
            $lab[$key] = $item['detail'];

        }
        
        return $lab;
    }

    public function get_short_yearchk(){
        global $Conn;

        $sql = "SELECT `prefix` FROM `runno` WHERE `title` = 'y_chekup'";
        $q = mysql_query($sql, $Conn);
        $y = mysql_fetch_assoc($q);
        return $y;
    }

    private function create_cache_db($hn){
        global $Conn;

        // เก็บเป็นแคชเอาไว้ เพราะ query แบบเดิมมันช้า
        $sql = "CREATE TEMPORARY TABLE `out_result_chkup_tmp` 
        SELECT * 
        FROM `out_result_chkup` 
        WHERE `hn` = '$hn' ";
        $this->call_chkup_temp = $sql;
        mysql_query($sql, $Conn);

        /*
        $sql = "CREATE TEMPORARY TABLE `resulthead_tmp` 
        SELECT * 
        FROM `resulthead` 
        WHERE `hn` = '$hn' 
        AND `clinicalinfo` LIKE 'ตรวจสุขภาพประจำปี%'";
        */

        /**
         * @important เริ่มใช้งานตั้งแต่ปี 60 
         * !!! ติดปัญหา !!! 
         * คือข้อมูลเก่าบางตัวมันลง lab วันหนึ่ง แล้วมี ค่าใช้จ่ายโผล่มาอีกวันหนึ่ง เลยอาจจะต้องดูใน orderhead ก่อน
         */
         // 50-13183
         // 58-9016
        /*
        $sql = "SELECT a.`orderdate`,a.`hn`,a.`clinicalinfo`,b.*,c.* 
        FROM `orderhead` AS a 
        LEFT JOIN `orderdetail` AS b ON b.`labnumber` = a.`labnumber` 
        LEFT JOIN `patdata` AS c ON c.`date` = CONCAT( ( SUBSTRING(a.`orderdate`, 1, 4) + 543 ), SUBSTRING(a.`orderdate`, 5, 15) ) 
            AND c.`hn` = a.`hn` 
            AND c.`code` = b.`labcode` 
        WHERE a.`orderdate` >= '2016-10-01' 
        AND a.`clinicalinfo` LIKE 'ตรวจสุขภาพประจำปี%' 
        AND a.`hn` = '58-9016' ";
        */

        $sql = "CREATE TEMPORARY TABLE `orderhead_tmp` 
        SELECT a.`orderdate`,a.`hn`,a.`clinicalinfo`,b.* 
        FROM `orderhead` AS a 
        LEFT JOIN `orderdetail` AS b ON b.`labnumber` = a.`labnumber` 
        WHERE a.`orderdate` >= '2016-10-01' 
        AND a.`clinicalinfo` LIKE 'ตรวจสุขภาพประจำปี%' 
        AND a.`hn` = '$hn' ";
        $this->call_temp = $sql;
        mysql_query($sql, $Conn) or die( mysql_error() );

    }

    private function test_cbc($hn, $year_checkup, $age){
        global $Conn;

        $clinical = '';
        // ตรวจได้ 1 ครั้งในช่วงอายุ 18-54 นี้
        if( $age >= 18 && $age <= 54 ){

            $clinical = "AND `clinicalinfo` LIKE 'ตรวจสุขภาพประจำปี%' ";

        // 55-70 ตรวจได้ปีละครั้ง
        } else if ( $age >= 55 && $age <= 70 ){

            $clinical = "AND `clinicalinfo` = 'ตรวจสุขภาพประจำปี$year_checkup' ";
            
        }

        $sql = "SELECT * 
        FROM `orderhead_tmp` 
        WHERE ( `labcode`  = 'CBC' OR `labcode`  = 'CBC-sso' ) 
        $clinical";
        $q = mysql_query($sql, $Conn) or die( mysql_error() );
        $check_row = mysql_num_rows($q);
        
        // เป็น 0 แสดงว่าปีนี้ยังไม่ได้ตรวจ ให้เก็บค่าว่าตรวจได้
        if( $check_row === 0 ){
            $this->code[] = 'CBC-sso';
        }

    }

    private function test_ua($hn, $year_checkup){
        global $Conn;
        
        $sql = "SELECT * 
        FROM `orderhead_tmp` 
        WHERE ( `labcode`  = 'UA' OR `labcode`  = 'UA-sso' ) 
        AND `clinicalinfo` = 'ตรวจสุขภาพประจำปี$year_checkup' ";

        $q = mysql_query($sql, $Conn) or die( mysql_error() );
        $check_row = mysql_num_rows($q);
        
        if( $check_row === 0 ){
            $this->code[] = 'UA-sso';
        }

    }

    private function test_bs($hn, $year_checkup, $age){
        global $Conn;

        // 35-54 ทุกๆ3ปีตรวจได้ 1ครั้ง 
        $group_by = '';
        if( $age >= 35 && $age <= 54 ){

            // 3ปีย้อนหลัง
            // ที่ต้อง -2 เพราะเรานับปีตั้งต้นไปด้วย เช่น 60-2=58 จะได้ 58 59 60 ครบ 3 ปีพอดี
            $year_before = $year_checkup - 2;
            $clinical_range = array();
            for ($i=$year_before; $i <= $year_checkup; $i++) { 
                $clinical_range[] = " `clinicalinfo` = 'ตรวจสุขภาพประจำปี$i' ";
            }
            $clinical = "AND (".implode('OR', $clinical_range).")";

            $group_by = "GROUP BY `hn` ";

        // 55 ขึ้นไปตรวจได้ปีละครั้ง
        } else if ( $age >= 55 ){

            $clinical = "AND `clinicalinfo` = 'ตรวจสุขภาพประจำปี$year_checkup'";
            
        }

        $sql = "SELECT * 
        FROM `orderhead_tmp` 
        WHERE ( `labcode` = 'BS' OR `labcode` = 'BS-sso' ) 
        $clinical 
        $group_by";

        $q = mysql_query($sql, $Conn) or die( mysql_error() );
        $check_row = mysql_num_rows($q);
        if( $check_row === 0 ){
            $this->code[] = 'BS-sso';
        }

    }

    private function test_cr($hn, $year_checkup){
        global $Conn;

        $sql = "SELECT * 
        FROM `orderhead_tmp` 
        WHERE ( `labcode` = 'CR' OR `labcode` = 'CR-sso' ) 
        AND `clinicalinfo` = 'ตรวจสุขภาพประจำปี$year_checkup' ";

        $q = mysql_query($sql, $Conn) or die( mysql_error() );
        $check_row = mysql_num_rows($q);
        
        if( $check_row === 0 ){
            $this->code[] = 'CR-sso';
        }
    }

    // ไขมันในเส้นเลือด 20ปีขึ้นไป ทุกๆ5ปีตรวจได้ 1ครั้ง
    private function test_chol($hn, $year_checkup){
        global $Conn;

        $year_before = $year_checkup - 4;

        $clinical_range = array();
        for ($i=$year_before; $i <= $year_checkup; $i++) { 
            $clinical_range[] = " `clinicalinfo` = 'ตรวจสุขภาพประจำปี$i' ";
        }
        $clinical = "AND (".implode('OR', $clinical_range).")";

        $sql = "SELECT * 
        FROM `orderhead_tmp` 
        WHERE ( `labcode` = 'CHOL' OR `labcode` = 'CHOL-sso' ) 
        $clinical ";
        $q = mysql_query($sql, $Conn) or die( mysql_error() );
        $check_row = mysql_num_rows($q);
        
        if( $check_row === 0 ){
            $this->code[] = 'CHOL-sso';
        }
    }

    private function test_hdl($hn, $year_checkup){
        global $Conn;

        $year_before = $year_checkup - 4;

        $clinical_range = array();
        for ($i=$year_before; $i <= $year_checkup; $i++) { 
            $clinical_range[] = " `clinicalinfo` = 'ตรวจสุขภาพประจำปี$i' ";
        }
        $clinical = "AND (".implode('OR', $clinical_range).")";
        
        $sql = "SELECT * 
        FROM `orderhead_tmp` 
        WHERE ( `labcode` = 'HDL' OR `labcode` = 'HDL-sso' ) 
        $clinical ";

        $q = mysql_query($sql, $Conn) or die( mysql_error() );
        $check_row = mysql_num_rows($q);
        
        if( $check_row === 0 ){
            $this->code[] = 'HDL-sso';
        }
    }

    private function test_hbsag($hn, $year_checkup){
        global $Conn;
        $sql = "SELECT * 
        FROM `orderhead_tmp` 
        WHERE ( `labcode` = 'HBSAG' OR `labcode` = 'HBSAG-sso' ) 
        AND `clinicalinfo` LIKE 'ตรวจสุขภาพประจำปี%' ";
        $q = mysql_query($sql, $Conn) or die( mysql_error() );
        $check_row = mysql_num_rows($q);
        
        if( $check_row === 0 ){
            $this->code[] = 'HBSAG-sso';
        }
    }

    private function test_pap($hn, $year_checkup, $age, $sex){
        global $Conn;

        $group_by = '';
        if( $age >= 30 && $age <= 54 ){

            $year_before = $year_checkup - 2;

            $clinical_range = array();
            for ($i=$year_before; $i <= $year_checkup; $i++) { 
                $clinical_range[] = " `clinicalinfo` = 'ตรวจสุขภาพประจำปี$i' ";
            }
            $clinical = "AND (".implode('OR', $clinical_range).")";

            $group_by = "GROUP BY a.`hn` ";

        // 55 ขึ้นไปตรวจได้ปีละครั้ง
        } else if ( $age >= 55 ){

            $where = "AND a.`year_chk` = '$year_checkup' ";
            $clinical = "AND `clinicalinfo` = 'ตรวจสุขภาพประจำปี$year_checkup'";
            
        }
        
        $sql = "SELECT * 
        FROM `orderhead_tmp` 
        WHERE ( `labcode` = 'PAP' OR `labcode` = 'PAP-sso' ) 
        $clinical 
        $group_by ";
        $q = mysql_query($sql, $Conn);
        $check_row = mysql_num_rows($q);
        if( $check_row === 0 ){
            $this->code[] = 'PAP-sso';
        }
    }

    private function test_stocb($hn, $year_checkup){
        global $Conn;

        $sql = "SELECT * 
        FROM `orderhead_tmp` 
        WHERE ( `labcode` = 'STOCB' OR `labcode` = 'STOCB-sso' ) 
        `clinicalinfo` = 'ตรวจสุขภาพประจำปี$year_checkup' ";
        $q = mysql_query($sql, $Conn);
        $check_row = mysql_num_rows($q);
        if( $check_row === 0 ){
            $this->code[] = 'STOCB-sso';
        }
    }

    private function test_xray($hn, $year_checkup){
        global $Conn;

        $sql = "SELECT * 
        FROM `out_result_chkup` 
        WHERE `hn` = '$hn' 
        AND `year_chk` <= '$year_checkup' ";
        $q = mysql_query($sql, $Conn);
        $check_row = mysql_num_rows($q);
        
        if( $check_row === 0 ){
            $this->code[] = '41001-sso';
        }
    }

    // ตรวจสอบว่าสามารถตรวจอะไรได้บ้าง จากรายการที่อยากตรวจ
    public function check($package, $hn, $year_birth, $age, $sex){
        
        global $Conn;

        $age = (int) $age;
        $year_birth = (int) $year_birth;
        
        $this->checkup_list = array();
        $this->code = array();

        // ปีงบประมาณ
        $year_checkup = get_year_checkup();

        $this->create_cache_db($hn);

        // ความสมบูรณ์ของเม็ดเลือด
        if( in_array('CBC-sso', $package) === true && ( $age >= 18 && $age <= 70 ) ){
            $this->test_cbc($hn, $year_checkup, $age);
        }
        
        // ปัสสาวะ UA 55ปีขึ้นไป ตรวจได้ปีละครั้ง
        if( in_array('UA-sso', $package) === true && $age >= 55 ){
            $this->test_ua($hn, $year_checkup);
        }

        // น้ำตาลในเลือด
        if( in_array('BS-sso', $package) === true && $age >= 35 ){
            $this->test_bs($hn, $year_checkup, $age);
        }
        
        // การทำงานของไต CR 55ปีขึ้นไป ตรวจได้ปีละครั้ง
        if( in_array('CR-sso', $package) === true && $age >= 55 ){
            $this->test_cr($hn, $year_checkup);
        }
        
        // ไขมันในเส้นเลือด 20ปีขึ้นไป ทุกๆ5ปีตรวจได้ 1ครั้ง
        if( in_array('CHOL-sso', $package) === true && $age >= 20 ){
            $this->test_chol($hn, $year_checkup);
            
        }

        if( in_array('HDL-sso', $package) === true && $age >= 20 ){
            $this->test_hdl($hn, $year_checkup);
        }

        // ไวรัสตับอักเสบ เกิดก่อน 2535(1992) ตรวจได้ครั้งเดียวตลอดชีวิต
        if( in_array('HBSAG-sso', $package) === true && $year_birth < 2535 ){
            $this->test_hbsag($hn, $year_checkup);
        }
        
        // มะเร็งปากมดลูก 
        if( in_array('PAP-sso', $package) === true && $age >= 30 && $sex > 1 ){
            $this->test_pap($hn, $year_checkup, $age, $sex);
        }
        
        // 
        if( in_array('STOCB-sso', $package) === true && $age >= 50 ){
            $this->test_stocb($hn, $year_checkup);
        }
        
        if( in_array('41001-sso', $package) === true && $age >= 15 ){
            $this->test_xray($hn, $year_checkup);
        }
 
    }

    public function get_checkup_list(){
        return $this->checkup_list;
    }

    public function get_code(){
        return $this->code;
    }

    // แสดงรายการที่สามารถตรวจได้จาก อายุ
    public function find_package_from_age($hn, $year_birth, $age, $sex){

        $age = (int) $age;
        $year_birth = (int) $year_birth;
        
        $this->code = array();

        // ปีงบประมาณ
        $year_checkup = get_year_checkup();
        $this->create_cache_db($hn);

        // ความสมบูรณ์ของเม็ดเลือด
        if( $age >= 18 && $age <= 70 ){
            $this->test_cbc($hn, $year_checkup, $age);
        }

        // ปัสสาวะ UA 55ปีขึ้นไป ตรวจได้ปีละครั้ง
        if( $age >= 55 ){
            $this->test_ua($hn, $year_checkup);
        }

        // น้ำตาลในเลือด
        if( $age >= 35 ){
            $this->test_bs($hn, $year_checkup, $age);
        }
        
        // การทำงานของไต CR 55ปีขึ้นไป ตรวจได้ปีละครั้ง
        if( $age >= 55 ){
            $this->test_cr($hn, $year_checkup);
        }
        
        // ไขมันในเส้นเลือด 20ปีขึ้นไป ทุกๆ5ปีตรวจได้ 1ครั้ง
        if( $age >= 20 ){
            $this->test_chol($hn, $year_checkup);
            
        }

        if( $age >= 20 ){
            $this->test_hdl($hn, $year_checkup);
        }

        // ไวรัสตับอักเสบ เกิดก่อน 2535(1992) ตรวจได้ครั้งเดียวตลอดชีวิต
        if( $year_birth < 2535 ){
            $this->test_hbsag($hn, $year_checkup);
        }
        
        // มะเร็งปากมดลูก 
        if( $age >= 30 && $sex > 1 ){
            $this->test_pap($hn, $year_checkup, $age, $sex);
        }
        
        // 
        if( $age >= 50 ){
            $this->test_stocb($hn, $year_checkup);
        }
        
        if( $age >= 15 ){
            $this->test_xray($hn, $year_checkup);
        }

        // dump($this->code);
    }

    // ตามอายุ สามารถตรวจอะไรได้บ้าง
    // แต่ไม่ได้เช็กว่าเคยตรวจไปแล้วรึยัง
    public function get_checkup_from_age($age, $year_birth, $sex){

        $pre_checkup_list = array();

        // ความสมบูรณ์ของเม็ดเลือด 
        if( $age >= 18 && $age <= 70 ){
            $pre_checkup_list[] = 'CBC-sso';
        }

        // ปัสสาวะ UA 55ปีขึ้นไป ตรวจได้ปีละครั้ง
        if( $age >= 55 ){
            $pre_checkup_list[] = 'UA-sso';
        }

        // น้ำตาลในเลือด
        if( $age >= 35 ){
            $pre_checkup_list[] = 'BS-sso';
        }
        
        // การทำงานของไต CR 55ปีขึ้นไป ตรวจได้ปีละครั้ง
        if( $age >= 55 ){
            $pre_checkup_list[] = 'CR-sso';
        }
        
        // ไขมันในเส้นเลือด 20ปีขึ้นไป ทุกๆ5ปีตรวจได้ 1ครั้ง
        if( $age >= 20 ){
            $pre_checkup_list[] = 'CHOL-sso';
        }

        if( $age >= 20 ){
            $pre_checkup_list[] = 'HDL-sso';
        }

        // ไวรัสตับอักเสบ เกิดก่อน 2535(1992) ตรวจได้ครั้งเดียวตลอดชีวิต
        if( $year_birth < 2535 ){
            $pre_checkup_list[] = 'HBSAG-sso';
        }
        
        // มะเร็งปากมดลูก 
        if( $age >= 30 && $sex > 1 ){
            $pre_checkup_list[] = 'PAP-sso';
        }
        
        // 
        if( $age >= 50 ){
            $pre_checkup_list[] = 'STOCB-sso';
        }
        
        // X-RAY
        if( $age >= 15 ){
            $pre_checkup_list[] = '41001-sso';
        }

        return $pre_checkup_list;

    }

}
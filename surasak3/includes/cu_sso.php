<?php
/**
 * ������Ѻ������ 2560
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
        '�' => 'CR',
        '��ѹ' => 'LIPID',
        '�Ѻ�ѡ�ʺ' => 'HBSAG',
        'Pap Smear' => 'PAP',
        'Stool' => 'STOCB',
        'X-Ray' => '41001');
    }

    // �Ҫ��ͧ͢ lab
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

        // ����ᤪ������ ���� query Ẻ����ѹ���
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
        AND `clinicalinfo` LIKE '��Ǩ�آ�Ҿ��Шӻ�%'";
        */

        /**
         * @important �������ҹ������ 60 
         * !!! �Դ�ѭ�� !!! 
         * ��͢�������Һҧ����ѹŧ lab �ѹ˹�� ������ ��������������ա�ѹ˹�� ����Ҩ�е�ͧ��� orderhead ��͹
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
        AND a.`clinicalinfo` LIKE '��Ǩ�آ�Ҿ��Шӻ�%' 
        AND a.`hn` = '58-9016' ";
        */

        $sql = "CREATE TEMPORARY TABLE `orderhead_tmp` 
        SELECT a.`orderdate`,a.`hn`,a.`clinicalinfo`,b.* 
        FROM `orderhead` AS a 
        LEFT JOIN `orderdetail` AS b ON b.`labnumber` = a.`labnumber` 
        WHERE a.`orderdate` >= '2016-10-01' 
        AND a.`clinicalinfo` LIKE '��Ǩ�آ�Ҿ��Шӻ�%' 
        AND a.`hn` = '$hn' ";
        $this->call_temp = $sql;
        mysql_query($sql, $Conn) or die( mysql_error() );

    }

    private function test_cbc($hn, $year_checkup, $age){
        global $Conn;

        $clinical = '';
        // ��Ǩ�� 1 ����㹪�ǧ���� 18-54 ���
        if( $age >= 18 && $age <= 54 ){

            $clinical = "AND `clinicalinfo` LIKE '��Ǩ�آ�Ҿ��Шӻ�%' ";

        // 55-70 ��Ǩ����Ф���
        } else if ( $age >= 55 && $age <= 70 ){

            $clinical = "AND `clinicalinfo` = '��Ǩ�آ�Ҿ��Шӻ�$year_checkup' ";
            
        }

        $sql = "SELECT * 
        FROM `orderhead_tmp` 
        WHERE ( `labcode`  = 'CBC' OR `labcode`  = 'CBC-sso' ) 
        $clinical";
        $q = mysql_query($sql, $Conn) or die( mysql_error() );
        $check_row = mysql_num_rows($q);
        
        // �� 0 �ʴ���һչ���ѧ������Ǩ ����纤����ҵ�Ǩ��
        if( $check_row === 0 ){
            $this->code[] = 'CBC-sso';
        }

    }

    private function test_ua($hn, $year_checkup){
        global $Conn;
        
        $sql = "SELECT * 
        FROM `orderhead_tmp` 
        WHERE ( `labcode`  = 'UA' OR `labcode`  = 'UA-sso' ) 
        AND `clinicalinfo` = '��Ǩ�آ�Ҿ��Шӻ�$year_checkup' ";

        $q = mysql_query($sql, $Conn) or die( mysql_error() );
        $check_row = mysql_num_rows($q);
        
        if( $check_row === 0 ){
            $this->code[] = 'UA-sso';
        }

    }

    private function test_bs($hn, $year_checkup, $age){
        global $Conn;

        // 35-54 �ء�3�յ�Ǩ�� 1���� 
        $group_by = '';
        if( $age >= 35 && $age <= 54 ){

            // 3����͹��ѧ
            // ����ͧ -2 ������ҹѺ�յ�駵�仴��� �� 60-2=58 ���� 58 59 60 �ú 3 �վʹ�
            $year_before = $year_checkup - 2;
            $clinical_range = array();
            for ($i=$year_before; $i <= $year_checkup; $i++) { 
                $clinical_range[] = " `clinicalinfo` = '��Ǩ�آ�Ҿ��Шӻ�$i' ";
            }
            $clinical = "AND (".implode('OR', $clinical_range).")";

            $group_by = "GROUP BY `hn` ";

        // 55 ���仵�Ǩ����Ф���
        } else if ( $age >= 55 ){

            $clinical = "AND `clinicalinfo` = '��Ǩ�آ�Ҿ��Шӻ�$year_checkup'";
            
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
        AND `clinicalinfo` = '��Ǩ�آ�Ҿ��Шӻ�$year_checkup' ";

        $q = mysql_query($sql, $Conn) or die( mysql_error() );
        $check_row = mysql_num_rows($q);
        
        if( $check_row === 0 ){
            $this->code[] = 'CR-sso';
        }
    }

    // ��ѹ�������ʹ 20�բ��� �ء�5�յ�Ǩ�� 1����
    private function test_chol($hn, $year_checkup){
        global $Conn;

        $year_before = $year_checkup - 4;

        $clinical_range = array();
        for ($i=$year_before; $i <= $year_checkup; $i++) { 
            $clinical_range[] = " `clinicalinfo` = '��Ǩ�آ�Ҿ��Шӻ�$i' ";
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
            $clinical_range[] = " `clinicalinfo` = '��Ǩ�آ�Ҿ��Шӻ�$i' ";
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
        AND `clinicalinfo` LIKE '��Ǩ�آ�Ҿ��Шӻ�%' ";
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
                $clinical_range[] = " `clinicalinfo` = '��Ǩ�آ�Ҿ��Шӻ�$i' ";
            }
            $clinical = "AND (".implode('OR', $clinical_range).")";

            $group_by = "GROUP BY a.`hn` ";

        // 55 ���仵�Ǩ����Ф���
        } else if ( $age >= 55 ){

            $where = "AND a.`year_chk` = '$year_checkup' ";
            $clinical = "AND `clinicalinfo` = '��Ǩ�آ�Ҿ��Шӻ�$year_checkup'";
            
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
        `clinicalinfo` = '��Ǩ�آ�Ҿ��Шӻ�$year_checkup' ";
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

    // ��Ǩ�ͺ�������ö��Ǩ�������ҧ �ҡ��¡�÷����ҡ��Ǩ
    public function check($package, $hn, $year_birth, $age, $sex){
        
        global $Conn;

        $age = (int) $age;
        $year_birth = (int) $year_birth;
        
        $this->checkup_list = array();
        $this->code = array();

        // �է�����ҳ
        $year_checkup = get_year_checkup();

        $this->create_cache_db($hn);

        // ��������ó�ͧ������ʹ
        if( in_array('CBC-sso', $package) === true && ( $age >= 18 && $age <= 70 ) ){
            $this->test_cbc($hn, $year_checkup, $age);
        }
        
        // ������� UA 55�բ��� ��Ǩ����Ф���
        if( in_array('UA-sso', $package) === true && $age >= 55 ){
            $this->test_ua($hn, $year_checkup);
        }

        // ��ӵ������ʹ
        if( in_array('BS-sso', $package) === true && $age >= 35 ){
            $this->test_bs($hn, $year_checkup, $age);
        }
        
        // ��÷ӧҹ�ͧ� CR 55�բ��� ��Ǩ����Ф���
        if( in_array('CR-sso', $package) === true && $age >= 55 ){
            $this->test_cr($hn, $year_checkup);
        }
        
        // ��ѹ�������ʹ 20�բ��� �ء�5�յ�Ǩ�� 1����
        if( in_array('CHOL-sso', $package) === true && $age >= 20 ){
            $this->test_chol($hn, $year_checkup);
            
        }

        if( in_array('HDL-sso', $package) === true && $age >= 20 ){
            $this->test_hdl($hn, $year_checkup);
        }

        // ����ʵѺ�ѡ�ʺ �Դ��͹ 2535(1992) ��Ǩ��������ǵ�ʹ���Ե
        if( in_array('HBSAG-sso', $package) === true && $year_birth < 2535 ){
            $this->test_hbsag($hn, $year_checkup);
        }
        
        // ����移ҡ���١ 
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

    // �ʴ���¡�÷������ö��Ǩ��ҡ ����
    public function find_package_from_age($hn, $year_birth, $age, $sex){

        $age = (int) $age;
        $year_birth = (int) $year_birth;
        
        $this->code = array();

        // �է�����ҳ
        $year_checkup = get_year_checkup();
        $this->create_cache_db($hn);

        // ��������ó�ͧ������ʹ
        if( $age >= 18 && $age <= 70 ){
            $this->test_cbc($hn, $year_checkup, $age);
        }

        // ������� UA 55�բ��� ��Ǩ����Ф���
        if( $age >= 55 ){
            $this->test_ua($hn, $year_checkup);
        }

        // ��ӵ������ʹ
        if( $age >= 35 ){
            $this->test_bs($hn, $year_checkup, $age);
        }
        
        // ��÷ӧҹ�ͧ� CR 55�բ��� ��Ǩ����Ф���
        if( $age >= 55 ){
            $this->test_cr($hn, $year_checkup);
        }
        
        // ��ѹ�������ʹ 20�բ��� �ء�5�յ�Ǩ�� 1����
        if( $age >= 20 ){
            $this->test_chol($hn, $year_checkup);
            
        }

        if( $age >= 20 ){
            $this->test_hdl($hn, $year_checkup);
        }

        // ����ʵѺ�ѡ�ʺ �Դ��͹ 2535(1992) ��Ǩ��������ǵ�ʹ���Ե
        if( $year_birth < 2535 ){
            $this->test_hbsag($hn, $year_checkup);
        }
        
        // ����移ҡ���١ 
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

    // ������� ����ö��Ǩ�������ҧ
    // �������������µ�Ǩ��������ѧ
    public function get_checkup_from_age($age, $year_birth, $sex){

        $pre_checkup_list = array();

        // ��������ó�ͧ������ʹ 
        if( $age >= 18 && $age <= 70 ){
            $pre_checkup_list[] = 'CBC-sso';
        }

        // ������� UA 55�բ��� ��Ǩ����Ф���
        if( $age >= 55 ){
            $pre_checkup_list[] = 'UA-sso';
        }

        // ��ӵ������ʹ
        if( $age >= 35 ){
            $pre_checkup_list[] = 'BS-sso';
        }
        
        // ��÷ӧҹ�ͧ� CR 55�բ��� ��Ǩ����Ф���
        if( $age >= 55 ){
            $pre_checkup_list[] = 'CR-sso';
        }
        
        // ��ѹ�������ʹ 20�բ��� �ء�5�յ�Ǩ�� 1����
        if( $age >= 20 ){
            $pre_checkup_list[] = 'CHOL-sso';
        }

        if( $age >= 20 ){
            $pre_checkup_list[] = 'HDL-sso';
        }

        // ����ʵѺ�ѡ�ʺ �Դ��͹ 2535(1992) ��Ǩ��������ǵ�ʹ���Ե
        if( $year_birth < 2535 ){
            $pre_checkup_list[] = 'HBSAG-sso';
        }
        
        // ����移ҡ���١ 
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
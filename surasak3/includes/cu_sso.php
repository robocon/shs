<?php
/**
 * ������Ѻ������ 2560
 */

/**
 * 
 *
 */

include_once 'includes/functions.php';

class CU_SSO{
    
    public $checkup_list = array();
    public $code = array();

    public $lab_name = array();

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

    private function create_cache_db(){
        global $Conn;

        // ����ᤪ������ ���� query Ẻ����ѹ���
        $sql = "CREATE TEMPORARY TABLE `out_result_chkup_tmp` 
        SELECT * 
        FROM `out_result_chkup` 
        WHERE `hn` = '$hn' ";
        mysql_query($sql, $Conn);

        $sql = "CREATE TEMPORARY TABLE `resulthead_tmp` 
        SELECT * 
        FROM `resulthead` 
        WHERE `hn` = '$hn' 
        AND `clinicalinfo` LIKE '��Ǩ�آ�Ҿ��Шӻ�%'";
        mysql_query($sql, $Conn);
    }

    private function test_cbc($year_checkup, $age, $sex){
        global $Conn;

        $clinical = '';
        // ��Ǩ�� 1 ����㹪�ǧ���� 18-54 ���
        if( $age >= 18 && $age <= 54 ){

            $where = "AND a.`year_chk` <= '$year_checkup' ";
            $clinical = "AND b.`clinicalinfo` LIKE '��Ǩ�آ�Ҿ��Шӻ�%' ";

        // 55-70 ��Ǩ����Ф���
        } else if ( $age >= 55 && $age <= 70 ){

            $where = "AND a.`year_chk` = '$year_checkup' ";
            $clinical = "AND b.`clinicalinfo` = '��Ǩ�آ�Ҿ��Шӻ�$year_checkup' ";
            
        }

        // 㹻է�����Ǩ��������ѧ
        $sql = "SELECT b.`hn`  
        FROM `out_result_chkup_tmp` AS a 
        LEFT JOIN `resulthead_tmp` AS b ON b.`hn` = a.`hn` 
        WHERE a.`hn` = '$hn' 
        $where 
        $clinical
        AND b.`profilecode` = 'CBC'";
        $q = mysql_query($sql, $Conn);
        $check_row = mysql_num_rows($q);
        
        // �� 0 �ʴ���һչ���ѧ������Ǩ ����纤����ҵ�Ǩ��
        if( $check_row === 0 ){
            $this->code[] = 'CBC-sso';
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

        $this->create_cache_db();

        // ��������ó�ͧ������ʹ
        if( in_array('CBC-sso', $package) === true && ( $age >= 18 && $age <= 70 ) ){
            // $this->checkup_list[] = '��������ó�ͧ������ʹ CBC'."<br>";

            $this->test_cbc($year_checkup, $age, $sex);
        }
        
        // ������� UA 55�բ��� ��Ǩ����Ф���
        if( in_array('UA-sso', $package) === true && $age >= 55 ){
            // $this->checkup_list[] = '������� UA'."<br>";

            $sql = "SELECT b.`hn`  
            FROM `out_result_chkup_tmp` AS a 
            LEFT JOIN `resulthead_tmp` AS b ON b.`hn` = a.`hn` AND b.`clinicalinfo` = '��Ǩ�آ�Ҿ��Шӻ�$year_checkup'
            WHERE a.`hn` = '$hn' 
            AND a.`year_chk` = '$year_checkup' 
            AND b.`profilecode` = 'UA'";
            
            $q = mysql_query($sql, $Conn);
            $check_row = mysql_num_rows($q);
            
            if( $check_row === 0 ){
                $this->code[] = 'UA-sso';
            }
        }

        // ��ӵ������ʹ
        if( in_array('BS-sso', $package) === true && $age >= 35 ){
            // $this->checkup_list[] = '��ӵ������ʹ FBS'."<br>";

            // 35-54 �ء�3�յ�Ǩ�� 1���� 
            $group_by = '';
            if( $age >= 35 && $age <= 54 ){

                // 3����͹��ѧ
                // ����ͧ -2 ������ҹѺ�յ�駵�仴��� �� 60-2=58 ���� 58 59 60 �ú 3 �վʹ�
                $year_before = $year_checkup - 2;
                $where = "AND ( a.`year_chk` >= '$year_before' AND a.`year_chk` <= '$year_checkup' ) ";

                $clinical_range = array();
                for ($i=$year_before; $i <= $year_checkup; $i++) { 
                    $clinical_range[] = " b.`clinicalinfo` = '��Ǩ�آ�Ҿ��Шӻ�$i' ";
                }
                $clinical = "AND (".implode('OR', $clinical_range).")";

                $group_by = "GROUP BY a.`hn` ";

            // 55 ���仵�Ǩ����Ф���
            } else if ( $age >= 55 ){

                $where = "AND a.`year_chk` = '$year_checkup' ";
                $clinical = "AND b.`clinicalinfo` = '��Ǩ�آ�Ҿ��Шӻ�$year_checkup'";
                
            }

            $sql = "SELECT b.`hn`  
            FROM `out_result_chkup_tmp` AS a 
            LEFT JOIN `resulthead_tmp` AS b ON b.`hn` = a.`hn` 
            WHERE a.`hn` = '$hn' 
            $where 
            $clinical 
            AND b.`profilecode` = 'BS' 
            $group_by";
            
            $q = mysql_query($sql, $Conn);
            $check_row = mysql_num_rows($q);
            if( $check_row === 0 ){
                $this->code[] = 'BS-sso';
            }
        }
        
        // ��÷ӧҹ�ͧ� CR 55�բ��� ��Ǩ����Ф���
        if( in_array('CR-sso', $package) === true && $age >= 55 ){
            // $this->checkup_list[] = '��÷ӧҹ�ͧ� Cr'."<br>";

            $sql = "SELECT b.`hn`  
            FROM `out_result_chkup_tmp` AS a 
            LEFT JOIN `resulthead_tmp` AS b ON b.`hn` = a.`hn` AND b.`clinicalinfo` = '��Ǩ�آ�Ҿ��Шӻ�$year_checkup'
            WHERE a.`hn` = '$hn' 
            AND a.`year_chk` = '$year_checkup' 
            AND b.`profilecode` = 'CR'";
            $q = mysql_query($sql, $Conn);
            $check_row = mysql_num_rows($q);
            
            if( $check_row === 0 ){
                $this->code[] = 'CR-sso';
            }

        }
        
        // ��ѹ�������ʹ 20�բ��� �ء�5�յ�Ǩ�� 1����
        if( in_array('CHOL-sso', $package) === true && $age >= 20 ){
            // $this->checkup_list[] = '��ѹ�������ʹ��Դ Total & HDL cholesterol'."<br>";

            $year_before = $year_checkup - 4;
            $where = "AND ( a.`year_chk` >= '$year_before' AND a.`year_chk` <= '$year_checkup' ) ";

            $clinical_range = array();
            for ($i=$year_before; $i <= $year_checkup; $i++) { 
                $clinical_range[] = " b.`clinicalinfo` = '��Ǩ�آ�Ҿ��Шӻ�$i' ";
            }
            $clinical = "AND (".implode('OR', $clinical_range).")";

            $sql = "SELECT b.`hn`  
            FROM `out_result_chkup_tmp` AS a 
            LEFT JOIN `resulthead_tmp` AS b ON b.`hn` = a.`hn` 
            WHERE a.`hn` = '$hn' 
            $where 
            $clinical 
            AND b.`profilecode` = 'CHOL' 
            GROUP BY a.`hn` ";
            
            $q = mysql_query($sql, $Conn);
            $check_row = mysql_num_rows($q);
            
            if( $check_row === 0 ){
                $this->code[] = 'CHOL-sso';
            }
        }

        if( in_array('HDL-sso', $package) === true && $age >= 20 ){
            // $this->checkup_list[] = '��ѹ�������ʹ��Դ Total & HDL cholesterol'."<br>";

            $year_before = $year_checkup - 4;
            $where = "AND ( a.`year_chk` >= '$year_before' AND a.`year_chk` <= '$year_checkup' ) ";

            $clinical_range = array();
            for ($i=$year_before; $i <= $year_checkup; $i++) { 
                $clinical_range[] = " b.`clinicalinfo` = '��Ǩ�آ�Ҿ��Шӻ�$i' ";
            }
            $clinical = "AND (".implode('OR', $clinical_range).")";

            $sql = "SELECT b.`hn`  
            FROM `out_result_chkup_tmp` AS a 
            LEFT JOIN `resulthead_tmp` AS b ON b.`hn` = a.`hn` 
            WHERE a.`hn` = '$hn' 
            $where 
            $clinical 
            AND b.`profilecode` = 'HDL' 
            GROUP BY a.`hn` ";
            
            $q = mysql_query($sql, $Conn);
            $check_row = mysql_num_rows($q);
            
            if( $check_row === 0 ){
                $this->code[] = 'HDL-sso';
            }
        }

        // ����ʵѺ�ѡ�ʺ �Դ��͹ 2535(1992) ��Ǩ��������ǵ�ʹ���Ե
        if( in_array('HBSAG-sso', $package) === true && $year_birth < 2535 ){
            // $this->checkup_list[] = '��������ʵѺ�ѡ�ʺ HBsAg'."<br>";

            $sql = "SELECT b.`hn`  
            FROM `out_result_chkup_tmp` AS a 
            LEFT JOIN `resulthead_tmp` AS b ON b.`hn` = a.`hn` 
            WHERE a.`hn` = '$hn' 
            AND b.`clinicalinfo` = '��Ǩ�آ�Ҿ��Шӻ�%' 
            AND a.`year_chk` <= '$year_checkup' 
            AND b.`profilecode` = 'HBSAG' 
            GROUP BY b.`hn` ";
            $q = mysql_query($sql, $Conn);
            $check_row = mysql_num_rows($q);
            
            if( $check_row === 0 ){
                $this->code[] = 'HBSAG-sso';
            }

        }
        
        // ����移ҡ���١ 
        if( in_array('PAP-sso', $package) === true && $age >= 30 && $sex > 1 ){
            // $this->checkup_list[] = '����移ҡ���١ Pap Smear'."<br>";
            
            $group_by = '';
            if( $age >= 30 && $age <= 54 ){

                $year_before = $year_checkup - 2;
                $where = "AND ( a.`year_chk` >= '$year_before' AND a.`year_chk` <= '$year_checkup' ) ";

                $clinical_range = array();
                for ($i=$year_before; $i <= $year_checkup; $i++) { 
                    $clinical_range[] = " b.`clinicalinfo` = '��Ǩ�آ�Ҿ��Шӻ�$i' ";
                }
                $clinical = "AND (".implode('OR', $clinical_range).")";

                $group_by = "GROUP BY a.`hn` ";

            // 55 ���仵�Ǩ����Ф���
            } else if ( $age >= 55 ){

                $where = "AND a.`year_chk` = '$year_checkup' ";
                $clinical = "AND b.`clinicalinfo` = '��Ǩ�آ�Ҿ��Шӻ�$year_checkup'";
                
            }

            $sql = "SELECT b.`hn`  
            FROM `out_result_chkup_tmp` AS a 
            LEFT JOIN `resulthead_tmp` AS b ON b.`hn` = a.`hn` 
            WHERE a.`hn` = '$hn' 
            $where 
            $clinical 
            AND b.`profilecode` = 'PAP' 
            $group_by";
            
            $q = mysql_query($sql, $Conn);
            $check_row = mysql_num_rows($q);
            if( $check_row === 0 ){
                $this->code[] = 'PAP-sso';
            }
        }
        
        // 
        if( in_array('STOCB-sso', $package) === true && $age >= 50 ){
            // $this->checkup_list[] = '���ʹ��ب���� FOBT'."<br>";

            $sql = "SELECT b.`hn`  
            FROM `out_result_chkup_tmp` AS a 
            LEFT JOIN `resulthead_tmp` AS b ON b.`hn` = a.`hn` AND b.`clinicalinfo` = '��Ǩ�آ�Ҿ��Шӻ�$year_checkup'
            WHERE a.`hn` = '$hn' 
            AND a.`year_chk` = '$year_checkup' 
            AND b.`profilecode` = 'STOCB'";
            $q = mysql_query($sql, $Conn);
            $check_row = mysql_num_rows($q);
            
            if( $check_row === 0 ){
                $this->code[] = 'STOCB-sso';
            }
        }
        
        if( in_array('41001-sso', $package) === true && $age >= 15 ){
            // $this->checkup_list[] = 'Chest X-ray'."<br>";

            $sql = "SELECT b.`hn`  
            FROM `out_result_chkup_tmp` AS a 
            LEFT JOIN `depart` AS b ON b.`hn` = a.`hn` AND b.`depart` = 'XRAY'
            WHERE a.`hn` = '$hn' 
            AND a.`year_chk` <= '$year_checkup' 
            GROUP BY b.`hn` ";
            $q = mysql_query($sql, $Conn);
            $check_row = mysql_num_rows($q);
            
            if( $check_row === 0 ){
                $this->code[] = '41001-sso';
            }
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
        $this->create_cache_db();

        // ��������ó�ͧ������ʹ
        if( $age >= 18 && $age <= 70 ){
            $this->test_cbc($year_checkup, $age, $sex);
        }

        var_dump($this->code);
    }

}
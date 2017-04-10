<?php
/**
 * ������Ѻ������ 2560
 */

/**
 * 
 *
 */
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



    public function check($package, $age, $sex){
        
        global $Conn;

        $age = (int) $age;
        
        $this->checkup_list = array();
        $this->code = array();

        // $list = array();

        // $lab = $this->get_lab_name();

        if( in_array('CBC', $package) === true && ( $age >= 18 && $age <= 70 ) ){
            // $this->checkup_list[] = '��������ó�ͧ������ʹ CBC'."<br>";
            // $this->code[] = 'CBC';
            
            // var_dump($test);

            $item = array(
                'code' => 'CBC',
                'detail' => $lab['CBC'],
                // 'price' => 
            );

            $list[] = $item;

        }

        $wanted = array('14001','CBC');
        $can_checked = array('14001','CBC','LIPID');
        var_dump(array_diff($wanted, $can_checked));
        exit;




        if( $age >= 55 ){
            $this->checkup_list[] = '������� UA'."<br>";
            $this->code[] = 'UA';
        }

        if( $age >= 35 && $age <= 55 ){
            $this->checkup_list[] = '��ӵ������ʹ FBS'."<br>";
            $this->code[] = 'BS';
        }

        if( $age >= 55 ){
            $this->checkup_list[] = '��÷ӧҹ�ͧ� Cr'."<br>";
            $this->code[] = 'CR';
        }

        if( $age >= 20 ){
            $this->checkup_list[] = '��ѹ�������ʹ��Դ Total & HDL cholesterol'."<br>";
            $this->code[] = 'LIPID';
        }

        if( $age >= 25 ){
            $this->checkup_list[] = '��������ʵѺ�ѡ�ʺ HBsAg'."<br>";
            $this->code[] = 'HBSAG';
        }

        if( $age >= 30 && $sex > 1 ){
            $this->checkup_list[] = '����移ҡ���١ Pap Smear'."<br>";
            $this->checkup_list[] = '����移ҡ���١ Via'."<br>";

            $this->code[] = 'PAP';
            
        }

        if( $age >= 50 ){
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

    public function get_list(){

    }

}
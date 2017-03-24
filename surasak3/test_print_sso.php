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
            $this->checkup_list[] = '��õ�Ǩ���¤������Ţͧ�ѡ��ᾷ��'."<br>";
            
        }

        if( $age >= 55 ){
            $this->checkup_list[] = '��õ�Ǩ��µҴ��� snellen eye chart'."<br>";
            
        }

        if( $age >= 18 && $age <= 70 ){
            $this->checkup_list[] = '��������ó�ͧ������ʹ CBC'."<br>";
            $this->code[] = 'CBC';
        }

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
            $this->code[] = 'BUN';
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
 * �͡��§ҹ
 *
 */
$sso = new cu_sso();

$db = Mysql::load();
$sql = "SELECT * FROM smdb.opcardchk where part = '�١��ҧ60' and active = 'y';";
$db->select($sql);

$items = $db->get_items();

foreach ($items as $key => $item) {
    
    
    if( mb_strpos($item['name'], '���') !== false ){
        $item['sex'] = 1;
    }else if( mb_strpos($item['name'], '�ҧ') !== false ){
        $item['sex'] = 2;
    }else if( mb_strpos($item['name'], '�.�.') !== false ){
        $item['sex'] = 3;
    }

    echo $item['HN'].' ����:'.$item['agey'].'�� '.$item['name'].' '.$item['surname'];
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
    echo '�鴷���Ǩ '.implode(',', $code_list);
    echo "<hr>";
}


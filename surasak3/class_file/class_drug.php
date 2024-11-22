<?php 
require_once dirname(__FILE__).'/database.php';

class Drug extends DbConnect{

    public $dbi = null;
    private $dateTh = null;
    public function __construct()
    {
        parent::__construct();
        $this->dateTh = (date('Y')+543).date('-m-d');
    }

    public function getDruglst($code=null, $fields=array()){

        $where = "";
        if (!empty($code)) {
            $where = "WHERE drugcode = '$code' ";
        }

        $field = '*';
        if(!empty($fields)){
            $field = implode(',', $fields);
        }

        $q = $this->dbi->query("SELECT $field FROM druglst $where");
        $rows = $q->num_rows;
        if($rows===1){
            $res = $q->fetch_assoc();
        }elseif($rows>1){
            $items = array();
            while ($a = $q->fetch_assoc()) {
                $items[] = $a;
            }
            $res = $items;
        }else{
            $res = $this->dbError();
        }

        return $res;
    }

    public function getTodayDPhardepFromHn($hn=null){
        if(empty($hn)){
            return "Invalid HN";
        }
        $res = false;
        $sql = sprintf("SELECT * FROM `dphardep` WHERE `date` LIKE '$this->dateTh%%' AND `hn` = '%s'", $hn);
        $q = $this->dbi->query($sql);
        if ($this->dbi->error) {
            $res = array('error'=>true,'msg'=>$this->dbi->error);
        }else{
            if($q->num_rows>0){
                $items = array();
                while ($a = $q->fetch_assoc()) {
                    $items[] = $a;
                }
                $res = $items;
            }else{
                $res = array('msg'=>'ไม่พบข้อมูล');
            }
        }
        return $res;
    }
}
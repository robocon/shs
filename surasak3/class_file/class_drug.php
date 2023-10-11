<?php 
require_once dirname(__FILE__).'/database.php';
class Drug extends DbConnect{
    public $dbi = null;
    function __construct()
    {
        parent::__construct();
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
}
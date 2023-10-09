<?php 
require_once __DIR__.'/database.php';
class Drugreact extends DbConnect{
    public $dbi = null;
    function __construct()
    {
        parent::__construct();
    }

    public function getDrugreactFromHn($hn=null){
        if (empty($hn)) {
            return "HN is Required";
        }

        $hn = sprintf("%s", $hn);
        $q = $this->dbi->query("SELECT * FROM drugreact WHERE hn = '$hn' ");
        if ($q->num_rows>0) {
            $items = array();
            while ($a = $q->fetch_assoc()) {
                $items[] = $a;
            }
            $res = $items;
        }else{
            $res = array("error"=>"400", "message"=>"Data not found ".$this->dbi->error);

        }
        
        return $res;
    }
}
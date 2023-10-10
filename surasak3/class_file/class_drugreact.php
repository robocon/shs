<?php 
require_once __DIR__.'/database.php';
class Drugreact extends DbConnect{
    public $dbi = null;
    function __construct()
    {
        parent::__construct();
    }

    /**
     * @param string $hn        เลขที่ HN ของผู้มารับบริการ
     * @param string $fields    Default เป็น * คือการเลือกทุกฟิลด์ แต่ถ้าต้องการเลือกเฉพาะฟิลด์ให้ใส่มาเป็น Array
     * @param string $where     คำสั่ง where เงื่อนไขเพิ่มเติม
     * @param string $group     คำสั่ง group by xxx กรณีที่ต้องการ group ตามกลุ่ม
     */
    public function getDrugreactFromHn($hn=null, $fields=array(), $where=null, $group=null){
        if (empty($hn)) {
            return "HN is Required";
        }

        $hn = sprintf("%s", $hn);
        $where = sprintf("%s", $where);
        $group = sprintf("%s", $group);

        $field = '*';
        if(!empty($fields)){
            $field = implode(',', $fields);
        }

        $q = $this->dbi->query("SELECT $field FROM drugreact WHERE hn = '$hn' $where $group");
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

    public function getGroupNameFromHn($hn=null){
        if(empty($hn)){
            return "HN is Required";
        }
        $q = $this->dbi->query("SELECT groupname FROM drugreact WHERE hn = '$hn' AND groupname <> '' GROUP BY groupname ");
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

    public function getDrugreactInGroupRelation($hn=null){

        if (empty($hn)) {
            return "HN is Required";
        }

        $sql="SELECT b.* FROM ( 
            SELECT `groupname` FROM `drugreact` WHERE `hn` = '$hn' AND `groupname` != '' GROUP BY `groupname`
        ) AS a 
        LEFT JOIN `drugreact_group` AS c ON c.`name` = a.`groupname`
        LEFT JOIN `drugreact_group_list` AS b ON c.`id` = b.`drugreact_group` 
        WHERE b.drugcode NOT IN (SELECT `drugcode` FROM `drugreact` WHERE `hn` = '$hn' AND drugcode != '' GROUP BY drugcode)";
        $q = $this->dbi->query($sql);
        if($q->num_rows>0){ 
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
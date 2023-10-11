<?php 
require_once dirname(__FILE__).'/database.php';
class Drugreact extends DbConnect{
    public $dbi = null;
    function __construct()
    {
        parent::__construct();
    }

    /**
     * @param string $hn        เลขที่ HN ของผู้มารับบริการ
     * @param mixed $fields    Default เป็น * คือการเลือกทุกฟิลด์ แต่ถ้าต้องการเลือกเฉพาะฟิลด์ให้ใส่มาเป็น Array
     * @param string $where     คำสั่ง where ใส่เป็น AND ต่อท้ายมาได้เลย Ex. AND groupname <> ''
     * @param string $group     คำสั่ง group by xxx กรณีที่ต้องการ group ตามกลุ่ม Ex. GROUP BY groupname
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

    /**
     * หา groupname จาก hn ก่อน จากนั้นค่อยเอาไป Join กับ drugreact_group_list อีกทีว่ามียาตัวไหนในกลุ่มที่มีโอกาสแพ้บ้าง
     * โดยตัดยาที่ซ้ำกับ drugreact ออกไป
     * 
     * @param string $hn 
     * @return mixed $res 
     */
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

    /**
     * แสดงชื่อกลุ่มที่มีโอกาสแพ้ยาทั้งหมด ถ้าต้องการเฉพาะชื่อนั้นๆให้กำหนดชื่อเข้าไป
     * 
     * @param string $name ชื่อที่ต้องการค้นหา
     * @return mixed $res   
     */
    public function getDrugreactGroup($name=null){
        
        $where = "";
        if(!empty($name)){ 
            $name = sprintf("%s", $name);
            $where = "WHERE name = '$name' ";
        }

        $q = $this->dbi->query("SELECT * FROM drugreact_group $where");
        $rows = $q->num_rows;
        if ($rows==1) {
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

    /**
     * ค้นหาว่า hn ที่ส่งมามีแพ้ยาตามกลุ่มรึป่าวโดยจะ return เป็น id กับชื่อกลับไป
     * @param string $hn 
     * @return mixed $groupLists
     */
    public function getDrugreactGroupByHn($hn=null){

        if(empty($hn)){
            return "HN is required";
        }

        $userGroups = $this->getDrugreactFromHn($hn, array('groupname'), "AND groupname <> ''", 'GROUP BY groupname');
        $groupLists = array();
        foreach ($userGroups as $v) {
            $g = $this->getDrugreactGroup($v['groupname']);
            $groupLists[] = $g;
        }

        if(empty($groupLists)){
            $groupLists = $this->dbError();
        }

        return $groupLists;

    }

    /**
     * รายการยาตามกลุ่มที่แพ้จาก drugreact_group
     * @param string $id    เลขของฟิลด์ drugreact_group
     * @return mixed $res
     */
    public function getDrugreactGroupList($id=null){
        $id = sprintf("%s", $id);
        $where = "";
        if(!empty($id)){
            $where = "WHERE drugreact_group = '$id' ";
        }

        $q = $this->dbi->query("SELECT * FROM drugreact_group_list $where ");
        $rows = $q->num_rows;
        if($rows==1){
            $res = $q->fetch_assoc();
        }elseif ($rows>1) {
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
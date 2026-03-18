<?php 
class Drug extends Database
{

    public $dbi = null;
    private $dateTh = null;
    private $drugItems = array();
    private $item = 0;
    public function __construct()
    {
        parent::__construct();
        $this->dateTh = (date('Y')+543).date('-m-d');
    }

    public function getDoctorOrderItem(){
        return $this->drugItems;
    }

    public function getItem(){
        return $this->item;
    }

    /**
     * ดึงข้อมูลจากตาราง druglst
     * @param string $code รหัสยา
     * @param array $fields รายการฟิลด์ที่ต้องการดึง
     * @return array
     */
    public function getDruglst($code=null, $fields=array()){

        $where = "";
        if (!empty($code)) {
            $where = "WHERE drugcode = '$code' ";
        }

        $field = '*';
        if(!empty($fields)){
            $field = implode(',', $fields);
        }
        $res = array();
        $q = $this->dbi->query("SELECT $field FROM `druglst` $where");
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
            $res = $q->errorMessage;
        }

        return $res;
    }

    /**
     * @param string $t โค้ดยา
     * @param array $fields ฟิลด์ที่ต้องการ ถ้าไม่ใส่จะมีค่า default เป็น row_id, drugcode, tradname, genname
     * @return array
     */
    public function findLikeDrugcode($t='', $fields=array()){
        if(empty($fields)){
            $fieldSelect = "`row_id`,`drugcode`,`tradname`,`genname`";
        }else{
            $fieldSelect = implode(',', $fields);
        }
        $sql = sprintf("SELECT $fieldSelect FROM `druglst` WHERE `drugcode` LIKE '%%%s%%' AND `tradname` LIKE '%%%s%%' AND `genname` LIKE '%%%s%%' ",
            $this->dbi->real_escape_string($t),
            $this->dbi->real_escape_string($t),
            $this->dbi->real_escape_string($t)
        );
        $q = $this->dbi->query($sql);
        if($q->num_rows>0){
            while ($a = $q->fetch_assoc()) {
                $res[] = $a;
            }
        }else{
            $res = false;
        }
        return $res;
    }

    /**
     * ดึงข้อมูลจากตาราง dphardep
     * @param string $hn รหัส HN
     * @return array
     */
    public function getTodayDPhardepFromHn($hn=null){
        if(empty($hn)){
            return "Invalid HN";
        }
        $res = false;
        $thDate = $this->getThDate();
        $sql = sprintf("SELECT * FROM `dphardep` WHERE `date` LIKE '$thDate%%' AND `hn` = '%s'", $hn);
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

    /**
     * 
     */
    public function setNewRunno(){
        $q_runno = $this->dbi->query("SELECT `title`,`prefix`,`runno` FROM `runno` WHERE `title` = 'phardep'");
        $runno_row = $q_runno->fetch_assoc();
		$chktranx = $runno_row['runno'];
		$chktranx++;
        
        $this->dbi->query("UPDATE `runno` SET `runno` = '$chktranx' WHERE `title`='phardep'");
        return $chktranx;
    }

    public function addPhardep($data){ 

        // $chktranx = $this->setNewRunno();

//         $query = "INSERT INTO phardep(chktranx,date,ptname,hn,price,doctor,item,
// idname,diag,essd,nessdy,nessdn,dpy,dpn,dsy,dsn,tvn,ptright, phapt,datedr)VALUES('".$_SESSION["sChktranx"]."','$Thidate','$cPtname','$cHn',
// '$Netprice','$cDoctor','$item','$sOfficer','".jschars($cDiag)."','$Essd','$Nessdy',
// '$Nessdn','$DPY','$DPN','$DSY','$DSN','$tvn','$cPtright','$sOfficer','$dr_date');";



        $res = false;
        $fields = array('chktranx','date','ptname','hn','an','price','doctor','item','idname','diag','essd','nessdy','nessdn','dpy','dpn','dsy','dsn','tvn','ptright','phapt','datedr');
        $values = array();
        foreach ($fields as $f) {
            $values[] = isset($data[$f]) ? $this->dbi->real_escape_string : '';
        }
        $sql = sprintf("INSERT INTO `dphardep` (`%s`) VALUES ('%s')", implode('`,`', $fields), implode("','", $values));
        dump($sql);
        // $q = $this->dbi->query($sql);
        // if ($this->dbi->error) {
        //     $res = array('error'=>true,'msg'=>$this->dbi->error);
        // }else{
        //     $res = array('msg'=>'บันทึกข้อมูลเรียบร้อย');
        // }
        // return $res;
    }

    public function addDPhardep(){

        // $sql = "INSERT INTO dphardep(
        // chktranx,date,ptname,hn,price,
        // doctor,item,idname,diag,essd,
        // nessdy,nessdn,dpy,dpn,dsy,
        // dsn,tvn,ptright,whokey,kew)
        // VALUES
        // ('".$nRunno."','".$Thidate."','".$Ptname."','".$_SESSION["hn_now"]."','".$Netprice."','".$_SESSION["dt_doctor"]."','".$_POST["totalitem"]."','".$_SESSION["sOfficer"]."','".jschars($_SESSION["dt_diag"])."','".$pricetype["DDL1"]."','".$pricetype["DDY1"]."','".$pricetype["DDN1"]."','".$pricetype["DPY1"]."','".$pricetype["DPN1"]."','".$pricetype["DSY1"]."','".$pricetype["DSN1"]."','".$_SESSION["vn_now"]."','".$_SESSION["ptright_now"]."','DR','".$kew."');";
	
    }

    public function getItemsFromCode($doctorOrder = array()){
        $d = array();
        $this->item = count($doctorOrder);
        foreach ($doctorOrder as $k => $v) {
            $this->drugItems[] = $d[] = $this->getDruglst($v['drugcode']);
        }
        return $d;
    }

    public function setPriceDruglst($doctorOrder = null){
        $allPrice = 0;
        foreach ($this->drugItems as $k => $v) { 
            $price = ($v['salepri'] * $doctorOrder[$k]['amount']);
            $this->drugItems[$k]['price'] = $price;
            $allPrice += $price;
        }
        return $allPrice;
    }

    public function setSlCodeDruglst($doctorOrder = null){
        foreach ($this->drugItems as $k => $v) { 
            $sql = sprintf("SELECT `slcode`,`detail1`,`detail2`,`detail3`,`detail4` FROM `drugslip` WHERE `slcode` = '%s' ", $this->dbi->real_escape_string($doctorOrder[$k]['slcode']));
            $q = $this->dbi->query($sql);
            if($q->num_rows>0){
                $res = $q->fetch_assoc();
                $this->drugItems[$k]['slcode'] = $res['slcode'];
                $this->drugItems[$k]['detail1'] = $res['detail1'];
                $this->drugItems[$k]['detail2'] = $res['detail2'];
                $this->drugItems[$k]['detail3'] = $res['detail3'];
                $this->drugItems[$k]['detail4'] = $res['detail4'];

                $detail = $res['detail1'];
                if(!empty($res['detail2'])){
                    $detail .= ' '.$res['detail2'];
                }
                if(!empty($res['detail3'])){
                    $detail .= ' '.$res['detail3'];
                }
                if(!empty($res['detail4'])){
                    $detail .= ' '.$res['detail4'];
                }
                $this->drugItems[$k]['detail'] = $detail;
            }
        }
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
        WHERE b.drugcode NOT IN (SELECT `drugcode` FROM `drugreact` WHERE `hn` = '$hn' AND drugcode != '' AND advreact != '' AND g6pd IS NULL  GROUP BY drugcode)";
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
            $res = $q->errorMessage;
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
        
        if(!$userGroups['error']){
            foreach ($userGroups as $v) {
                $g = $this->getDrugreactGroup($v['groupname']);
                $groupLists[] = $g;
            }
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
            $res = $q->errorMessage;
        }
        return $res;
    }

    /**
     * กำลังจะยกเลิก
     */
    public function drugLeft($hn='', $drugItems=array()){
        $drugSQL = "'".implode("','", $drugItems)."'";
        $currDate = (date('Y')+543).date('-m-d 00:00:00');
        $sixMonth = strtotime('-6 month');
        $dateSixMonth = (date('Y', $sixMonth)+543).date('-m-d 00:00:00', $sixMonth);
        $tmp_ddrugrx = sprintf("CREATE TEMPORARY TABLE IF NOT EXISTS `tmp_ddrugrx`
        SELECT a.* FROM (
            SELECT `row_id`,`date`,`hn`,`drugcode`,`tradname`,`amount`,`slcode`,CONCAT(`hn`,`drugcode`) AS `hn_drugcode`,`idno` 
            FROM `ddrugrx`
            WHERE `date` >= '$dateSixMonth' AND `date` <= '$currDate' 
            AND `hn` = '%s' 
            AND `drugcode` IN ($drugSQL) 
            AND ( `an` IS NULL AND `slcode` != 'b' ) 
        ) AS a LEFT JOIN `dphardep` AS b ON a.`idno` = b.`row_id`
        WHERE b.`dr_cancle` IS NULL",
            $this->dbi->real_escape_string($hn)
        );
        $this->dbi->query($tmp_ddrugrx);

        $sqlTemp = "SELECT a.*,CONCAT(a.`hn`,a.`drugcode`) AS `hn_drugcode`,
        (a.`amount`/b.`amount`) AS `day_averrage`,
        TIMESTAMPDIFF(DAY,CONCAT((SUBSTRING(a.`date`,1,4)-543),SUBSTRING(a.`date`,5,6)),NOW()) AS `day_diff`,
        CONCAT(b.`detail1`,' ',b.`detail2`,' ',b.`detail3`) AS `detail`,
        c.`doctor`,d.`unit`,b.`amount` AS `amount_per_day`
        FROM `tmp_ddrugrx` AS a 
        LEFT JOIN `drugslip` AS b ON a.`slcode` = b.`slcode` 
        LEFT JOIN `dphardep` AS c ON a.`idno` = c.`row_id` 
        LEFT JOIN `druglst` AS d ON d.`drugcode` = a.`drugcode`
        ORDER BY a.`hn`,a.`date` DESC";
        $qLeftOver = $this->dbi->query($sqlTemp);

        $drugOverItem = array();
        if($qLeftOver->num_rows>0){
            while ($a = $qLeftOver->fetch_assoc()) {
                if($a['day_diff'] < $a['day_averrage']){
                    $a['itemLeft'] = ($a['day_averrage']-$a['day_diff'])*$a['amount_per_day'];
                    $a['dayLeft'] = $a['day_averrage']-$a['day_diff'];
                    $a['unit'] = trim($a['unit']);
                    $drugOverItem[] = $a;
                }
            }
        }
        return $drugOverItem;
    }

    /**
     * แสดงรายการยาที่เหลือย้อนหลัง 6เดือนในหน้าจ่ายยาของแพทย์
     * 
     * @param string $hn HN ของผู้มารับบริการ
     * @return array|false 
     * - 'latest_date' (string): วันที่ล่าสุดที่จ่ายยา
     * - 'rows' (string): จำนวนที่ได้จากการ GROUP
     * - 'tradname' (string): ชื่อทางการค้า
     * - 'amount' (string): จำนวนที่จ่าย ณ วันที่รับบริการ
     * - 'slcode' (string): รหัสวิธีใช้ยา
     * - 'hn' (string): HN ผู้มารับบริการ
     * - 'drugcode' (string): รหัสยา
     * - 'idno' (string): idno จาก ddrugrx
     * - 'genname' (string): ชื่อสามัญ
     * - 'doctor' (string): doctor
     * - 'sl_amount' (string): ค่าสัมประสิทธิ์ ที่ใช้ยาต่อวัน
     * - 'day_averrage' (string): จำนวนวันที่ใช้ยาต่อครั้งในการจ่าย (จำนวนที่แพทย์สั่ง หารด้วย จำนวนที่ใช้ต่อวัน)
     * - 'day_diff' (string): ผ่านมาแล้วกี่วัน
     * - 'detail' (string): รายละเอียดวิธีใช้
     */
    public function showDrDrugLeft($hn){

        $currDate = (date('Y')+543).date('-m-d 00:00:00');
        $sixMonth = strtotime('-6 month');
        $dateSixMonth = (date('Y', $sixMonth)+543).date('-m-d 00:00:00', $sixMonth);
        $res = false;
        $sql = sprintf("SELECT a.*,d.`genname`,b.`doctor`,c.`amount` AS `sl_amount`,
        (a.`amount`/c.`amount`) AS `day_averrage`,
        TIMESTAMPDIFF(DAY,CONCAT((SUBSTRING(a.`latest_date`,1,4)-543),SUBSTRING(a.`latest_date`,5,6)),NOW()) AS `day_diff`,
        CONCAT(c.`detail1`,' ',c.`detail2`,'',c.`detail3`) AS `detail`
        FROM (
            SELECT MAX(`date`) AS `latest_date`,COUNT(`drugcode`) AS `rows`,`tradname`,`amount`,`slcode`,`hn`,`drugcode`,CONCAT(`hn`,`drugcode`) AS `hn_drugcode`,`idno`
            FROM `ddrugrx` 
            WHERE `date` >= '$dateSixMonth' AND date <= '$currDate'
            AND `hn` = '%s' 
            AND ( `an` IS NULL AND `slcode` != 'b' ) 
            GROUP BY `drugcode` 
            HAVING COUNT(`drugcode`) > 1 
            ORDER BY `latest_date`
        ) AS a LEFT JOIN `dphardep` AS b ON a.`idno` = b.`row_id`
        LEFT JOIN `druglst` AS d ON a.`drugcode` = d.`drugcode`
        LEFT JOIN `drugslip` AS c ON c.`slcode` = a.`slcode`
        WHERE b.`dr_cancle` IS NULL
        AND c.`amount` > 0 
        HAVING `day_averrage` > `day_diff`",
            $this->dbi->real_escape_string($hn)
        );
        $q = $this->dbi->query($sql);
        if(!$this->dbi->error){
            $res = array();
            $rows = $q->num_rows;
            if($rows>0){
                while ($a = $q->fetch_assoc()) {
                    $res[] = $a;
                }
            }
        }
        return $res;
    }
}
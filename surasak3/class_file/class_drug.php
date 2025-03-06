<?php 
require_once dirname(__FILE__).'/database.php';

class Drug extends DbConnect{

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
            $res = $this->dbError();
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

    /**
     * 
     */
    public function setNewRunno(){
        $q_runno = $this->__query("SELECT `title`,`prefix`,`runno` FROM `runno` WHERE `title` = 'phardep'");
        $runno_row = $q_runno->fetch_assoc();
		$chktranx = $runno_row['runno'];
		$chktranx++;
        
        $this->__query("UPDATE `runno` SET `runno` = '$chktranx' WHERE `title`='phardep'");
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

        $sql = "INSERT INTO dphardep(
        chktranx,date,ptname,hn,price,
        doctor,item,idname,diag,essd,
        nessdy,nessdn,dpy,dpn,dsy,
        dsn,tvn,ptright,whokey,kew)
        VALUES
        ('".$nRunno."','".$Thidate."','".$Ptname."','".$_SESSION["hn_now"]."','".$Netprice."','".$_SESSION["dt_doctor"]."','".$_POST["totalitem"]."','".$_SESSION["sOfficer"]."','".jschars($_SESSION["dt_diag"])."','".$pricetype["DDL1"]."','".$pricetype["DDY1"]."','".$pricetype["DDN1"]."','".$pricetype["DPY1"]."','".$pricetype["DPN1"]."','".$pricetype["DSY1"]."','".$pricetype["DSN1"]."','".$_SESSION["vn_now"]."','".$_SESSION["ptright_now"]."','DR','".$kew."');";
	
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
            $q = $this->__query($sql);
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
}
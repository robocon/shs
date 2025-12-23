<?php 
include_once dirname(__FILE__).'/database.php';
include_once dirname(__FILE__).'/class_opcard.php';
include_once dirname(__FILE__).'/class_opday.php';
#https://docs.phpdoc.org/guide/references/phpdoc/index.html#phpdoc-reference
class ClassDepart extends DbConnect{

    public function __construct()
    {
        parent::__construct();
    } 

    /**
     * รันเลข runno ใน depart เอาไปใช้ในฟิลด์ chktranx
     * 
     * @return mixed หมายเลข ฟิลด์runno ของตารางrunno
     */
    public function startRunno(){
        $q_runno = $this->__query("SELECT `title`,`prefix`,`runno` FROM `runno` WHERE `title` = 'depart'");
        $runno_row = $q_runno->fetch_assoc();
		$chktranx = $runno_row['runno'];
		$chktranx++;
        
        $this->__query("UPDATE `runno` SET `runno` = '$chktranx' WHERE `title`='depart'");
        
        return $chktranx;
    }

    /**
     * Summary of getThDateTime
     * @return string รูปแบบ พ.ศ. Y-m-d H:i:s
     */
    public function getThDateTime(){
        return (date('Y')+543).date('-m-d H:i:s');
    }
    
    /**
     * ค้นหา depart จาก row_id
     * 
     * @param string $id คือ row_id ของตาราง
     * 
     * @return mixed String if error and array if success
     */
    public function getDepartFromId($id=null){
        if (empty($id)) {
            $res = false;
        }else{
            $sql = sprintf("SELECT * FROM `depart` WHERE `row_id` = '%s' LIMIT 1", $this->dbi->real_escape_string($id));
            $q = $this->__query($sql);
            if(empty($q->errorNumber)){
                $res = array();
                if($q->num_rows>0){
                    $res = $q->fetch_assoc();
                    $q->free_result();
                }else{
                    $res = false;
                }
            }else{
                $res = $q->errorMessage;
            }
        }
        return $res;
    }

    /**
     * ดึงข้อมูลจากใน depart 
     * @param string $date รูปแบบวันที่ของไทย เช่น 2567-11-29
     * @param string $hn เลขที่ผู้มารับบริการ
     * @param string $depart (optional) เอาไว้แยกตามประเภท
     * 
     * @return mixed รายการของ depart
     */
    public function getDepart($date=null, $hn=null, $depart=null){
        if (empty($date) OR empty($hn)) {
            return "getDepart required date(THAI FORMAT IN YYYY-mm-dd) and HN";
            exit;
        }else{
            $sql = sprintf(
                "SELECT * FROM `depart` WHERE `date` LIKE '%s%%' AND `hn` = '%s' ", 
                $this->dbi->real_escape_string($date), 
                $this->dbi->real_escape_string($hn)
            );
            if ($depart!==null) {
                $sql .= sprintf(" AND `depart` = '%s' ", $this->dbi->real_escape_string($depart));
            }

            $q = $this->__query($sql);
            if(empty($q->errorNumber)){
                if($q->num_rows>0){
                    $res = array();
                    while ($a = $q->fetch_assoc()) {
                        $res[] = $a;
                    }
                }
            }else{
                $res = $q->errorMessage;
            }
            
        }
        return $res;
    }

    /**
     * เพิ่มข้อมูลค่าใช้จ่ายใน depart เท่านั้น
     * 
     * @return string $departId หมายเลขของ row_id ที่บันทึกล่าสุด
     */
    public function insertOnlyDepart(
        $hn=null, 
        $detail='',             // รายละเอียดว่าตรวจอะไร
        $diag='',               // ข้อวินิจฉัยของแพทย์
        $labItems=array(),      // มีรายการตรวจอะไรบ้างเอาไปคำนวณค่าใช้จ่าย
        $officer='',            // จนท.ผู้บันทึก
        $cashok='',             // สถานะการเก็บเงิน(ดีดลูกหนี้)
        $nLab_orderhead = '',   // เลขที่แลป
        $depart='',             // แผนก
        $date='',                // วันที่
        $dataDoctor=''
    ){ 

        $opday = new Opday();
        if(empty($date)){
            $op = $opday->getThisDay($hn);
            if ($op===false) {
                return "ไม่มีข้อมูลการออก VN ในวันนี้";
                exit;
            }
        }else{
            list($y,$m,$d) = explode('-', $date);
            $dmYDateHn = "$d-$m-$y".$hn;
            $op = $opday->getFromThidateHn($dmYDateHn);
        }
        $ptright = $op['ptright'];
        $ptname = $op['ptname'];
        $vn = $op['vn'];

        $doctor = 'MD022 (ไม่ทราบแพทย์)';
        if(!empty($dataDoctor)){
            $doctor = $dataDoctor;
        }

        $labprice = $this->getPrice($labItems);
        $sumPrice = $labprice['sumPrice'];
        $sumYPrice = $labprice['sumYPrice'];
        $sumNPrice = $labprice['sumNPrice'];

        $runnoChktranx = $this->startRunno();
        $thaiDateTime = $this->getThDateTime();
        if(!empty($date)){
            $thaiDateTime = $date.' '.date('H:i:s');
        }
        $countItem = count($labItems);
        if (empty($officer)) {
            $officer = $this->getOfficer();
        }
        
        $sql_depart = "INSERT INTO `depart` ( 
            `chktranx`, `date`, `ptname`, `hn`, `doctor`, `depart`, 
            `item`, `detail`, `price`, `sumyprice`, `sumnprice`, 
            `idname`, `diag`, `tvn`, `ptright`, `lab`, `status` ,
            `cashok`, `paid`
        ) VALUES ( 
            '$runnoChktranx', '$thaiDateTime', '$ptname', '$hn', '$doctor', '$depart', 
            '$countItem', '$detail', '$sumPrice', '$sumYPrice', '$sumNPrice', 
            '$officer', '$diag', '$vn', '$ptright', '$nLab_orderhead', 'Y', 
            '$cashok', '$sumPrice'
        )";
        
        $depart_save = $this->dbi->query($sql_depart);
        if($depart_save==false){
            return $this->dbi->error;

        }
        $departId = $this->dbi->insert_id;
        return $departId;

    }

    /**
     * รวมค่าใช้จ่ายตามรายการที่โยนเข้ามา รวมเป็นก้อนเดียวกัน
     * 
     * @param array @labItems รายการแลป หรือ xray ต่างๆ ที่อยู่ใน labcare
     * 
     * @return array    sumPrice ค่าใช้จ่ายทั้งหมด
     *                  sumYPrice แยกตามที่เบิกได้
     *                  sumNPrice ที่เบิกไม่ได้
     */
    public function getPrice($labItems){
        $sumPrice = 0;
        $sumYPrice = 0;
        $sumNPrice = 0;
        foreach ($labItems as $key => $lab_code) { 

            $labcare = $this->getLabcareFromCode($lab_code, array('code','oldcode','detail','price','yprice','nprice','depart','part'));

            // $sql_labcare = sprintf("SELECT `code`,`oldcode`,`detail`,`price`,`yprice`,`nprice`,`depart`,`part` FROM `labcare` WHERE `code` = '%s' ", $lab_code);
            // $q = $this->dbi->query($sql_labcare);
            // if ($q->num_rows > 0) { 

                // $labcare = $q->fetch_assoc();
                $sumPrice += $labcare['price'];
                $sumYPrice += $labcare['yprice'];
                $sumNPrice += $labcare['nprice'];

            // }
            
        } // End foreach รายการแลป

        return array(
            'sumPrice' => number_format($sumPrice, 2),
            'sumYPrice' => number_format($sumYPrice, 2),
            'sumNPrice' => number_format($sumNPrice, 2)
        );
    }

    /**
     * @param string $code รหัสที่ต้องการใน labcare
     * @param array $selectItem example: array('code','detail,'price','yprice','nprice'ff) 
     */
    public function getLabcareFromCode($code, $selectItem=array()){
        $select = '*';
        if(!empty($selectItem)){
            $select = implode(',', $selectItem);
        }
        $sql_labcare = sprintf("SELECT $select FROM `labcare` WHERE `code` = '%s' ", $code); 
        $q = $this->dbi->query($sql_labcare);
        if (empty($this->dbi->error) && $q->num_rows > 0) { 
            $res = $q->fetch_assoc();

        }else{
            $res = array('error' => true,'msg' => '');
            
            $res['msg'] = $this->dbi->error ? $this->dbi->error : 'can not find data from code' ;
            
        }

        return $res;
    }

    /**
     * map ค่า ระหว่าง key กับ value ออกมาเป็น `key`='value' ใช้สำหรับ update statement
     * สามารถใช้ได้ดังนี้ array_map('mapUpdate', array_keys($array), array_values($array));
     * @param string $key
     * @param string $value
     */
    public function mapUpdate($key, $value){ 
        $key = sprintf("%s", $key);
        $value = sprintf("%s", $value);
        return "`$key`='$value'";
    }

    /**
     * @param array $dataList รายการที่จะอัพเดทเป็น key value
     * @param string $id primary key ของ deaprt
     * 
     * @return mixed $save true ถ้าบันทึกข้อมูลได้ false หรือ mysql error ถ้าข้อมูลผิดพลาด
     */
    public function setDepartManual($dataList=array(), $id=null){

        if(empty($id) OR empty($dataList)){
            return false;
        }

        $updateList = array_map(array($this, 'mapUpdate'), array_keys($dataList), array_values($dataList));
        $updateTxt = implode(', ', $updateList);

        $sqlUpdateDepart = "UPDATE `depart` SET $updateTxt WHERE `row_id` = '$id' ";
        $save = $this->dbi->query($sqlUpdateDepart);
        if ($this->dbi->error) {
            return $this->dbi->error.' : '.$sqlUpdateDepart;
        }else{
            return $save;
        }
    }

    /**
     * ใช้อัพเดทในกรณีที่ รายการใน depart มีเท่าเดิม แต่ค่าราคาใน price,yprice,nprice ผิดไปจากเดิมเช่น ห้องแลปไม่ได้แก้ราคาตรวจแลป
     * 
     * @param array $itemList รายการที่จะต้องเอามาคำนวณค่าใช้จ่าย
     * @param string $id row_id ของ depart
     * @param array $fieldUpdate Field ในตาราง depart ที่จะทำการอัพเดท
     * 
     * จะมีฟิลด์ถูกฟิกไว้อยู่แล้วที่ต้องอัพเดทตาม $itemList เช่น item, price, sumyprice, sumnprice 
     * ใน $fieldUpdate จะต้องมี detail เป็นอย่างน้อยเพื่อบอกว่ารายการที่อัพเดทเป็น ค่าบริการทางการแพทย์ หรือ ค่าบริการทางการพยาบาล
     * ส่วนฟิดล์อื่นๆ สามารถเอามาใส่ไว้ใน $fieldUpdate ได้เลย
     */
    public function updateDepartFromList($itemList=array(), $id=null, $fieldUpdate=array()){
        if(empty($itemList) OR empty($id) OR empty($fieldUpdate)){
            return false;
        }
        $amount = count($itemList);
        $price = $sumYPrice = $sumNPrice = 0;
        foreach ($itemList as $key => $value) {
            $lab = $this->getLabcareFromCode($value, array('code', 'price', 'yprice', 'nprice'));
            if($lab['error']===true){
                return $lab['msg'];
            }

            //
            //
            // @todo คิดว่าจะเพิ่ม การอัพเดท patdata ในนี้ไปเลย เพราะสุดท้่ายก็ต้องสรุปตัวเลขแล้วไปอัพเดทใน depart อยู่ดี
            //
            //
            

            $price += $lab['price'];
            $sumYPrice += $lab['yprice'];
            $sumNPrice += $lab['nprice'];
        }

        $mainSQL = array(
            'item'=>$amount, 
            'price'=>$price,
            'sumyprice'=>$sumYPrice,
            'sumnprice'=>$sumNPrice
        );

        if(count($fieldUpdate)>0){ 
            $mainSQL = array_merge($mainSQL, $fieldUpdate);
        }
        
        $preSQL = array_map(array($this, 'mapUpdate'), array_keys($mainSQL), array_values($mainSQL));
        $setSQL = implode(', ', $preSQL);

        $sqlUpdateDepart = "UPDATE `depart` SET $setSQL WHERE `row_id` = '$id' LIMIT 1";
        $res = $this->dbi->query($sqlUpdateDepart);
        if ($this->dbi->error) {
            $res = $this->dbi->error.' : '.$sqlUpdateDepart;
        }
        return $res;
    }

    /**
     * ลบ depart
     */
    public function delDepartFromRowId($id=false){
        $d = $this->getDepartFromId($id);
        if($d!==false){
            $sql = sprintf("DELETE FROM `depart` WHERE `row_id` = '%s' ", $this->dbi->real_escape_string($id));
            $res = $this->dbi->query($sql);
            if($res===false){
                $res = array('error'=>$this->dbi->error.' : '.$sql);
            }
        }else{
            $res = false;
        }
        return $res;
    }

    public function getFromTxDate($txdate=false, $hn=false, $depart=false){
        $sql = sprintf("SELECT * FROM `depart` WHERE `date` = '%s' AND `hn` = '%s' AND `depart` = '%s';", 
            $this->dbi->real_escape_string($txdate),
            $this->dbi->real_escape_string($hn),
            $this->dbi->real_escape_string($depart)
        );
        $q = $this->dbi->query($sql);
        $items = array();
        if($q!==false){
            while ($a = $q->fetch_assoc()) {
                $items[] = $a;
            }
        }else{
            $items = false;
        }
        return $items;
    }

}

